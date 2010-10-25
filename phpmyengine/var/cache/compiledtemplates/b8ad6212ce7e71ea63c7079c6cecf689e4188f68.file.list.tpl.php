<?php /* Smarty version Smarty3-RC3, created on 2010-10-24 18:21:13
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4714137574cc440d90e4e17-11982830%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8ad6212ce7e71ea63c7079c6cecf689e4188f68' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/staticpage/usr/templates/controlpanel/staticpage/list.tpl',
      1 => 1286528371,
    ),
  ),
  'nocache_hash' => '4714137574cc440d90e4e17-11982830',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
?><h2>List of static pages</h2>
<table class="list">
    <thead>
        <tr>
            <td width="10%">ID</td>
            <td>Заголовок</td>
            <td width="8%">Действия</td>
        </tr>
    </thead>
    <tbody>        
        <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['list']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['name'] = 'list';
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('recordsList')->value->records) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <td><?php echo $_smarty_tpl->getVariable('recordsList')->value->records[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]->_id;?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('recordsList')->value->records[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]->mutagenData->title;?>
</td>
            <td align="center">
                <a href="<?php echo smarty_modifier_cplink("staticpage/".($_smarty_tpl->getVariable('recordsList')->value->records[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]->_id)."/edit");?>
">
                   <img src="/design/controlpanel/images/icons/001_45.png" width="24" height="24">
                </a>
                <a href="<?php echo smarty_modifier_cplink("staticpage/".($_smarty_tpl->getVariable('recordsList')->value->records[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]->_id)."/delete");?>
">
                   <img src="/design/controlpanel/images/icons/001_05.png" width="24" height="24">
                </a>
            </td>
        </tr>
    <?php endfor; endif; ?>
    </tbody>
</table>