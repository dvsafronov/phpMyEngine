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
        \phpMyEngine\Modules\Articles\prepareAndSave ( 'add','category' );
    }
    return null;
}

function listAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $myFilter = new Filter();
        $myFilter->mutagenType = 'Article';
        $myRecords = $myFilter->getRecords ();
        $_myRender->setValue ( 'recordsList', $myRecords );
        $_myRender->renderTemplate ( 'articles/list.tpl' );
    }
}