<?php
namespace phpMyEngine\staticpageController;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

\phpMyEngine\loadModule('staticpage');

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

    $_myRender->renderTemplate ( 'staticpage/view.tpl' );
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
        $_myRender->renderTemplate ( 'staticpage/list.tpl' );
    }
}

function editAction () {
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        \phpMyEngine\Modules\StaticPage\prepareAndSave ( 'edit' );
    }
    return null;
}

function addAction () {
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        \phpMyEngine\Modules\StaticPage\prepareAndSave ( 'add' );
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