<?php /* Smarty version Smarty-3.0.7, created on 2011-02-14 18:53:39
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18371909274d595003cc02c5-96589295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '18371909274d595003cc02c5-96589295',
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo '/*%%SmartyNocache:18371909274d595003cc02c5-96589295%%*/<?php if (!is_callable(\'smarty_insert_widget\')) include \'/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php\';
?>/*/%%SmartyNocache:18371909274d595003cc02c5-96589295%%*/';?>
<?php $_template = new Smarty_Internal_Template("_parts/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<div class="grid_15 content">
                       <?php echo Smarty_Internal_Nocache_Insert::compile ('smarty_insert_widget',array('widget' => "controller"), $_smarty_tpl, 'null');?>

</div>
<div class="grid_1">&nbsp;</div>
<div class="grid_8 sidebar">
                    <?php $_template = new Smarty_Internal_Template("sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
</div>
<div class="clear"></div>
<?php $_template = new Smarty_Internal_Template("_parts/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>