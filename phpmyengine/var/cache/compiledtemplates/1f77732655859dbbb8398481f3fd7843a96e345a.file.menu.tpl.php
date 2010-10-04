<?php /* Smarty version Smarty3-RC3, created on 2010-10-03 23:40:57
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/sidebarmenu/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10698887294ca8dc498b2524-84943321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f77732655859dbbb8398481f3fd7843a96e345a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/sidebarmenu/menu.tpl',
      1 => 1286123808,
    ),
  ),
  'nocache_hash' => '10698887294ca8dc498b2524-84943321',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu2">
<?php $_template = new Smarty_Internal_Template("sidebarmenu/_tree.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('tree',$_smarty_tpl->getVariable('menuItems')->value); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
