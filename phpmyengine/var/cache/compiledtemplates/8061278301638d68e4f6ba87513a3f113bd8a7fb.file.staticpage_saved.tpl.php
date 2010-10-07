<?php /* Smarty version Smarty3-RC3, created on 2010-10-06 11:10:31
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage_saved.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9477749184cac20e75167b0-14619133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8061278301638d68e4f6ba87513a3f113bd8a7fb' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage_saved.tpl',
      1 => 1286021628,
    ),
  ),
  'nocache_hash' => '9477749184cac20e75167b0-14619133',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <?php }?>