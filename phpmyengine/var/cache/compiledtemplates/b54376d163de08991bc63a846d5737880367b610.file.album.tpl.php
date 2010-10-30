<?php /* Smarty version Smarty3-RC3, created on 2010-10-30 21:12:44
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/picasa/usr/templates/default/picasa/album.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10953708114ccc520cf037e4-79706120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b54376d163de08991bc63a846d5737880367b610' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/picasa/usr/templates/default/picasa/album.tpl',
      1 => 1288458715,
    ),
  ),
  'nocache_hash' => '10953708114ccc520cf037e4-79706120',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('album')->value->title;?>
</h1>
<?php  $_smarty_tpl->tpl_vars["image"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('album')->value->images; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["image"]->key => $_smarty_tpl->tpl_vars["image"]->value){
?>
<a href="<?php echo $_smarty_tpl->getVariable('image')->value->fullURL;?>
" rel="picasa" style="background: url(<?php echo $_smarty_tpl->getVariable('image')->value->thumbURL;?>
)">
    <img src="<?php echo $_smarty_tpl->getVariable('image')->value->thumbURL;?>
"
         width="<?php echo $_smarty_tpl->getVariable('image')->value->thumbWidth;?>
" height="<?php echo $_smarty_tpl->getVariable('image')->value->thumbHeight;?>
"
         alt="<?php echo $_smarty_tpl->getVariable('image')->value->title;?>
" title="<?php echo $_smarty_tpl->getVariable('image')->value->title;?>
" />
</a>
<?php }} ?>
<div class="clear"></div>
<style type="text/css">
    a[rel="picasa"] {
        display: block;
        width: 144px;
        height: 120px;
        float: left;
        text-align: center;
        border: 1px solid #ccc;
        margin: 0 12px 12px 0;
        padding: 6px;
    }
    a[rel="picasa"] img {
        display: none;
    }
</style>