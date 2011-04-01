<?php /* Smarty version Smarty-3.0.7, created on 2011-03-29 19:17:37
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/captcha/usr/templates/default/captcha.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10882170444d91f811f2cd64-24969846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13b8f3b86804bfe78ca1466ed29064d02fce0df5' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/captcha/usr/templates/default/captcha.tpl',
      1 => 1287422601,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10882170444d91f811f2cd64-24969846',
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