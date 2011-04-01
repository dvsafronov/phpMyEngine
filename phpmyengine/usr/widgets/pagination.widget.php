<?php
namespace phpMyEngine\Widgets;

function paginationWidget ( $params ) {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRoute = \phpMyEngine\Route::getInstance ();
    $countPages = (int) $params['pages'];
    if ($_myRoute->page == 0 && $countPages > 0) {
        $_myRoute->page = 1;
    }

    $href = preg_replace ( '/(\/page([0-9]+))/', '', $_SERVER['REQUEST_URI'] );

    if (\phpMyEngine\isAJAXRequest ()) {
        //ajax?
    }

    $_myRender->setValue ( 'paginationCount', $countPages );
    $_myRender->setValue ( 'paginationCurPage', $_myRoute->page );
    $_myRender->setValue ( 'paginationHREF', $href );

    $_myRender->renderTemplate ( 'widgets/pagination/pages.tpl' );
}
