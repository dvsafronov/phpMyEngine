<?php /* Smarty version Smarty3-RC3, created on 2010-10-08 19:54:47
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9726691284caf3ec7f141c6-56455563%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f337199a9334e2fbb37341b241344507441f5b5' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl',
      1 => 1286553276,
    ),
  ),
  'nocache_hash' => '9726691284caf3ec7f141c6-56455563',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><?php $_template = new Smarty_Internal_Template("_parts/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <div id="westCoast">
                       <?php echo smarty_insert_widget(array('widget' => "controller"),$_smarty_tpl->smarty,$_smarty_tpl);?>

    </div>
    <div id="eastCoast">
                    <?php $_template = new Smarty_Internal_Template("sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    </div>
    <div class="cls"></div>
<?php $_template = new Smarty_Internal_Template("_parts/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>