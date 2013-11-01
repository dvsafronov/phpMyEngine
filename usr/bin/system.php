<?php

namespace phpMyEngine\systemController;

function changecityAction() {
    $_myRoute = \phpMyEngine\Route::getInstance();
    \phpMyEngine\SystemCity\setCity((int) $_myRoute->newCityID);
    \phpMyEngine\doRedirect('/');
    return null;
}
