<?php
namespace phpMyEngine\picasaController;

\phpMyEngine\loadModule ( 'picasa' );

function defaultAction () {
    $_myConfig = \phpMyEngine\Config\Config::getInstance ();
    $_myConfig->load ( 'picasa', true );

    if (strlen ( $_myConfig->opt->picasa->user ) > 1) {
        $_myRender = \phpMyEngine\Render\Render::getInstance();
        $myPicasa = new \phpMyEngine\Picasa\Picasa();
        $myPicasa->user = (string) $_myConfig->opt->picasa->user;
        $myPicasa->thumbWidth = (int) $_myConfig->opt->picasa->width;
        $myPicasa->fullWidth = (int) $_myConfig->opt->picasa->fullWidth;
        $myPicasa->cacheTime = (int) $_myConfig->opt->picasa->cacheTime;

        if (null != $_myConfig->opt->picasa->forceAlbum) {
            //грузим сразу альбом
            $imgs = $myPicasa->getImages ( $_myConfig->opt->picasa->forceAlbum );
            $_myRender->setValue ( 'album', $imgs );
            $tpl = 'images';
        } else {
            $albums = $myPicasa->getAlbums ();
            $_myRender->setValue ( 'albums', $albums );
            $tpl = 'albums';
        }
        $_myRender->renderTemplate ( 'gallerytemplates/' . $tpl . '.tpl' );
    } else {
        \phpMyEngine\logError ( 'Picasa module not configured' );
    }
}

function viewAction () {
    $_myRoute = \phpMyEngine\Route::getInstance ();
    $_myRender = \phpMyEngine\Render\Render::getInstance();
    $_myConfig = \phpMyEngine\Config\Config::getInstance ();
    $_myConfig->load ( 'picasa', true );

    $myPicasa = new \phpMyEngine\Picasa\Picasa();

    $myPicasa->user = (string) $_myConfig->opt->picasa->user;
    $myPicasa->thumbWidth = (int) $_myConfig->opt->picasa->width;
    $myPicasa->fullWidth = (int) $_myConfig->opt->picasa->fullWidth;
    $myPicasa->cacheTime = (int) $_myConfig->opt->picasa->cacheTime;

    if (null != $_myConfig->opt->picasa->forceAlbum) {
        $imgs = $myPicasa->getImages ( $_myConfig->opt->picasa->forceAlbum );
    } else {
        $imgs = $myPicasa->getImages ( $_myRoute->id );
    }

    $_myRender->setValue ( 'album', $imgs );
    $_myRender->renderTemplate ( 'gallerytemplates/images.tpl' );
}