<?php
namespace phpMyEngine\articlesController;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation as FOP;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;
use phpMyEngine\Config\Config;

\phpMyEngine\loadModule ( 'articles' );

function viewAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();

    $myFilter = new Filter();
    $myFilter->mutagenType = 'Article';
    if (isset ( $_myRoute->id )) {
        $myFilter->_id = (float) $_myRoute->id;
    } elseif (isset ( $_myRoute->title )) {
        $myFilter->mutagenData->title = \addslashes ( $_myRoute->title );
    }
    try {
        $myRecord = $myFilter->getRecords ()->getFirst ();
        $_myRender->setTitle ( $myRecord->mutagenData->title );
        $_myRender->Smarty ()->assign ( "myRecord", $myRecord );
        $_myRender->renderTemplate ( 'articles/view.tpl' );
    } catch (\phpMyEngine\Exception $e) {
        $_myRender->renderTemplate ( 'errors/404.tpl' );
    }
    return null;
}

function listcategoryAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    $_myConfig = Config::getInstance ();

    $moduleConfig = $_myConfig->load ( 'articles', true );
    $onPage = $moduleConfig->categoriesOnPage ? : 12;


    $myFilter = new Filter();
    $myFilter->mutagenType = 'Category';
    $myFilter->limit = $onPage;
    $myFilter->offset = ($_myRoute->page - 1) * $onPage;

    $myRecords = $myFilter->getRecords ();

    $_myRender->setValue ( 'paginationCountPages',
            ceil ( $myRecords->allCount / $onPage ) );

    $_myRender->setValue ( 'recordsList', $myRecords );
    $_myRender->renderTemplate ( 'articles/category/list.tpl' );
}

function listAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    $_myConfig = Config::getInstance ();

    $moduleConfig = $_myConfig->load ( 'articles', true );
    $onPage = $moduleConfig->articlesOnPage ? : 12;

    $myFilter = new Filter();
    $myFilter->mutagenType = 'Article';
    $myFilter->mutagenData->category = (double) $_myRoute->id;
    $myFilter->limit = $onPage;
    $myFilter->offset = ($_myRoute->page - 1) * $onPage;
    $myFilter->orderBy = '_id';
    $myFilter->order = $myFilter::ORDER_DESC;

    $myRecords = $myFilter->getRecords ();

    $categoryTitle = \phpMyEngine\Modules\Articles\getCategoryTitles ( array ($_myRoute->id) );
    $categoryTitle = $categoryTitle[(string) $_myRoute->id];
    $_myRender->setValue ( 'categoryTitle', $categoryTitle );
    $_myRender->setValue ( 'recordsList', $myRecords );

    $_myRender->setValue ( 'paginationCountPages',
            ceil ( $myRecords->allCount / $onPage ) );

    $_myRender->renderTemplate ( 'articles/list.tpl' );
}

function archiveAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRoute = Route::getInstance ();

    $magic = 10485.76;
    $min = \strtotime ( "{$_myRoute->date} 00:00:00" ) * $magic;
    $max = \strtotime ( "{$_myRoute->date} 23:59:59" ) * $magic;

    $myFilter = new \phpMyEngine\Records\Filter();
    $myFilter->mutagenType = 'Article';
    $myFilter->_id = FOP::op ( FOP::FOP_BETWEEN, $min, $max );
    $myFilter->orderBy = '_id';
    $myFilter->order = $myFilter::ORDER_ASC;

    $myRecords = $myFilter->getRecords ();

    $ids = array ();
    foreach ($myRecords->records as $record) {
        $ids[] = $record->mutagenData->category;
    }

    $categoryTitles = \phpMyEngine\Modules\Articles\getCategoryTitles ( $ids );

    $_myRender->setValue ( 'categoryTitles', $categoryTitles );
    $_myRender->setValue ( 'recordsList', $myRecords );
    $_myRender->renderTemplate ( 'articles/list.tpl' );
    return null;
}

function tagsearchAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRoute = \phpMyEngine\Route::getInstance ();

    $myFilter = new \phpMyEngine\Records\Filter();
    $myFilter->mutagenType = 'Article';
    $myFilter->tags = $_myRoute->tag;
    $myFilter->orderBy = '_id';
    $myFilter->order = $myFilter::ORDER_DESC;
    $myRecords = $myFilter->getRecords ();

    $ids = array ();
    foreach ($myRecords->records as $record) {
        $ids[] = $record->mutagenData->category;
    }

    $categoryTitles = \phpMyEngine\Modules\Articles\getCategoryTitles ( $ids );

    $_myRender->setValue ( 'categoryTitles', $categoryTitles );
    $_myRender->setValue ( 'recordsList', $myRecords );
    $_myRender->setValue ( 'tag', $_myRoute->tag );
    $_myRender->renderTemplate ( 'articles/tags/form.tpl' );
    $_myRender->renderTemplate ( 'articles/list.tpl' );
    return null;
}

function defaultAction () {
    $_myRoute = Route::getInstance ();
    $_myRender = Render::getInstance ();
    $_myConfig = Config::getInstance ();

    $moduleConfig = $_myConfig->load ( 'articles', true );
    $onPage = $moduleConfig->articlesOnPage ? : 12;

    $myFilter = new Filter();
    $myFilter->mutagenType = 'Article';
    $myFilter->limit = $onPage;
    $myFilter->offset = ($_myRoute->page - 1) * $onPage;
    $myFilter->orderBy = '_id';
    $myFilter->order = $myFilter::ORDER_DESC;

    $myRecords = $myFilter->getRecords ();

    $ids = array ();
    foreach ($myRecords->records as $record) {
        $ids[] = $record->mutagenData->category;
    }

    $categoryTitles = \phpMyEngine\Modules\Articles\getCategoryTitles ( $ids );

    $_myRender->setValue ( 'categoryTitles', $categoryTitles );    
    $_myRender->setValue ( 'recordsList', $myRecords );
    $_myRender->setValue ( 'paginationCountPages',
            ceil ( $myRecords->allCount / $onPage ) );

    $_myRender->renderTemplate ( 'articles/list.tpl' );
    return null;
}