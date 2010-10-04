<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 18:32:23
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/var/templates/controlpanel/staticpage_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8444701574ca74277a4f0f3-33189238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '955fa5acb721043fa40b16faa9b8e6a48d97703d' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/var/templates/controlpanel/staticpage_view.tpl',
      1 => 1286021628,
    ),
  ),
  'nocache_hash' => '8444701574ca74277a4f0f3-33189238',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</h2>
<?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->content;?>
