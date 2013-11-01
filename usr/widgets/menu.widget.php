<?php

namespace phpMyEngine\Widgets;

function menuWidget() {
    $_myCache = \phpMyEngine\Cache\Cache::getInstance();
    $folder = \phpMyEngine\Route::getInstance()->isControlPanel() ? 'controlpanel' : 'menu';
    if (false === ($menu = $_myCache->getValue("__mainmenu_".$folder))) {
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath('main.menu.php', 'etc/'.$folder)) {
            $menu = include($rp);
            $_myCache->setValue("__mainmenu_".$folder, $menu, 30);
        }
    }
    if (false === is_array($menu)) {
        $menu = array();
    }
    $_myRender = \phpMyEngine\Render\Render::getInstance();
    $_myRender->setValue("menuItems", $menu);
    return $_myRender->renderTemplate('menu/menu.tpl');
}
