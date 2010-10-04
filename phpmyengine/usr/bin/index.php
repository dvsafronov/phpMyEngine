<?php
namespace phpMyEngine\indexController;

function defaultAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    echo 2;
    $x = new \phpMyEngine\Persons\Profile('user');
}
