<?php /* Smarty version Smarty3-RC3, created on 2010-10-07 21:11:20
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3597478934cadff38b0a5a2-51268548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2c57508e5f58c727fce2fd1dbf7d8d1c9be71c1' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/footer.tpl',
      1 => 1286467997,
    ),
  ),
  'nocache_hash' => '3597478934cadff38b0a5a2-51268548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?></div>
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
<?php echo smarty_insert_widget(array('widget' => "googleanalytics"),$_smarty_tpl->smarty,$_smarty_tpl);?>

</body>
</html>