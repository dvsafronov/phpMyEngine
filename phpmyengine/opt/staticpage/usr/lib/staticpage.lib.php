<?php
namespace phpMyEngine\Modules\StaticPage;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

const MUTAGEN_TYPE = 'StaticPage';

function prepareAndSave ( $action ) {
    $_tpl = 'staticpage/edit';
    $_myRender = Render::getInstance ();
    $myMessages = new \phpMyEngine\Messages();

    switch ($action) {
        case 'add': {
                $myRecord = new \phpMyEngine\Records\Record();
                $myRecord->applyMutagen ( MUTAGEN_TYPE );
                break;
            }
        case 'edit': {
                $_myRoute = Route::getInstance ();

                $myFilter = new Filter();
                $myFilter->_id = (double) $_myRoute->id;
                $myFilter->mutagenType = MUTAGEN_TYPE;
                $myRecord = $myFilter->getRecords ()->getFirst ();
                unset ( $myFilter );
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $myRecord->applyMutagen ( MUTAGEN_TYPE );
                }
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
                $_tpl = 'staticpage/statuschanged';
                $myMessages->addMessage ( 'Static page has been saved' );
            }
        }
    }
    $_myRender->setValue ( 'myRecord', $myRecord );
    $_myRender->setValue ( '_messages', $myMessages );
    $_myRender->renderTemplate ( $_tpl . '.tpl' );
    return null;
}