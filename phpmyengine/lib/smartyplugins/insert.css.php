<?php

/**
 *
 * Smarty-плагин CSS для phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2011-02-14 13:27
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
use phpMyEngine\Config\Config;
use phpMyEngine\Render\Render;

function smarty_insert_css ( $params ) {
    $_myCSSConfig = \phpMyEngine\Config\Config::getInstance ()->view->css;
    if ($_myCSSConfig->uniteFiles || $_myCSSConfig->includeInDocument) {
        $_myRender = \phpMyEngine\Render\Render::getInstance ();
        $_myRender->addCSS($params['file']);
        return null;
    } else {
        return '<link rel="stylesheet" type="text/css" href="' . $params['file'] . '" />';
    }
}

