<?php /* Smarty version Smarty3-RC3, created on 2010-10-26 23:11:23
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6520160794cc727db97edd3-31363938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2c57508e5f58c727fce2fd1dbf7d8d1c9be71c1' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/_parts/footer.tpl',
      1 => 1288120282,
    ),
  ),
  'nocache_hash' => '6520160794cc727db97edd3-31363938',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?></div>
</div>

<div id="footer">
    <div  class="container_24">
        <div class="grid_8">
            &nbsp;
        </div>
        <div class="grid_8">
            &copy; 2010 phpMyEngine
        </div>
        <div class="grid_8">
            <a href="http://mcdb.ru/phpmyengine/">
                <img src="/controlpanel/images/phpMyEngine88x31.png"
                     alt="phpMyEngine"
                     title="phpMyEngine"
                     width="88"
                     height="31"
                     />
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--phpMyEngine::debugInfo/-->
<?php echo smarty_insert_widget(array('widget' => "googleanalytics"),$_smarty_tpl->smarty,$_smarty_tpl);?>

</body>
</html>