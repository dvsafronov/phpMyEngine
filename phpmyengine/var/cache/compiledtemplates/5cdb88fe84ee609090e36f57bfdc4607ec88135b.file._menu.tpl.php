<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 18:15:22
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6795783964ca73e7a210a91-82037262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cdb88fe84ee609090e36f57bfdc4607ec88135b' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/_menu.tpl',
      1 => 1284794143,
    ),
  ),
  'nocache_hash' => '6795783964ca73e7a210a91-82037262',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="menu">
<ul>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('index') ?<?php ?>>">Dashboard</a></li>
    <li>|</li>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('information') ?<?php ?>>">Информация</a></li>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('staff') ?<?php ?>>">Сотрудники</a></li>
    <li>|</li>
	<li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('tickets') ?<?php ?>>">Трекер</a>
        <ul>
            <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('tickets',null,'add') ?<?php ?>>">Создать задачу</a></li>
        </ul>
	</li>
	<li>
	   <a href="/<<?php ?>?php echo $_W12ROUTER->toURI('reports') ?<?php ?>>">Отчёты</a>
        <ul>
            <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('reports',null,'add') ?<?php ?>>">Написать отчёт</a></li>
            <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('reports',null,'my') ?<?php ?>>">Мои отчёты</a></li>
            <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('reports',null,'department') ?<?php ?>>">Отчёты отдела</a></li>
        </ul>
	</li>
	<li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('gallerycategory') ?<?php ?>>">TODO-лист</a></li>
    <li>|</li>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('blogcategory') ?<?php ?>>">Форум</a></li>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('blogcategory') ?<?php ?>>">Блоги</a></li>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('gallerycategory') ?<?php ?>>">Галереи</a></li>
    <li><a href="/<<?php ?>?php echo $_W12ROUTER->toURI('gallerycategory') ?<?php ?>>">Желания</a></li>
</ul>
</div>