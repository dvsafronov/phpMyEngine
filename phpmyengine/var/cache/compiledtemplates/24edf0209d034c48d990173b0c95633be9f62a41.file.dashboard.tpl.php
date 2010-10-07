<?php /* Smarty version Smarty3-RC3, created on 2010-10-06 11:09:01
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9311187204cac208d026272-53112751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24edf0209d034c48d990173b0c95633be9f62a41' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/dashboard.tpl',
      1 => 1286032326,
    ),
  ),
  'nocache_hash' => '9311187204cac208d026272-53112751',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
?><h2>Dashboard</h2>
<ul>
    <li>
        <a href="<?php echo smarty_modifier_cplink("logs");?>
">Logs</a>
    </li>
</ul>