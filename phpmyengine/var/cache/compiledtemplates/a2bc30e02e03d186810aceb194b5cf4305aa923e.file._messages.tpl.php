<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 10:19:52
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/_messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5895037804d5a2918241a18-14464627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2bc30e02e03d186810aceb194b5cf4305aa923e' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/_messages.tpl',
      1 => 1285691895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5895037804d5a2918241a18-14464627',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('_messages')->value->caErrors>0){?>
<div class="block _messages error">
    <ul>
    <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['error']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['name'] = 'error';
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('_messages')->value->errors) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['error']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['error']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['error']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['error']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['error']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['error']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['error']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['error']['total']);
?>
        <li><?php echo $_smarty_tpl->getVariable('_messages')->value->errors[$_smarty_tpl->getVariable('smarty')->value['section']['error']['index']];?>
</li>
    <?php endfor; endif; ?>
    </ul>
</div>
<?php }?>

<?php if ($_smarty_tpl->getVariable('_messages')->value->caWarnings>0){?>
<div class="block _messages warning">
    <ul>
    <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['name'] = 'warning';
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('_messages')->value->warnings) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['warning']['total']);
?>
        <li><?php echo $_smarty_tpl->getVariable('_messages')->value->warnings[$_smarty_tpl->getVariable('smarty')->value['section']['warning']['index']];?>
</li>
    <?php endfor; endif; ?>
    </ul>
</div>
<?php }?>

<?php if ($_smarty_tpl->getVariable('_messages')->value->caMessages>0){?>
<div class="block _messages">
    <ul>
    <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['message']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['name'] = 'message';
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('_messages')->value->messages) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['message']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['message']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['message']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['message']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['message']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['message']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['message']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['message']['total']);
?>
        <li><?php echo $_smarty_tpl->getVariable('_messages')->value->messages[$_smarty_tpl->getVariable('smarty')->value['section']['message']['index']];?>
</li>
    <?php endfor; endif; ?>
    </ul>
</div>
<?php }?>
