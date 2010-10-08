<?php
namespace phpMyEngine\staticpageController;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

function viewAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();

    $myFilter = new Filter();
    $myFilter->mutagenType = 'StaticPage';
    if (isset ( $_myRoute->id )) {
        $myFilter->_id = (float) $_myRoute->id;
    } elseif (isset ( $_myRoute->title )) {
        $myFilter->mutagenData->title = \addslashes ( $_myRoute->title );
    }
    try {
        $myRecord = $myFilter->getRecords ()->getFirst ();
        $_myRender->setTitle ( $myRecord->mutagenData->title );
        $_myRender->Smarty ()->assign ( "myRecord", $myRecord );
        $_myRender->renderTemplate ( 'staticpage/view.tpl' );
    } catch (\phpMyEngine\Exception $e) {
        $_myRender->renderTemplate ( 'errors/404.tpl' );
    }



    return null;
}

function defaultAction () {
    $_myRoute = Route::getInstance ();
    return null;
}