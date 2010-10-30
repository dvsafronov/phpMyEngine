<?php /* Smarty version Smarty3-RC3, created on 2010-10-30 16:02:13
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/logs/log.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20086771424ccc09457f6438-97654912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40f0a7748d4f3e5754a187288e89734f35a826bf' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/logs/log.tpl',
      1 => 1286035835,
    ),
  ),
  'nocache_hash' => '20086771424ccc09457f6438-97654912',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_cycle')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/function.cycle.php';
?><h2>View log for <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('logDate')->value,"%A, %e %b, %Y");?>
</h2>
<table class="list">
    <thead>
        <tr>
            <td width="10%">Time</td>
            <td width="*">Description</td>
            <td width="30%">URI</td>
            <td width="12%">IP</td>
        </tr>
    </thead>
    <tbody>
        <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['list']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['name'] = 'list';
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('logContent')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total']);
?>
        <tr <?php echo smarty_function_cycle(array('values'=>',class="sec"'),$_smarty_tpl->smarty,$_smarty_tpl);?>
>
            <td><?php echo $_smarty_tpl->getVariable('logContent')->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']][0];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('logContent')->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']][3];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('logContent')->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']][1];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('logContent')->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']][2];?>
</td>
        </tr>
        <?php endfor; endif; ?>
    </tbody>
</table>
