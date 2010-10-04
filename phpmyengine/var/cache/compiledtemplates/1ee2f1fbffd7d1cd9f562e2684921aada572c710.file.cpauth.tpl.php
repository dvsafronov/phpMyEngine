<?php /* Smarty version Smarty3-RC3, created on 2010-10-03 18:52:04
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/cpauth.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13673241684ca898944ff124-31367050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ee2f1fbffd7d1cd9f562e2684921aada572c710' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/cpauth.tpl',
      1 => 1286117519,
    ),
  ),
  'nocache_hash' => '13673241684ca898944ff124-31367050',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
?><?php $_template = new Smarty_Internal_Template("_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="block auth">
    <h2>Need auth</h2>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <?php }?>
    <form method="POST" action="<?php echo smarty_modifier_cplink("cpauth");?>
" class="editrecord">
        <label>Login:</label>
        <input type="text" name="login" value="<?php echo $_smarty_tpl->getVariable('cplogin')->value;?>
" />
        <label>Password:</label>
        <input type="password" name="password" />
        <input type="submit" value="Send" />
</div>
</form>
<?php $_template = new Smarty_Internal_Template("_footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>