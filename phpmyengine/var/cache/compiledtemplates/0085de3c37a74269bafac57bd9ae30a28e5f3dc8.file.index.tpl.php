<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 09:59:44
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/cpauth/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18893151314d5a24609bbab3-49277992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0085de3c37a74269bafac57bd9ae30a28e5f3dc8' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/cpauth/index.tpl',
      1 => 1288437550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18893151314d5a24609bbab3-49277992',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_l10n')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.l10n.php';
if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
?><?php $_template = new Smarty_Internal_Template("_parts/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<div class="block auth">
    <h2><?php echo smarty_modifier_l10n("Need auth",'cpauth');?>
</h2>
    <?php if ($_smarty_tpl->getVariable('_messages')->value){?>
        <?php $_template = new Smarty_Internal_Template("_messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
    <?php }?>
    <form method="POST" action="<?php echo smarty_modifier_cplink("cpauth");?>
" class="editrecord">
        <label><?php echo smarty_modifier_l10n("Login",'cpauth');?>
:</label>
        <input type="text" name="login" value="<?php echo $_smarty_tpl->getVariable('cplogin')->value;?>
" />
        <label><?php echo smarty_modifier_l10n("Password",'cpauth');?>
:</label>
        <input type="password" name="password" />
        <input type="submit" value="<?php echo smarty_modifier_l10n("Enter",'cpauth');?>
" />
    </form>
</div>
<?php $_template = new Smarty_Internal_Template("_parts/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>