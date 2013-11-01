<?php

namespace phpMyEngine\Template;

$g = '\phpMyEngine\Template\g';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <?php
    r()->addCss('/cult-affiche/css/style.css');
    r()->addCss('/3dparty/bootstrap/css/bootstrap.min.css');
    r()->addCss('/cult-affiche/css/style2.css');
    r()->addCss('/cp/css/font-awesome.min.css');
    r()->addCss('/3dparty/flagsprites/css/flags.css');
    ?>

    <link rel="shortcut icon" href="/cult-affiche/img/favicon.png">

    <script type="text/javascript" src="/3dparty/jquery/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/3dparty/jquery/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/3dparty/bootstrap/js/bootstrap.min.js"></script>

    <title></title>
</head>
<body>
<section id="wrapper">
    <header>
        <div id="advertising_banner"></div>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <?php
                    $_cityList = (array) \phpMyEngine\SystemCity\getCities();
                    $_curCity = \phpMyEngine\SystemCity\getCurrentCity();
                    ?>
                    <ul class="nav">
                        <li class="dropdown" id="pmeSystemCity">
                            <a href="#" class="dropdown-toggle" style="padding-left: 0"
                               data-toggle="dropdown">
                                <img class="flag flag-ru">
                                <?= $_cityList["city_".$_curCity]->name ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                foreach ($_cityList as $_cityObject):
                                    if ((int) $_cityObject->id !== $_curCity):
                                        ?>
                                        <li>
                                            <a href="/system/changecity/<?= (int) $_cityObject->id ?>">
                                                <img class="flag flag-ru"> <?= $_cityObject->name ?>
                                            </a>
                                        </li>
                                    <?php
                                    endif;
                                endforeach;
                                unset($_cityList, $_curCity);
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <?php r()->insertWidget('menu') ?>
                    <?php r()->insertWidget('person') ?>
                </div>
            </div>
        </div>
        <div id="cultHeader">
            <div class="container">
                <h1 class="pull-left">
                    <a class="logo" href="/">
                        <i></i>
                        Культ-Афиша
                    </a>
                </h1>
                <a class="beta pull-left" href="/staticpage/beta/" title="Это бэта-версия сайта. Кликните для того, чтобы узнать подробнее, что это значит.">beta</a>

                <div class="ad_banner pull-right">
                    <img src="/shared/ad/abstract-q-c-468-60-9.jpg" width="468" height="60">
                </div>
            </div>
        </div>
        <?php r()->insertWidget('breadcrumb') ?>
    </header>
    <section id="middle">
        <div class="container">
