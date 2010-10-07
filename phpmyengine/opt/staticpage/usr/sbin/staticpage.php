<?php
namespace phpMyEngine\staticpageController;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

function viewAction () {
    $_myRoute = Route::getInstance ();

    $myFilter = new Filter();
    $myFilter->mutagenType = 'StaticPage';
    if (isset ( $_myRoute->id )) {
        $myFilter->_id = (float) $_myRoute->id;
    } elseif (isset ( $_myRoute->title )) {
        $myFilter->mutagenData->title = \addslashes ( $_myRoute->title );
    }

    $myRecord = $myFilter->getRecords ()->getFirst ();

    $_myRender = Render::getInstance ();
    $_myRender->Smarty ()->assign ( "myRecord", $myRecord );
    if ($_myRoute->isControlPanel ()) {
        $_myRender->renderTemplate ( 'staticpage_view.tpl' );
    } else {
        $_myRender->renderTemplate ( 'staticpage.tpl' );
    }
    return null;
}

function listAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myFilter = new Filter();
        $myFilter->mutagenType = 'StaticPage';
        $myRecords = $myFilter->getRecords ();
        $_myRender->setValue ( 'recordsList', $myRecords );
        $_myRender->renderTemplate ( 'staticpage_list.tpl' );
    }
}

function editAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myMessages = new \phpMyEngine\Messages();
        $myFilter = new Filter();
        $myFilter->_id = (double) $_myRoute->id;
        $myFilter->mutagenType = 'StaticPage';
        $myRecord = $myFilter->getRecords ()->getFirst ();
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
                    $_tpl = 'staticpage_saved';
                    $myMessages->addMessage ( 'Static page has been saved' );
                }
            }
        }
        $_myRender->setValue ( 'myRecord', $myRecord );
        $_myRender->setValue ( '_messages', $myMessages );
        $_myRender->renderTemplate ( 'staticpage_edit.tpl' );
    }
    return null;
}

function addAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $_tpl = 'staticpage_edit';
        $myMessages = new \phpMyEngine\Messages();
        $myRecord = new \phpMyEngine\Records\Record();
        $myRecord->applyMutagen ( 'StaticPage' );
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
                    $_tpl = 'staticpage_saved';
                    $myMessages->addMessage ( 'Static page has been saved' );
                }
            }
        }
        $_myRender->setValue ( '_messages', $myMessages );
        $_myRender->setValue ( 'myRecord', $myRecord );
        $_myRender->renderTemplate ( $_tpl . '.tpl' );
    }
    return null;
}

function deleteAction () {
    $_myRender = Render::getInstance ();
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myMessages = new \phpMyEngine\Messages();
        $myFilter = new Filter();
        $myFilter->_id = (double) $_myRoute->id;
        $myFilter->mutagenType = 'StaticPage';
        if ($myFilter->deleteRecords ()) {
            $myMessages->addMessage ( 'Static page has been deleted' );
        } else {
            $myMessages->addError ( 'Static page not deleted' );
        }
        $_myRender->setValue ( '_messages', $myMessages );
        $_myRender->renderTemplate ( '_messages.tpl' );
    }
    return null;
}

function defaultAction () {
    return null;
}