<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 22:37:48
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:767862724d5ad60cbdb826-66507042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb2ca0e2006f293ceee6fecdce54bfb472016255' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/preview.tpl',
      1 => 1297798663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '767862724d5ad60cbdb826-66507042',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_bbcode')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.bbcode.php';
if (!is_callable('smarty_modifier_cut')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cut.php';
?><div class="block">
    <h2>
        <a href="/articles/<?php echo $_smarty_tpl->getVariable('myRecord')->value->_id;?>
/view" title="<?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
"><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</a>
    </h2>
    <?php echo smarty_modifier_cut(smarty_modifier_bbcode(nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('myRecord')->value->mutagenData->content,"htmlall"))),"/articles/".($_smarty_tpl->getVariable('myRecord')->value->_id)."/view");?>

    <?php $_template = new Smarty_Internal_Template("articles/_recordinfo.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
</div>