<?php /* Smarty version Smarty-3.0.7, created on 2011-02-16 11:14:33
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/picasa/usr/templates/default/picasa/albums.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19462073014d5b87697d91c4-33991019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1b50ad7e4049b5c5f66493812a198ac2c24064c' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/picasa/usr/templates/default/picasa/albums.tpl',
      1 => 1297844044,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19462073014d5b87697d91c4-33991019',
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