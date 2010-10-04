<?php

function smarty_insert_formelements ( $params ) {
    if (\array_key_exists ( 'mutagen', $params ) !== true) {
        return null;
    }
    $myMutagen = new \phpMyEngine\Records\Mutagen ( $params['mutagen'] );
    $myValidateRules = $myMutagen->getValidateRules ();
    $myProperties = $myMutagen->getProperties ();

    foreach ($myProperties as $key) {
        if (isset ( $myValidateRules[$key]->formTag )) {
            $myFormElement = new \phpMyEngine\HTML\FormElement ( $myValidateRules[$key]->formTag );
            if (isset ( $myValidateRules[$key]->maxLength )) {
                $myFormElement->maxLength = (int) $myValidateRules[$key]->maxLength;
            }
            $myFormElement->name = $key;
            $value = isset($params['values'][$key]) ? $params['values'][$key] : null;
            $myFormElement->value = html_entity_decode ( $value );
            if ($myFormElement->type != 'hidden') {
                echo '<label>'.$key.':</label>';
            }
            echo $myFormElement;
            unset($myFormElement,$value);
        }
    }
    return null;
}