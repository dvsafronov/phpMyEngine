<?php

/**
 *
 * Smarty-плагин виджетов для phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-10-07 11:37
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
function smarty_insert_widget ( $params ) {
    if (\array_key_exists ( 'widget', $params ) !== true) {
        return null;
    }
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $params['widget'] . '.widget.php', 'usr/widgets' )) {
        include_once $rp;
        $func = '\phpMyEngine\Widgets\\' . $params['widget'] . 'Widget';
        return $func ( $params );
    }
    return null;
}