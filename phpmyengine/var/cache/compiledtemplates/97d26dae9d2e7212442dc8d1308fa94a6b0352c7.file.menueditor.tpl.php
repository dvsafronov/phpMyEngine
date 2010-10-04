<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 20:16:59
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/menueditor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:447060174ca75afb5be365-17149517%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97d26dae9d2e7212442dc8d1308fa94a6b0352c7' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/menueditor.tpl',
      1 => 1286036218,
    ),
  ),
  'nocache_hash' => '447060174ca75afb5be365-17149517',
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