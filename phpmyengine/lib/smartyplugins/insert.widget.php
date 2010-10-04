<?php

function smarty_insert_widget ( $params ) {
    if (\array_key_exists ( 'widget', $params ) !== true) {
        return null;
    }
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $params['widget'] . '.widget.php', 'lib/widgets' )) {
        include_once $rp;
        $func = '\phpMyEngine\Widgets\\' . $params['widget'] . 'Widget';
        return $func();
    }
    return null;
}