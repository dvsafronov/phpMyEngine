<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 20:30:01
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/menu/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18337114514ca75e09619067-27044899%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e06089021e5645583d581bd365d51b6799d16321' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/menu/menu.tpl',
      1 => 1286037000,
    ),
  ),
  'nocache_hash' => '18337114514ca75e09619067-27044899',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu">
<?php $_template = new Smarty_Internal_Template("menu/_tree.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('tree',$_smarty_tpl->getVariable('menuItems')->value); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
