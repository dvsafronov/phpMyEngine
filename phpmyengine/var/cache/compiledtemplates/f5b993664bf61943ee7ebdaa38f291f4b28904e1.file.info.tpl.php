<?php /* Smarty version Smarty-3.0.7, created on 2011-03-31 01:17:35
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/category/info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:539526064d939def62e7a0-72814463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5b993664bf61943ee7ebdaa38f291f4b28904e1' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/category/info.tpl',
      1 => 1301519854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '539526064d939def62e7a0-72814463',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_sitelink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.sitelink.php';
?><div class="block">
    <h3><?php echo $_smarty_tpl->getVariable('category')->value->title;?>
</h3>
    <p><?php echo $_smarty_tpl->getVariable('category')->value->announcement;?>
</p>
    <p><a href="<?php echo smarty_modifier_sitelink("articles/categories");?>
">все категории</a></p>
</div>