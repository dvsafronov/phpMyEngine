<?php
namespace phpMyEngine\articlesController;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

\phpMyEngine\loadModule ( 'articles' );

function editAction () {
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        \phpMyEngine\Modules\Articles\prepareAndSave ( 'edit' );
    }
    return null;
}

function addAction () {
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        \phpMyEngine\Modules\Articles\prepareAndSave ( 'add' );
    }
    return null;
}

function addcategoryAction () {
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        \phpMyEngine\Modules\Articles\prepareAndSave ( 'add', 'Category' );
    }
    return null;
}

function editcategoryAction () {
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        \phpMyEngine\Modules\Articles\prepareAndSave ( 'edit', 'Category' );
    }
    return null;
}

function listcategoryAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myFilter = new Filter();
        $myFilter->mutagenType = 'Category';
        $myRecords = $myFilter->getRecords ();
        $_myRender->setValue ( 'recordsList', $myRecords );
        $_myRender->renderTemplate ( 'articles/category/list.tpl' );
    }
}

function listAction () {
    $_myRender = Render::getInstance ();
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myFilter = new Filter();
        $myFilter->mutagenType = 'Article';
        $myRecords = $myFilter->getRecords ();
        $_myRender->setValue ( 'recordsList', $myRecords );
        $_myRender->renderTemplate ( 'articles/list.tpl' );
    }
}

function deleteAction () {
    $_myRender = Render::getInstance ();
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myMessages = new \phpMyEngine\Messages();
        $myFilter = new Filter();
        $myFilter->_id = (double) $_myRoute->id;
        $myFilter->mutagenType = 'Article';
        if ($myFilter->deleteRecords ()) {
            $myMessages->addMessage ( 'Item has been deleted' );
        } else {
            $myMessages->addError ( 'Item not deleted' );
        }
        $_myRender->setValue ( '_messages', $myMessages );
        $_myRender->renderTemplate ( '_messages.tpl' );
    }
    return null;
}

function deletecategoryAction () {
    $_myRender = Render::getInstance ();
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myMessages = new \phpMyEngine\Messages();
        $myFilter = new Filter();
        $myFilter->_id = (double) $_myRoute->id;
        $myFilter->mutagenType = 'Category';
        if ($myFilter->deleteRecords ()) {
            $myMessages->addMessage ( 'Item has been deleted' );
        } else {
            $myMessages->addError ( 'Item not deleted' );
        }
        $_myRender->setValue ( '_messages', $myMessages );
        $_myRender->renderTemplate ( '_messages.tpl' );
    }
    return null;
}