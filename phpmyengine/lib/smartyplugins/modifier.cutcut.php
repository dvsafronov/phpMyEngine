<?php

function smarty_modifier_cutcut ( $cont ) {
    return \str_replace ( '[!-CUT-!]', null, $cont );
}
