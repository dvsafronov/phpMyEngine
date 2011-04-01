<?php /* Smarty version Smarty-3.0.7, created on 2011-03-29 16:49:41
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/tags/cloud.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6061406514d91d5659133e0-75034833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a627effa0f3237a76e39049354077f9a912865d0' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/tags/cloud.tpl',
      1 => 1301402945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6061406514d91d5659133e0-75034833',
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