<?php /* Smarty version Smarty-3.0.7, created on 2011-02-16 11:33:29
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/picasa/usr/templates/controlpanel/picasa/config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2598996734d5b8bd9c1dd55-65750197%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62ebc18815514c1b2871fa3ff48fa5d27fde236a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/picasa/usr/templates/controlpanel/picasa/config.tpl',
      1 => 1297845198,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2598996734d5b8bd9c1dd55-65750197',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form method="POST" action="#">
    <fieldset>
        <legend>Settings</legend>
        <label>User:</label><input type="text" name="user" value="<?php echo $_smarty_tpl->getVariable('settings')->value->user;?>
">
        <label>Force album (ID):</label><input type="text" name="forceAlbum" value="<?php echo $_smarty_tpl->getVariable('settings')->value->forceAlbum;?>
">
        <label>Thumb width:</label><input type="text" name="width" value="<?php echo $_smarty_tpl->getVariable('settings')->value->width;?>
">
        <label>Full width:</label><input type="text" name="width" value="<?php echo $_smarty_tpl->getVariable('settings')->value->fullWidth;?>
">
        <label>Cache time:</label><input type="text" name="width" value="<?php echo $_smarty_tpl->getVariable('settings')->value->cache;?>
">
    </fieldset>
    <input type="submit" value="Save">
</form>