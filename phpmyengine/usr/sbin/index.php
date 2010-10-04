<?php
namespace phpMyEngine\indexController;

function defaultAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance();
    $_myRender->renderTemplate('dashboard.tpl');
}