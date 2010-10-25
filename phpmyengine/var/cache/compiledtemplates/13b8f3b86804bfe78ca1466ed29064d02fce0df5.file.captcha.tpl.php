<?php /* Smarty version Smarty3-RC3, created on 2010-10-24 18:04:45
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/captcha/usr/templates/default/captcha.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12968097724cc43cfd35cc93-04337936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13b8f3b86804bfe78ca1466ed29064d02fce0df5' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/captcha/usr/templates/default/captcha.tpl',
      1 => 1287422601,
    ),
  ),
  'nocache_hash' => '12968097724cc43cfd35cc93-04337936',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<label>Код на картинке:</label>
<p>
    <img src="<?php echo $_smarty_tpl->getVariable('captcha')->value;?>
">
</p>
<input type="text" name="captcha" value="">
<br />