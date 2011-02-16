<?php
namespace phpMyEngine\picasaController;

use phpMyEngine;
use phpMyEngine\Records\Filter;
use phpMyEngine\Records\FilterOperation;
use phpMyEngine\Route;
use phpMyEngine\Render\Render;

\phpMyEngine\loadModule ( 'picasa' );

function configureAction () {
    $_myRender = Render::getInstance ();
    $_myRoute = Route::getInstance ();
    if ($_myRoute->isControlPanel ()) {
        $_myConfig = \phpMyEngine\Config\Config::getInstance ();
        $_myConfig->load ( 'picasa', true );

        $picasaConf = $_myConfig->opt->picasa;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $picasaConf->user = (string) \filter_input ( INPUT_POST, 'user' );
            $picasaConf->forceAlbum = (string) \filter_input ( INPUT_POST, 'forceAlbum' );
            $picasaConf->width = (int) \filter_input ( INPUT_POST, 'width' );
            $picasaConf->fullWidth = (int) \filter_input ( INPUT_POST, 'fullWidth' );
            $picasaConf->cacheTime = (int) \filter_input ( INPUT_POST, 'cacheTime' );
            $myMessages = new \phpMyEngine\Messages();
            if (true === $_myConfig->saveOPT ( 'picasa', $picasaConf )) {
                $myMessages->addMessage ( 'Settings has been saved successfully' );
            } else {
                $myMessages->addError ( 'Settings not saved' );
            }
            $_myRender->setValue ( '_messages', $myMessages );
            $_myRender->renderTemplate ( '_messages.tpl' );
        }

        $_myRender->setValue ( 'settings', $picasaConf );

        $_myRender->renderTemplate ( 'picasa/config.tpl' );
    }
    return null;
}