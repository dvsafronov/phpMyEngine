<?php /* Smarty version Smarty3-RC3, created on 2010-10-30 14:06:40
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/persons/usr/templates/default/persons/widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2816477614ccbee30e0fee0-86119548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce64ead9802a8caa10b7e6de0e27103b389a684b' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/persons/usr/templates/default/persons/widget.tpl',
      1 => 1287432207,
    ),
  ),
  'nocache_hash' => '2816477614ccbee30e0fee0-86119548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_sitelink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.sitelink.php';
?><div class="person">
    <p>
        <a href="<?php echo smarty_modifier_sitelink("person/auth");?>
" class="signin">Войти</a> или <a href="<?php echo smarty_modifier_sitelink("person/registration");?>
" class="signup">зарегистрироваться</a>
    </p>
    <p class="resetpwd">
        Быть может, Вы <a href="<?php echo smarty_modifier_sitelink("person/resetpassword");?>
">забыли пароль?</a>
    </p>
</div>