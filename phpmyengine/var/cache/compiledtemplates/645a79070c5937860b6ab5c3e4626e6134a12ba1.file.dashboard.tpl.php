<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 19:12:07
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4723263054ca74bc74b25e5-15642623%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '645a79070c5937860b6ab5c3e4626e6134a12ba1' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/dashboard.tpl',
      1 => 1286032326,
    ),
  ),
  'nocache_hash' => '4723263054ca74bc74b25e5-15642623',
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