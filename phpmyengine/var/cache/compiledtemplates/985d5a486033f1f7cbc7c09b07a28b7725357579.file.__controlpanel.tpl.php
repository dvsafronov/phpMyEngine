<?php /* Smarty version Smarty3-RC3, created on 2010-10-06 11:08:59
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/__controlpanel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5289205014cac208b5f5910-33399883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '985d5a486033f1f7cbc7c09b07a28b7725357579' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/__controlpanel.tpl',
      1 => 1286122310,
    ),
  ),
  'nocache_hash' => '5289205014cac208b5f5910-33399883',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_insert_widget')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/insert.widget.php';
?><?php $_template = new Smarty_Internal_Template("_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                <div id="westCoast">
                    <div class="block">
                        <?php echo smarty_insert_widget(array('widget' => "cpsidebarmenu"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                    </div>
                </div>
                <div id="eastCoast">
                    <div class="block">
                        <?php echo smarty_insert_widget(array('widget' => "controller"),$_smarty_tpl->smarty,$_smarty_tpl);?>

                    </div>
                </div>
                <div class="cls"></div>
            </div>
<?php $_template = new Smarty_Internal_Template("_footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>