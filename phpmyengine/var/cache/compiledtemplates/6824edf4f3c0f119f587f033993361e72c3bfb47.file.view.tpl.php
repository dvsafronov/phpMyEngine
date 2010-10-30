<?php /* Smarty version Smarty3-RC3, created on 2010-10-30 14:06:51
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/default/staticpage/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4598601194ccbee3bed7586-42705898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6824edf4f3c0f119f587f033993361e72c3bfb47' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/default/staticpage/view.tpl',
      1 => 1287928551,
    ),
  ),
  'nocache_hash' => '4598601194ccbee3bed7586-42705898',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_bbcode')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.bbcode.php';
?><div class="block">
    <h1><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</h1>
    <?php echo smarty_modifier_bbcode(nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('myRecord')->value->mutagenData->content,"htmlall")));?>

</div>