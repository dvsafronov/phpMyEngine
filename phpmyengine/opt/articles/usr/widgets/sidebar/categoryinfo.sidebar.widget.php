<?php
namespace phpMyEngine\Widgets;

use phpMyEngine\Records\Filter;

function categoryinfoWidget () {
    $_myRoute = \phpMyEngine\Route::getInstance ();
    if ($_myRoute->controller == 'articles' && $_myRoute->action == 'list' && (double) $_myRoute->id > 0) {
        $myFilter = new Filter();
        $myFilter->mutagenType = 'Category';
        $myFilter->_id = (double) $_myRoute->id;
        $myRecord = $myFilter->getRecords ()->getFirst ();
        if ($myRecord instanceof \phpMyEngine\Records\Record) {
            $_myRender = \phpMyEngine\Render\Render::getInstance ();
            $_myRender->setValue ( 'category', $myRecord->mutagenData );
            $_myRender->renderTemplate ( 'articles/category/info.tpl' );
        }
    }
    return null;
}

return 100;