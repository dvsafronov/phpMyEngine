<?php /* Smarty version Smarty3-RC3, created on 2010-10-03 19:40:39
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/__default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12564930174ca8a3f75c6389-12838323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '398d1e2403008e6df1eb8b3d7ba759ed3e6449c6' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/__default.tpl',
      1 => 1286120438,
    ),
  ),
  'nocache_hash' => '12564930174ca8a3f75c6389-12838323',
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
            <div class="decor1"></div>
            <div id="header">
                <div id="headBar">
                    <a href="/">
                        <img src="/design/default/images/phpMyEngine24.png"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             width="144"
                             height="23"
                             />
                    </a>
                </div>
                <div id="menuBar">
                     <?php echo smarty_insert_widget(array('widget' => "menu"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                </div>
            </div>
            <div id="middle">
                <div id="westCoast">                   
                       <?php echo smarty_insert_widget(array('widget' => "controller"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                </div>
                <div id="eastCoast">
                    <?php $_template = new Smarty_Internal_Template("sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                </div>
                <div class="cls"></div>
            </div>
        </div>
        <div id="footer">
            <div class="divny">
                <div class="left">
                    <!--phpMyEngine::debugInfo/-->
                </div>
                <div class="middle">
                    &copy; 2010 phpMyEngine
                </div>
                <div class="right">
                    <a href="http://mcdb.ru/phpmyengine/">
                        <img src="/design/default/images/phpMyEngine32.png"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             width="144"
                             height="32"
                             />
                    </a>
                </div>
                <div class="cls"></div>
            </div>
        </div>
    </body>
</html>