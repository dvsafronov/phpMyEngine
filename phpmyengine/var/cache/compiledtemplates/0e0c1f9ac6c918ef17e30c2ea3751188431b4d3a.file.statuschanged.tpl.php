<?php /* Smarty version Smarty3-RC3, created on 2010-10-24 22:07:10
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage/statuschanged.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4776060164cc475ce98b2e1-77808494%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e0c1f9ac6c918ef17e30c2ea3751188431b4d3a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage/statuschanged.tpl',
      1 => 1286528370,
    ),
  ),
  'nocache_hash' => '4776060164cc475ce98b2e1-77808494',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <?php }?>