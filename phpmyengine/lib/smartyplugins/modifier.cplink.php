<?php

function smarty_modifier_cplink ( $link ) {
    $_myConfig = \phpMyEngine\Config\Config::getInstance();
    if ($link == '/') {
        $link = $_myConfig->engine->controlPanel->URI . '/';
    } else {
        $link = $_myConfig->engine->controlPanel->URI . '/' . $link;
    }
    return $link;
}
