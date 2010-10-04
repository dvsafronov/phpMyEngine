<?php

function smarty_insert_tags ( $params ) {
    if (is_array ( $params['tags'] )) {
        return implode ( ', ', $params['tags'] );
    }
}
