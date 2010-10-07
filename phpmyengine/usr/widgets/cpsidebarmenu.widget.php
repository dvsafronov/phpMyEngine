<?php
namespace phpMyEngine\Widgets;

function cpsidebarmenuWidget () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $cpMenuD = null;
    $_mySt = \phpMyEngine\EngineFileSystem\Structure::getInstance();
    if (\key_exists ( 'etc/controlpanel/menu.d', $_mySt )) {
        foreach ($_mySt['etc/controlpanel/menu.d'] as $i => $realpath) {
            $fname = \str_replace ( '/etc/controlpanel/menu.d', null, $realpath );
            $fname = $realpath . substr ( $fname, strrpos ( $fname, '/' ) ) . '.json';
            $cpMenuD .= ',' . substr ( trim ( file_get_contents ( $fname ) ), 1, -1 );
        }
    }

    if ($cpMenuD !== null) {
        $cpMenuD = "{".\substr ( trim ( $cpMenuD ), 1 ). '}';
    }

    $cpMenu = json_decode ( $cpMenuD, true );
    if (JSON_ERROR_NONE !== json_last_error ()) {
        $cpMenu = array ();
    }
    $_myRender->Smarty ()->assign ( "pageTitle", "Ошибочный запрос" );
    $_myRender->Smarty ()->assign ( "menuItems", $cpMenu );
    return $_myRender->Smarty ()->display ( 'sidebarmenu/menu.tpl' );

    return null;
}
