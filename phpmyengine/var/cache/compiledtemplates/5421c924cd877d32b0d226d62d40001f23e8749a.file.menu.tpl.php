<?php /* Smarty version Smarty-3.0.7, created on 2011-04-02 01:01:10
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/menu/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5161821704d963d1643a674-93095342%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5421c924cd877d32b0d226d62d40001f23e8749a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/menu/menu.tpl',
      1 => 1297698800,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5161821704d963d1643a674-93095342',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu">
    <?php $_template = new Smarty_Internal_Template("menu/_tree.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('tree',$_smarty_tpl->getVariable('menuItems')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
</div>
