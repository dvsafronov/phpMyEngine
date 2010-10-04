<?php

function smarty_modifier_bbcode ( $cont ) {
    if (\extension_loaded ( 'bbcode' )) {
        $arrayBBCode = array (
            '' => array ('type' => BBCODE_TYPE_ROOT, 'childs' => '!i'),
            'i' => array ('type' => BBCODE_TYPE_NOARG, 'open_tag' => '<i>',
                'close_tag' => '</i>', 'childs' => 'b'),
            'url' => array ('type' => BBCODE_TYPE_OPTARG,
                'open_tag' => '<a href="{PARAM}">', 'close_tag' => '</a>',
                'default_arg' => '{CONTENT}',
                'childs' => 'b,i'),
            'img' => array ('type' => BBCODE_TYPE_NOARG,
                'open_tag' => '<img src="', 'close_tag' => '" />',
                'childs' => ''),
            'b' => array ('type' => BBCODE_TYPE_NOARG, 'open_tag' => '<b>',
                'close_tag' => '</b>'),
        );
        $BBHandler = bbcode_create ( $arrayBBCode );
        return bbcode_parse ( $BBHandler, $cont );
    } else {
        \phpMyEngine\logError("BBCode PHP-extension i'snt loaded");
    }
    return $cont;
}
