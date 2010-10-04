<?php
namespace phpMyEngine\menueditorController;

function defaultAction () {
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( 'menu.json', 'etc/menu' )) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newmenu = \filter_input ( INPUT_POST, 'menufile' );
            \json_encode ( $newmenu );
            if (\JSON_ERROR_NONE === \json_last_error ()) {
                \file_put_contents ( $rp, $newmenu );
            }
            $menu = $newmenu;
        } else {
            $menu = \file_get_contents ( $rp );
        }

        $_myRender = \phpMyEngine\Render\Render::getInstance();
        $_myRender->setValue ( 'menuFileContent', $menu );
        $_myRender->renderTemplate ( 'menueditor.tpl' );
    }
}