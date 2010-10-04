<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 20:31:54
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/menu/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15113972694ca75e7a53ee83-12323361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1aaa2a866a76889b280c191f59223e860abf27a7' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/menu/menu.tpl',
      1 => 1286037033,
    ),
  ),
  'nocache_hash' => '15113972694ca75e7a53ee83-12323361',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu">
<?php $_template = new Smarty_Internal_Template("menu/_tree.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('tree',$_smarty_tpl->getVariable('menuItems')->value); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
