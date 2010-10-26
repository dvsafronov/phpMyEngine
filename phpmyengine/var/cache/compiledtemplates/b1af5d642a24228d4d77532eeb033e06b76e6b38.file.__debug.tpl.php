<?php /* Smarty version Smarty3-RC3, created on 2010-10-26 23:18:16
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/__debug.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19374548114cc729783a5da8-94277585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1af5d642a24228d4d77532eeb033e06b76e6b38' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/__debug.tpl',
      1 => 1288120694,
    ),
  ),
  'nocache_hash' => '19374548114cc729783a5da8-94277585',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="margin-bottom: 24px;font-size: 11px">
    <div style="float:left;margin-right: 24px;padding-bottom: 24px;">
        <b>Общие</b>:<br>
        Время генерации: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['genTime'];?>
 сек<br>
        Использовано памяти: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['memory'];?>
 Кб<br>
        Вложено файлов: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['includedFiles'];?>
 шт.<br>
        Размер HTML: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['HTML'];?>
Кб<br>

    </div>
    <div style="float:left;margin-right: 24px;padding-bottom: 24px;">
        <b>База данных</b>:<br>
        Профиль: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['dbProfile'];?>
<br>
        Тип: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['dbType'];?>
<br>
        Запросов: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['dbSuccessQueries'];?>
 / <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['dbErrorQueries'];?>
<br>
        Время: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['dbTime'];?>
 сек<br>
    </div>
    <div style="float:left">
        <b>Кэш:</b><br>
        Профиль: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['cacheProfile'];?>
<br>
        Тип: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['cacheType'];?>
<br>
        Запросов: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['cacheSuccessQueries'];?>
 / <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['cacheErrorQueries'];?>
<br>
        Время: <?php echo $_smarty_tpl->getVariable('_debugInfo')->value['cacheTime'];?>
 сек<br>
    </div>
    <div style="clear: both"></div>
</div>
