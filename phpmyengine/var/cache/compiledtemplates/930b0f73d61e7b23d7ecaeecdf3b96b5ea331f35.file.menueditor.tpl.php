<?php /* Smarty version Smarty3-RC3, created on 2010-10-26 23:07:33
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/menueditor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15786876334cc726f585fac5-92950573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '930b0f73d61e7b23d7ecaeecdf3b96b5ea331f35' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/menueditor.tpl',
      1 => 1286036218,
    ),
  ),
  'nocache_hash' => '15786876334cc726f585fac5-92950573',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
?><h2>Menu editor</h2>
<form method="POST" action="<?php echo smarty_modifier_cplink("menueditor");?>
">
    <textarea name="menufile" rows="24" cols="1"><?php echo $_smarty_tpl->getVariable('menuFileContent')->value;?>
</textarea>
    <input type="submit" value="Save">
</form>