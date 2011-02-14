<?php /*%%SmartyHeaderCode:12070414674d5950053d99d4-58520727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '12070414674d5950053d99d4-58520727',
  'has_nocache_code' => false,
  'cache_lifetime' => 12,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?><div class="person">
    <p>
        <a href="/person/auth" class="signin">Войти</a> или <a href="/person/registration" class="signup">зарегистрироваться</a>
    </p>
    <p class="resetpwd">
        Быть может, Вы <a href="/person/resetpassword">забыли пароль?</a>
    </p>
</div><?php } ?>