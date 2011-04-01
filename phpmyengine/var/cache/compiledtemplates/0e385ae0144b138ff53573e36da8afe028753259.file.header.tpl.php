<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 09:59:45
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/_parts/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7668934764d5a246151b083-68858588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e385ae0144b138ff53573e36da8afe028753259' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/_parts/header.tpl',
      1 => 1288118909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7668934764d5a246151b083-68858588',
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
        <link rel="stylesheet" type="text/css" href="/controlpanel/style.css" />
        <title>phpMyEngine Control Panel</title>
    </head>
    <body>
        <div id="gspot">
            <div id="header">
                <div id="headBar">
                    <a href="<?php echo smarty_modifier_cplink("/");?>
">
                    <img src="/controlpanel/images/phpMyEngineCP.png"
                         alt="phpMyEngine"
                         title="phpMyEngine"
                         width="156"
                         height="36"
                         />
                    </a>
                </div>
                <div id="menuBar">
                    <?php echo smarty_insert_widget(array('widget' => "menu"),$_smarty_tpl);?>

                </div>
            </div>
            <div id="middle">