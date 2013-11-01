<?php

namespace phpMyEngine\Template;

use \phpMyEngine\Render\Render;

function r() {
    return Render::getInstance();
}

function ce($paramName, $applyMods = null) {
    if (g($paramName, $applyMods)) {
        echo r()->getValue($paramName, $applyMods);
    }
    return null;
}

function e($paramName, $applyMods = null) {
    echo r()->getValue($paramName, $applyMods);
    return null;
}

function g($paramName, $applyMods = null) {
    return r()->getValue($paramName, $applyMods);
}

function ef($param, $applyMods = null) {
    if (strlen($applyMods) > 0) {
        $param = r()->applyMods($applyMods, $param);
    }
    echo $param;
    return null;
}

function isOdd($num) {
    if ($num % 2 == 0) {
        return false;
    }
    return true;
}

function m2f($mutagen, $values = array()) {
    $myMutagen = new \phpMyEngine\Records\Mutagen ($mutagen);
    $myValidateRules = $myMutagen->getValidateRules();
    $myProperties = $myMutagen->getProperties();
    $output = '';
    foreach ($myProperties as $key) {
        if (isset ($myValidateRules[$key]['formTag'])) {
            $myFormElement = new \phpMyEngine\HTML\FormElement((object) $myValidateRules[$key]['formTag']);
            if (isset ($myValidateRules[$key]->maxLength)) {
                $myFormElement->maxLength = (int) $myValidateRules[$key]['maxLength'];
            }
            $myFormElement->name = $key;
            $value = isset($values[$key]) ? $values[$key] : null;
            $myFormElement->value = html_entity_decode($value);
            if ($myFormElement->type != 'hidden') {
                $output .= '<label>'.$key.':</label>'.PHP_EOL;
            }
            $output .= $myFormElement.PHP_EOL;
            unset($myFormElement, $value);
        }

    }
    return $output;
}