<?php /* Smarty version Smarty3-RC3, created on 2010-10-08 20:30:59
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5534634574caf47436ee7b7-11693533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcdbecbc5d6af05eb6338208b9482cfbec1e6c84' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl',
      1 => 1286555458,
    ),
  ),
  'nocache_hash' => '5534634574caf47436ee7b7-11693533',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="/design/default/style.css" />
        <title></title>
    </head>
    <body>
        <div class="ad"></div>
        <div id="gspot">
            <div id="header">
                <div id="headBar">
                    <a href="/">
                        <img src="/design/default/images/phpMyEngine24.png"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             
                             height="36"
                             />
                    </a>
                </div>
                <div id="menuBar">
                     <?php echo smarty_insert_widget(array('widget' => "menu"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                </div>
            </div>
            <div id="middle">