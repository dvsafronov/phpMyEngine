<?php /* Smarty version Smarty-3.0.7, created on 2011-02-14 18:52:31
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/tagcloud.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10485495684d594fbf0b03c4-72342823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d594b281065fdd748e58f64e75046a98bdf3331' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/tagcloud.tpl',
      1 => 1287929636,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10485495684d594fbf0b03c4-72342823',
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
        <a href="/tagsearch/<?php echo $_smarty_tpl->getVariable('mutagen')->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
" style="font-size: <?php echo $_smarty_tpl->tpl_vars['score']->value*0.24;?>
px"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</a>
<?php }} ?>
    </div>
</div>