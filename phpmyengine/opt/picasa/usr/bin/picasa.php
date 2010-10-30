<?php
namespace phpMyEngine\picasaController;

\phpMyEngine\loadModule ( 'picasa' );

function defaultAction () {
    $myPicasa = new \phpMyEngine\Picasa\Picasa();

    $myPicasa->user = 'xmcdbx';
    $id = '5529337982772012737';
    $imgs = $myPicasa->getImages ( $id );
    //$albms = $myPicasa->getAlbums ();

    $_myRender = \phpMyEngine\Render\Render::getInstance();
    $_myRender->setValue ( 'album', $imgs );
    $_myRender->renderTemplate ( 'picasa/album.tpl' );
}