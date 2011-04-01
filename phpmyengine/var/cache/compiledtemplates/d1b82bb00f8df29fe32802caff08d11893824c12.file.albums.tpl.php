<?php /* Smarty version Smarty-3.0.7, created on 2011-02-17 12:50:32
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/gallerytemplates/usr/templates/default/gallerytemplates/albums.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30260244d5cef6877eba6-73777402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1b82bb00f8df29fe32802caff08d11893824c12' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/gallerytemplates/usr/templates/default/gallerytemplates/albums.tpl',
      1 => 1297844732,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30260244d5cef6877eba6-73777402',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Альбомы</h2>

<?php  $_smarty_tpl->tpl_vars["album"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('albums')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["album"]->key => $_smarty_tpl->tpl_vars["album"]->value){
?>

<div class="grid_15 albumLine">
    <div class="grid_4 albumIcon">
        <a href="<?php echo $_smarty_tpl->getVariable('album')->value->id;?>
/view" style="background-image: url(<?php echo $_smarty_tpl->getVariable('album')->value->cover;?>
)">
            <span></span>
        </a>
    </div>
    <div class="grid_10 albumInfo">
        <h3><a href="<?php echo $_smarty_tpl->getVariable('album')->value->id;?>
/view" title="<?php echo $_smarty_tpl->getVariable('album')->value->title;?>
"><?php echo $_smarty_tpl->getVariable('album')->value->title;?>
</a></h3>
        <span>Изображений: <?php echo $_smarty_tpl->getVariable('album')->value->count;?>
</span>
    </div>
    <div class="clear"></div>
</div>
<?php }} ?>
<style type="text/css">
    
    div.albumLine {
        margin-bottom: 24px;background: #F6F6F2;
    }
    div.albumIcon a {
        width: 128px;
        height: 128px;        
        display: block;
        border-radius: 8px;
        -moz-border-radius: 8px;
        border: 1px solid #eee;
        background: url() no-repeat center;
    }
    div.albumInfo h3 {
        margin: 0;
        padding: 0;
        }
    div.albumInfo span {
        font-size: 12px;
        }
    
</style>