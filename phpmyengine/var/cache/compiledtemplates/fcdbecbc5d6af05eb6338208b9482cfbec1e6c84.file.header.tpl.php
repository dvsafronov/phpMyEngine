<?php /* Smarty version Smarty3-RC3, created on 2010-10-08 23:56:09
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16031647874caf775947f844-55643002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcdbecbc5d6af05eb6338208b9482cfbec1e6c84' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl',
      1 => 1286567763,
    ),
  ),
  'nocache_hash' => '16031647874caf775947f844-55643002',
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
        <div id="header">
            <div id="headBar">
                <div class="gspot">
                    <a href="/">
                        <img src="/design/default/images/phpMyEngine36.png"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             width="216"
                             height="36"
                             />
                    </a>
                </div>
            </div>
            <div id="menuBar">
                <div class="gspot">
                     <?php echo smarty_insert_widget(array('widget' => "menu"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                </div>
            </div>
        </div>        
        <div id="middle">
            <div class="gspot">