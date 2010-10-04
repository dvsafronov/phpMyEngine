<?php /* Smarty version Smarty3-RC3, created on 2010-10-03 23:47:40
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/staticpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8590408164ca8dddcae3e30-02677634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '610298c26cd1ec9163301cab07ab21a21c8e7d7a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/staticpage.tpl',
      1 => 1286042194,
    ),
  ),
  'nocache_hash' => '8590408164ca8dddcae3e30-02677634',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_bbcode')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.bbcode.php';
?><div class="block">
    <h2><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</h2>
    <?php echo smarty_modifier_bbcode(nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('myRecord')->value->mutagenData->content,"htmlall")));?>

</div>