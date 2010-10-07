<?php /* Smarty version Smarty3-RC3, created on 2010-10-07 12:09:17
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11125554974cad802d874055-81821062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '873bcbcbfc5291fb7518bbf751a1120712fc8b5f' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage_view.tpl',
      1 => 1286021628,
    ),
  ),
  'nocache_hash' => '11125554974cad802d874055-81821062',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</h2>
<?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->content;?>
