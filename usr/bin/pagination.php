<?php

$_myRender = \phpMyEngine\Render\Render::getInstance ();
$pageNumber = (integer) filter_input ( INPUT_POST, 'pagenumber', FILTER_VALIDATE_INT );
$href = (string) filter_input ( INPUT_POST, 'href' );
header ( 'Status: 301', true );
header ( 'Location: ' . $href . '/page' . $pageNumber, true );