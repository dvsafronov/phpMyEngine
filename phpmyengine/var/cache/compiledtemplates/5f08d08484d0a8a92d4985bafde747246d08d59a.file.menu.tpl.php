<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 09:59:45
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/menu/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6944095664d5a2461a079e9-89843468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f08d08484d0a8a92d4985bafde747246d08d59a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/menu/menu.tpl',
      1 => 1286037000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6944095664d5a2461a079e9-89843468',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu">
<?php $_template = new Smarty_Internal_Template("menu/_tree.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('tree',$_smarty_tpl->getVariable('menuItems')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
</div>
