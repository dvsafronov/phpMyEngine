<?php
namespace phpMyEngine\Widgets;

function sharesWidget ($vertical = false) {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRender->renderTemplate ( 'widgets/shares/horizontal.tpl' );
}
