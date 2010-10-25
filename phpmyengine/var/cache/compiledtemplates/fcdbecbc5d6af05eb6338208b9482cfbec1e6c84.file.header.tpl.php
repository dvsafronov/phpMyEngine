<?php /* Smarty version Smarty3-RC3, created on 2010-10-24 17:44:26
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:911571354cc4383a237dd5-46036499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcdbecbc5d6af05eb6338208b9482cfbec1e6c84' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl',
      1 => 1287927864,
    ),
  ),
  'nocache_hash' => '911571354cc4383a237dd5-46036499',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
    <head>
        <title>phpMyEngine. Бесплатная CMS с открытым исходным кодом. Opensource PHP CMS. Официальный сайт</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="/css/960_24_col.css" />
        <link rel="stylesheet" type="text/css" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/css/text.css" />
        <link rel="stylesheet" type="text/css" href="/skins/coldblue/css/coldblue.css" />
        <link rel="stylesheet" type="text/css" href="/skins/coldblue/css/navigation.css" />
        <link rel="stylesheet" type="text/css" href="/skins/coldblue/css/style.css" />
    </head>
    <body>
        <div id="advertising_banner"></div>
        <div id="header">
            <div class="container_24 headbar">
                <div class="grid_10">
                    <a href="/">
                        <img src="/skins/coldblue/images/pmelogo.png"
                             width="238"
                             height="36"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             />
                    </a>
                </div>
                <div class="grid_14">
                    <?php echo smarty_insert_widget(array('widget' => "person"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="navigation">
            <div class="container_24">
                <?php echo smarty_insert_widget(array('widget' => "menu"),$_smarty_tpl->smarty,$_smarty_tpl);?>

            </div>
            <div class="clear"></div>
        </div>

        <div id="middle">
        <div class="container_24">

