<?php /* Smarty version Smarty-3.0.7, created on 2011-03-29 16:48:42
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/widgets/tagcloud.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7922771214d91d52ac67eb6-87026484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '399bc0d56b4291f3f701d7d6c31b2f2c2da86dc0' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/widgets/tagcloud.tpl',
      1 => 1301402921,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7922771214d91d52ac67eb6-87026484',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="block">
    <div class="tagCloud">
<?php  $_smarty_tpl->tpl_vars['score'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tagCloud')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['score']->key => $_smarty_tpl->tpl_vars['score']->value){
 $_smarty_tpl->tpl_vars['tag']->value = $_smarty_tpl->tpl_vars['score']->key;
?>
        <a href="/articles/tagsearch/<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
" style="font-size: <?php echo $_smarty_tpl->tpl_vars['score']->value*0.24;?>
px"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</a>
<?php }} ?>
    </div>
</div>