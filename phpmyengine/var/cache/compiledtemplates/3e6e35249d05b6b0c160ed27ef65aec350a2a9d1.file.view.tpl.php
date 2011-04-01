<?php /* Smarty version Smarty-3.0.7, created on 2011-03-31 01:28:56
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13754249934d93a0980ee9e7-48644172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e6e35249d05b6b0c160ed27ef65aec350a2a9d1' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/view.tpl',
      1 => 1301520535,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13754249934d93a0980ee9e7-48644172',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_bbcode')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.bbcode.php';
if (!is_callable('smarty_modifier_cutcut')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cutcut.php';
if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><div class="block">
    <?php if ($_smarty_tpl->getVariable('categoryTitle')->value){?>
    <h2 class="catTitle"><a href="/articles/category/<?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->category;?>
/list"><?php echo $_smarty_tpl->getVariable('categoryTitle')->value;?>
</a></h2>
        <?php }?>
    <h2><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</h2>

    <?php echo smarty_modifier_cutcut(smarty_modifier_bbcode(nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('myRecord')->value->mutagenData->content,"htmlall"))));?>

    <?php $_template = new Smarty_Internal_Template("articles/_recordinfo.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
        <?php echo smarty_insert_widget(array('widget' => "shares"),$_smarty_tpl);?>

</div>
