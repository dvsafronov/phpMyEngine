<?php /* Smarty version Smarty3-RC3, created on 2010-10-30 15:32:45
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/captcha/usr/templates/default/captcha.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19798660894ccc025d601bf1-47466332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13b8f3b86804bfe78ca1466ed29064d02fce0df5' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/captcha/usr/templates/default/captcha.tpl',
      1 => 1287422601,
    ),
  ),
  'nocache_hash' => '19798660894ccc025d601bf1-47466332',
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