<?php /* Smarty version Smarty-3.0.7, created on 2011-03-29 12:23:38
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/widgets/pagination/pages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2044184094d91970a615437-41248718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27b862a57b32c2d5df3c742b15a983bf4d5320b3' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/widgets/pagination/pages.tpl',
      1 => 1301387016,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2044184094d91970a615437-41248718',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('paginationCount')->value>1){?>
<div class="_paginationList grid_14">
    <h4>Страницы: (всего <?php echo $_smarty_tpl->getVariable('paginationCount')->value;?>
)</h4>
    <ul class="_pagination">
        <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['page']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['name'] = 'page';
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('paginationCount')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['page']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['page']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['page']['total']);
?>
        <li>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['page']['index']+1!=$_smarty_tpl->getVariable('paginationCurPage')->value){?>
            <a href="<?php echo $_smarty_tpl->getVariable('paginationHREF')->value;?>
/page<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['page']['index']+1;?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['page']['index']+1;?>
</a>
            <?php }else{ ?>
            <span class="curPage"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['page']['index']+1;?>
</span>
            <?php }?>
        </li>
        &nbsp;
        <?php endfor; endif; ?>
    </ul>
    <ul class="_pagination">
        <?php if ($_smarty_tpl->getVariable('paginationCount')->value>12&&$_smarty_tpl->getVariable('paginationCurPage')->value!=1){?>
        <li><a class="fal" href="<?php echo $_smarty_tpl->getVariable('paginationHREF')->value;?>
/page1">Первая</a></li>
        <?php }?>

        <?php if ($_smarty_tpl->getVariable('paginationCurPage')->value!=1){?>
        <li><a href="<?php echo $_smarty_tpl->getVariable('paginationHREF')->value;?>
/page<?php echo $_smarty_tpl->getVariable('paginationCount')->value;?>
">&larr; Предыдущая</a></li>
        <?php }?>

        <?php if ($_smarty_tpl->getVariable('paginationCurPage')->value!=$_smarty_tpl->getVariable('paginationCount')->value){?>
        <li><a href="<?php echo $_smarty_tpl->getVariable('paginationHREF')->value;?>
/page<?php echo $_smarty_tpl->getVariable('paginationCount')->value;?>
">Следующая &rarr;</a></li>
        <?php }?>

        <?php if ($_smarty_tpl->getVariable('paginationCount')->value>12&&$_smarty_tpl->getVariable('paginationCurPage')->value!=$_smarty_tpl->getVariable('paginationCount')->value){?>
        <li><a class="fal" href="<?php echo $_smarty_tpl->getVariable('paginationHREF')->value;?>
/page<?php echo $_smarty_tpl->getVariable('paginationCount')->value;?>
">Последняя</a></li>
        <?php }?>
    </ul>
</div>

<div class="_paginatioForm grid_1">
    <form action="/pagination" method="post" title="Перейти на страницу">
        <input type="hidden" name="href" value="<?php echo $_smarty_tpl->getVariable('paginationHREF')->value;?>
">
        <input type="text" name="pagenumber" value="0"> <input type="submit" value="&rarr;">
    </form>
</div>

<div class="clear"></div>
<?php }?>