<?php /* Smarty version Smarty3-RC3, created on 2010-10-02 21:56:35
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/staticpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10915934044ca77253be3073-74947821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6044b58c8d1e25a904022e5b6e67084e7b1abc01' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/default/staticpage.tpl',
      1 => 1286042194,
    ),
  ),
  'nocache_hash' => '10915934044ca77253be3073-74947821',
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