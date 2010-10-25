<?php
namespace phpMyEngine\extensionsController;

use phpMyEngine;
use phpMyEngine\Route;
use phpMyEngine\Config\Config;
use phpMyEngine\Render\Render;
use phpMyEngine\ControlPanel;
use phpMyEngine\EngineFileSystem;
use phpMyEngine\EngineFileSystem\Structure;

function defaultAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myStrucutre = Structure::getInstance ();
    $optInfo = array ();
    for ($i = 0, $ca = count ( $_myStrucutre['var/opt'] ); $i < $ca; $i++) {
        $tmp = str_replace ( '/var/opt', null, $_myStrucutre['var/opt'][$i] );
        $tmp = $_myStrucutre['var/opt'][$i] . substr ( $tmp, \strrpos ( $tmp, '/' ) ) . '.pkg.json';
        $tmpJSON = json_decode ( \file_get_contents ( $tmp ) );
        if (JSON_ERROR_NONE === json_last_error ()) {
            \array_push ( $optInfo, $tmpJSON );
        } else {
            \phpMyEngine\logError ( $tmp . ' malformed' );
        }
    }
    unset ( $tmp, $tmpJSON );
    $_myRender->setValue('optInfo',$optInfo);
    $_myRender->renderTemplate('extensions/list.tpl');
    unset($optInfo);
}