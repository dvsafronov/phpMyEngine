<?php /* Smarty version Smarty3-RC3, created on 2010-10-19 21:15:19
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16267661924cbdd22759a760-26449194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b1d971fc2413ce0dd0c62be7f9822c2076d5bee' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/_header.tpl',
      1 => 1286572323,
    ),
  ),
  'nocache_hash' => '16267661924cbdd22759a760-26449194',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="/design/controlpanel/style.css" />
        <title>phpMyEngine Control Panel</title>
    </head>
    <body>
        <div id="gspot">
            <div id="header">
                <div id="headBar">
                    <a href="<?php echo smarty_modifier_cplink("/");?>
">
                    <img src="/design/controlpanel/images/phpMyEngineCP.png"
                         alt="phpMyEngine"
                         title="phpMyEngine"
                         width="156"
                         height="36"
                         />
                    </a>
                </div>
                <div id="menuBar">
                    <?php echo smarty_insert_widget(array('widget' => "menu"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                </div>
            </div>
            <div id="middle">