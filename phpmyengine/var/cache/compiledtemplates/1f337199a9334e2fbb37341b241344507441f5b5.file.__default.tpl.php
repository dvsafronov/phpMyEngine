<?php /* Smarty version Smarty-3.0.7, created on 2011-02-14 18:52:29
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18242434934d594fbda07d20-73742394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f337199a9334e2fbb37341b241344507441f5b5' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl',
      1 => 1287927823,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18242434934d594fbda07d20-73742394',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><?php $_template = new Smarty_Internal_Template("_parts/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<div class="grid_15 content">
                       <?php echo smarty_insert_widget(array('widget' => "controller"),$_smarty_tpl);?>

</div>
<div class="grid_1">&nbsp;</div>
<div class="grid_8 sidebar">
                    <?php $_template = new Smarty_Internal_Template("sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
</div>
<div class="clear"></div>
<?php $_template = new Smarty_Internal_Template("_parts/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>