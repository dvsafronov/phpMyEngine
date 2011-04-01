<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 22:20:15
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/controlpanel/articles/statuschanged.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16250646574d5ad1ef9d15d6-39800010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30ae849efedb6c4d9911875b2727c9f3c8bed820' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/controlpanel/articles/statuschanged.tpl',
      1 => 1286529939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16250646574d5ad1ef9d15d6-39800010',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
    <?php }?>