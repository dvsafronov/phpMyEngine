<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 10:02:21
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/menu/_tree.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13464745034d5a24fd4b2505-22129977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2623d98dd0dae04c5e9d9f517fd6e58c60288222' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/menu/_tree.tpl',
      1 => 1297753338,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13464745034d5a24fd4b2505-22129977',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cplink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.cplink.php';
?><?php if ($_smarty_tpl->getVariable('tree')->value){?>
<ul>
<?php  $_smarty_tpl->tpl_vars["href"] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tree')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["href"]->key => $_smarty_tpl->tpl_vars["href"]->value){
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["href"]->key;
?>
    <?php if ($_smarty_tpl->getVariable('name')->value!="#seporator#"){?>
    <li>
        <?php if (is_array($_smarty_tpl->getVariable('href')->value)){?>
        <?php echo $_smarty_tpl->getVariable('name')->value;?>

            
        <?php }else{ ?>
        <a href="<?php echo smarty_modifier_cplink($_smarty_tpl->getVariable('href')->value);?>
"><?php echo $_smarty_tpl->getVariable('name')->value;?>
</a>
        <?php }?>
    </li>
   <?php }else{ ?>
    <li class="seporator"></li>
   <?php }?>

<?php }} ?>
</ul>
<?php }?>