<?php
namespace phpMyEngine\Widgets;

function menuWidget () {
    $folder = \phpMyEngine\Route::getInstance()->isControlPanel () ? 'controlpanel' : 'menu';
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( 'menu.json', 'etc/' . $folder )) {
        $_myRender = \phpMyEngine\Render\Render::getInstance ();
        $menuJSON = \file_get_contents ( $rp );
        $menu = json_decode ( $menuJSON, true );
        if (JSON_ERROR_NONE !== json_last_error ()) {
            $menu = array ();
        }
        $_myRender->Smarty ()->assign ( "pageTitle", "Ошибочный запрос" );
        $_myRender->Smarty ()->assign ( "menuItems", $menu );
        return $_myRender->Smarty ()->display ( 'menu/menu.tpl' );
    }
    return null;
}
