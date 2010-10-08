<?php
namespace phpMyEngine\Modules\Articles;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

function prepareAndSave ( $action,$mutagen = 'article' ) {
    $_tpl = 'articles/edit';
    $_myRender = Render::getInstance ();
    $myMessages = new \phpMyEngine\Messages();

    switch ($action) {
        case 'add': {
                $myRecord = new \phpMyEngine\Records\Record();
                $myRecord->applyMutagen ( 'Article' );
                break;
            }
        case 'edit': {
                $_myRoute = Route::getInstance ();
                $myFilter = new Filter();
                $myFilter->_id = (double) $_myRoute->id;
                $myFilter->mutagenType = 'Article';
                $myRecord = $myFilter->getRecords ()->getFirst ();
                unset ( $myFilter );
                break;
            }
        default: {
                return null;
                break;
            }
    }
    $myProperties = $myRecord->mutagenData->getProperties ();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($myProperties as $key) {
            try {
                $myRecord->mutagenData->$key = filter_input ( INPUT_POST, $key );
            } catch (\Exception $myException) {
                $myMessages->addError ( $myException->text );
            }
        }
        $myRecord->tags = array ();
        $tags = explode ( ',', filter_input ( INPUT_POST, 'tags' ) );
        foreach ($tags as $key => $value) {
            $value = trim ( $value );
            if (!is_null ( $value ) && strlen ( $value ) > 0 && !in_array ( $value, $myRecord->tags )) {
                $myRecord->tags[] = $value;
            }
        }
        $myRecord->status = (int) filter_input ( INPUT_POST, 'status' );

        if ($myMessages->caErrors == 0) {
            if ($myRecord->save ()) {
                $_tpl = 'articles/statuschanged';
                $myMessages->addMessage ( 'Static page has been saved' );
            }
        }
    }
    $_myRender->setValue ( 'mutagen', $mutagen );
    $_myRender->setValue ( 'myRecord', $myRecord );
    $_myRender->setValue ( '_messages', $myMessages );
    $_myRender->renderTemplate ( $_tpl . '.tpl' );
    return null;
}

function getCategories($forceCategory = null) {
    return array('uncategored'=>0);
}