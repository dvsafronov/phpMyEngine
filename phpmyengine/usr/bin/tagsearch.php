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
    
    $myRecords = $myFilter->getRecords();

    echo "<pre>";
    var_dump($myRecords);
    echo "</pre>";
}
