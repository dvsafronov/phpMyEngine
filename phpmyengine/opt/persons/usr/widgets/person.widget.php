<?php
namespace phpMyEngine\Widgets;

function personWidget () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    return $_myRender->renderTemplate('persons/widget.tpl');
}
