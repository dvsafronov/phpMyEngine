<?php
namespace phpMyEngine\tagsearchController;

function defaultAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRoute = \phpMyEngine\Route::getInstance();

    $type = $_myRoute->type;
    $tag = $_myRoute->tag;


    $myFilter = new \phpMyEngine\Records\Filter();
    $myFilter->mutagenType = $type;
    $myFilter->tags = $tag;

    $myRecords = $myFilter->getRecords ();

    $_myRender->setValue ( 'recordsList', $myRecords );
    $_myRender->renderTemplate ( 'articles/list.tpl' );
}
