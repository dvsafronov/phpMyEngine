<?php /* Smarty version Smarty-3.0.7, created on 2011-02-14 18:52:30
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/persons/usr/templates/default/persons/widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4538585624d594fbeaa38b1-58282511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce64ead9802a8caa10b7e6de0e27103b389a684b' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/persons/usr/templates/default/persons/widget.tpl',
      1 => 1287432207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4538585624d594fbeaa38b1-58282511',
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