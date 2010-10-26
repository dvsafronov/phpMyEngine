<?php
namespace phpMyEngine\configureController;

use phpMyEngine;
use phpMyEngine\l10n as _;
use phpMyEngine\Route;
use phpMyEngine\Config\Config;
use phpMyEngine\Render\Render;
use phpMyEngine\ControlPanel;

function defaultAction () {
    $_myRender = Render::getInstance();
    $_myRender->renderTemplate('configure/index.tpl');
}
