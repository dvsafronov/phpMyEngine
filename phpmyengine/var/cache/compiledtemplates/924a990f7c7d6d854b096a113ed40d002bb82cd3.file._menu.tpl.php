<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 18:15:21
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19643860924ca73e79923233-31100022%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '924a990f7c7d6d854b096a113ed40d002bb82cd3' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/_menu.tpl',
      1 => 1285574175,
    ),
  ),
  'nocache_hash' => '19643860924ca73e79923233-31100022',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu">
<?php $_template = new Smarty_Internal_Template("_menutree.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('tree',$_smarty_tpl->getVariable('menuItems')->value); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
