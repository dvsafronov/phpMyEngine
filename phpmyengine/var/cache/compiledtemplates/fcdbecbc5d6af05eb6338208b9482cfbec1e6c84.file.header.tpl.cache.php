<?php /* Smarty version Smarty-3.0.7, created on 2011-02-14 18:53:40
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11694110944d5950041f3180-80503252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcdbecbc5d6af05eb6338208b9482cfbec1e6c84' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/header.tpl',
      1 => 1297697933,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11694110944d5950041f3180-80503252',
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo '/*%%SmartyNocache:11694110944d5950041f3180-80503252%%*/<?php if (!is_callable(\'smarty_insert_css\')) include \'/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.css.php\';
if (!is_callable(\'smarty_insert_widget\')) include \'/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php\';
?>/*/%%SmartyNocache:11694110944d5950041f3180-80503252%%*/';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
    <head>
        <title>phpMyEngine. Бесплатная CMS с открытым исходным кодом. Opensource PHP CMS. Официальный сайт</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="/css/960_24_col.css" />
        <link rel="stylesheet" type="text/css" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/css/text.css" />
        <?php echo Smarty_Internal_Nocache_Insert::compile ('smarty_insert_css',array('file' => "/skins/".($_smarty_tpl->getVariable('__skin')->value)."/css/".($_smarty_tpl->getVariable('__skin')->value).".css"), $_smarty_tpl, 'null');?>

        <?php echo Smarty_Internal_Nocache_Insert::compile ('smarty_insert_css',array('file' => "/skins/".($_smarty_tpl->getVariable('__skin')->value)."/css/navigation.css"), $_smarty_tpl, 'null');?>

        <?php echo Smarty_Internal_Nocache_Insert::compile ('smarty_insert_css',array('file' => "/skins/".($_smarty_tpl->getVariable('__skin')->value)."/css/style.css"), $_smarty_tpl, 'null');?>

    </head>
    <body>
        <div id="advertising_banner">
        
        </div>
        <div id="header">
            <div class="container_24 headbar">
                <div class="grid_10">
                    <a href="/">
                        <img src="/skins/<?php echo $_smarty_tpl->getVariable('__skin')->value;?>
/images/pmelogo.png"
                             width="238"
                             height="36"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             />
                    </a>
                </div>
                <div class="grid_14">
                    <?php echo Smarty_Internal_Nocache_Insert::compile ('smarty_insert_widget',array('widget' => "person"), $_smarty_tpl, 'null');?>

                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="navigation">
            <div class="container_24">
                <?php echo Smarty_Internal_Nocache_Insert::compile ('smarty_insert_widget',array('widget' => "menu"), $_smarty_tpl, 'null');?>

            </div>
            <div class="clear"></div>
        </div>

        <div id="middle">
            <div class="container_24">

