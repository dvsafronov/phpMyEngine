<?php /* Smarty version Smarty3-RC3, created on 2010-10-03 20:11:58
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/__controlpanel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12639741514ca8ab4e2ad4a0-82373326%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd36252f6f5f3c1298f5e98b95af9ae530ef035c3' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/var/templates/controlpanel/__controlpanel.tpl',
      1 => 1286122310,
    ),
  ),
  'nocache_hash' => '12639741514ca8ab4e2ad4a0-82373326',
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