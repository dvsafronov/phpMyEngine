<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 10:19:51
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18333376174d5a2917c637c3-86788707%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37180d31b3dbbcc7d2d77bbad6e1d200633a5f56' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage/edit.tpl',
      1 => 1286528583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18333376174d5a2917c637c3-86788707',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_formelements')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.formelements.php';
?><h2>Add static page</h2>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
    <?php }?>
<form action="#" method="POST" class="editrecord">
    <fieldset>
        <?php echo smarty_insert_formelements(array('mutagen' => "staticpage", 'values' => ($_smarty_tpl->getVariable('myRecord')->value->mutagenData->getValues())),$_smarty_tpl);?>

    </fieldset>
    <input type="Submit" value="Save">
</form>