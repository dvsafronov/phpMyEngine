<?php /* Smarty version Smarty3-RC3, created on 2010-10-24 18:13:58
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/tagcloud.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2371265934cc43f265abd11-72329044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d594b281065fdd748e58f64e75046a98bdf3331' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/tagcloud.tpl',
      1 => 1287929636,
    ),
  ),
  'nocache_hash' => '2371265934cc43f265abd11-72329044',
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
if (count($_from) > 0){
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