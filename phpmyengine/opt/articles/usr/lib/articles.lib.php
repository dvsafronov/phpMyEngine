<?php
namespace phpMyEngine\Modules\Articles;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

function prepareAndSave ( $action, $mutagen = 'Article' ) {
    $_tpl = 'articles/edit';
    $_myRender = Render::getInstance ();
    $myMessages = new \phpMyEngine\Messages();

    switch ($action) {
        case 'add': {
                $myRecord = new \phpMyEngine\Records\Record();
                $myRecord->applyMutagen ( $mutagen );
                break;
            }
        case 'edit': {
                $_myRoute = Route::getInstance ();
                $myFilter = new Filter();
                $myFilter->_id = (double) $_myRoute->id;
                $myFilter->mutagenType = $mutagen;
                $myRecord = $myFilter->getRecords ()->getFirst ();
                unset ( $myFilter );
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $myRecord->applyMutagen ( $mutagen );
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
            if (!is_null ( $value ) && strlen ( $value ) > 0 && !in_array ( $value,
                            $myRecord->tags )) {
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

function getCategories ( $forceCategory = null ) {
    $myFilter = new Filter();
    $myFilter->mutagenType = 'Category';
    $myRecords = $myFilter->getRecords ();
    $myCategories = array ('_uncategored' => 0);
    if ($myRecords->count > 0) {
        for ($i = 0; $i < $myRecords->count; $i++) {
            $myCategories[$myRecords->records[$i]->mutagenData->title] = $myRecords->records[$i]->_id;
        }
    }
    unset ( $myFilter, $myRecords );
    return $myCategories;
}

function getCategoryTitles ( Array $id ) {
    $myCategories = array ();
    $myFilter = new Filter();
    $myFilter->mutagenType = 'Category';
    $myFilter->_id = FilterOperation::op ( FilterOperation::FOP_IN, $id );
    $myRecords = $myFilter->getRecords ();
    if ($myRecords->count > 0) {
        for ($i = 0; $i < $myRecords->count; $i++) {
            $myCategories[(string) $myRecords->records[$i]->_id] = $myRecords->records[$i]->mutagenData->title;
        }
    }
    unset ( $myFilter, $myRecords );
    return $myCategories;
}