<?php

namespace phpMyEngine\SystemCity;

\phpMyEngine\Config\Config::getInstance()->load('system_city');

function getCities() {
    $list = (array) \phpMyEngine\Config\Config::getInstance()->systemCity;
    array_walk($list, function (&$item) {
        $item = (object) $item;
    });
    return $list;
}

function setCity($iNewCityID) {
    if ((int) $iNewCityID > 0) {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['system_city_id'] = (int) $iNewCityID;
        return setcookie('system_city_id', (int) $iNewCityID, time() - 100500, '/', $_SERVER['HTTP_HOST']);
    }
    return false;
}

function getCurrentCity() {
    if (!session_id()) {
        session_start();
    }
    if (!isset($_SESSION['system_city_id'])) {
        $_SESSION['system_city_id'] = 1;
    }
    return (int) $_SESSION['system_city_id'];
}

namespace phpMyEngine\Modules\SystemCity;
function getCities() {
    $list = \phpMyEngine\SystemCity\getCities();
    $res = [];
    foreach ($list as $item) {
        $res[$item->name] = $item->id;
    }
    return $res;
}