<?php
namespace phpMyEngine\picasaController;

\phpMyEngine\loadModule ( 'picasa' );

function defaultAction () {
    $myPicasa = new \phpMyEngine\Picasa\Picasa();

    $_myConfig = \phpMyEngine\Config\Config::getInstance ();
    $_myConfig->load ( 'picasa', true );

    if (strlen ( $_myConfig->opt->picasa->user ) > 1) {

        $_myRender = \phpMyEngine\Render\Render::getInstance();
        $myPicasa->user = $_myConfig->opt->picasa->user;
        $myPicasa->thumbWidth = (int) $_myConfig->opt->picasa->width;

        if (null != $_myConfig->opt->picasa->forceAlbum) {
            //грузим сразу альбом
            $imgs = $myPicasa->getImages ( $_myConfig->opt->picasa->forceAlbum );
            $_myRender->setValue ( 'album', $imgs );
            $tpl = 'album';
        } else {
            $albms = $myPicasa->getAlbums ();
        }
        $_myRender->renderTemplate ( 'picasa/' . $tpl . '.tpl' );
    } else {
        \phpMyEngine\logError ( 'Picasa module not configured' );
    }
}