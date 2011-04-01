<?php /* Smarty version Smarty-3.0.7, created on 2011-03-29 19:17:36
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/persons/usr/templates/default/persons/registration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:985047644d91f810aa8cd9-53603199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f7f131111db0b32789c8bf8a0eff7921120354c' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/persons/usr/templates/default/persons/registration.tpl',
      1 => 1287470679,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '985047644d91f810aa8cd9-53603199',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><div class="block">
    <h2>Регистрация</h2>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
    <?php }?>
    <form method="POST" action="#">
        <label>Логин:</label>
        <input type="text" name="login">

        <label>Пароль:</label>
        <input type="password" name="password">

        <label>Повторите пароль:</label>
        <input type="password" name="rpassword">

        <?php echo smarty_insert_widget(array('widget' => "captcha"),$_smarty_tpl);?>


        <input type="submit" value="Зарегистрироваться">
    </form>
</div>