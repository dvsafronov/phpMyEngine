<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 22:19:36
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/controlpanel/articles/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50945694d5ad1c8bd7809-71697668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57f664b1b699a0750102822aecfbe0f86331b829' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/controlpanel/articles/edit.tpl',
      1 => 1286544092,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50945694d5ad1c8bd7809-71697668',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_formelements')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.formelements.php';
if (!is_callable('smarty_insert_tags')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.tags.php';
?><h2>Add article</h2>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
    <?php }?>
<form action="#" method="POST" class="editrecord">
    <fieldset>
        <?php echo smarty_insert_formelements(array('mutagen' => ($_smarty_tpl->getVariable('mutagen')->value), 'values' => ($_smarty_tpl->getVariable('myRecord')->value->mutagenData->getValues())),$_smarty_tpl);?>

    </fieldset>
    <fieldset>
        <legend>Common properties</legend>
        <label>Tags:</label>
        <input type="text" id="tags" name="tags" value="<?php echo smarty_insert_tags(array('tags' => ($_smarty_tpl->getVariable('myRecord')->value->tags), 'action' => "list"),$_smarty_tpl);?>
">
               <label>Status:</label>
        <select name="status">
        </select>
    </fieldset>
    <input type="Submit" value="Save">
</form>