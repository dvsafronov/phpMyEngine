<?php /* Smarty version Smarty-3.0.7, created on 2011-04-02 01:01:08
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6975486504d963d14c09d63-07560930%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f337199a9334e2fbb37341b241344507441f5b5' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl',
      1 => 1301511449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6975486504d963d14c09d63-07560930',
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
                    <?php echo smarty_insert_widget(array('widget' => "sidebar"),$_smarty_tpl);?>

</div>
<div class="clear"></div>
<?php $_template = new Smarty_Internal_Template("_parts/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>