<?php /* Smarty version Smarty3-RC3, created on 2010-10-26 23:17:03
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__debug.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2403303104cc7292f8b0042-03180275%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f17390181a64a5b4086a056bb5cdcb4d0de60503' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/__debug.tpl',
      1 => 1288120622,
    ),
  ),
  'nocache_hash' => '2403303104cc7292f8b0042-03180275',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container_24" style="margin-bottom: 24px;font-size: 11px">
    <div class="grid_8">
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
    <div class="grid_8">
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
    <div class="grid_8">
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
    <div class="clear"></div>
</div>
