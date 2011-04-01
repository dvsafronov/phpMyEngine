<?php

function smarty_modifier_cut ( $cont,$href = null,$text = "...&rarr;" ) {
    if (false !== ($cutpos = \strpos ( $cont, '[!-CUT-!]' ))) {
        $cont = \substr ( $cont,0, $cutpos );
        $cont .= "<a href=\"{$href}\">{$text}</a>";
    }
    return $cont;
}
