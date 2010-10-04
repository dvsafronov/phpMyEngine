<?php /* Smarty version Smarty3-RC3, created on 2010-10-03 23:51:49
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9479332324ca8ded5224475-16398913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c94acbd4a4329fd54d720838a8ada975f82db45b' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage_edit.tpl',
      1 => 1286021628,
    ),
  ),
  'nocache_hash' => '9479332324ca8ded5224475-16398913',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_formelements')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.formelements.php';
if (!is_callable('smarty_insert_tags')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.tags.php';
?><h2>Add static page</h2>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <?php }?>
<form action="#" method="POST" class="editrecord">
    <fieldset>
        <?php echo smarty_insert_formelements(array('mutagen' => "staticpage", 'values' => ($_smarty_tpl->getVariable('myRecord')->value->mutagenData->getValues())),$_smarty_tpl->smarty,$_smarty_tpl);?>

    </fieldset>
    <fieldset>
        <legend>Common properties</legend>
        <label>Tags:</label>
        <input type="text" id="tags" name="tags" value="<?php echo smarty_insert_tags(array('tags' => ($_smarty_tpl->getVariable('myRecord')->value->tags), 'action' => "list"),$_smarty_tpl->smarty,$_smarty_tpl);?>
"  maxlength="120">
               <label>Status:</label>
        <select name="status">
        </select>
    </fieldset>
    <input type="Submit" value="Save">
</form>