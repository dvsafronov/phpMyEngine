<?php /* Smarty version Smarty-3.0.7, created on 2011-04-02 01:03:48
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/_recordinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186586454d963db4c86eb3-99660431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aadd783345426b7aadd74f018b7cc10a1e7e726a' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/_recordinfo.tpl',
      1 => 1301399677,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186586454d963db4c86eb3-99660431',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_sitelink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.sitelink.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.date_format.php';
?>    <?php if ($_smarty_tpl->getVariable('myRecord')->value->tags){?>
<div class="tags">
    <span></span>
    <ul>
        <?php  $_smarty_tpl->tpl_vars["value"] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('myRecord')->value->tags; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["value"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["value"]->iteration=0;
if ($_smarty_tpl->tpl_vars["value"]->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["value"]->key => $_smarty_tpl->tpl_vars["value"]->value){
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["value"]->key;
 $_smarty_tpl->tpl_vars["value"]->iteration++;
 $_smarty_tpl->tpl_vars["value"]->last = $_smarty_tpl->tpl_vars["value"]->iteration === $_smarty_tpl->tpl_vars["value"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tags"]['last'] = $_smarty_tpl->tpl_vars["value"]->last;
?>
        <li>
            <a href="<?php echo smarty_modifier_sitelink("articles/tagsearch/".($_smarty_tpl->getVariable('value')->value));?>
"><?php echo $_smarty_tpl->getVariable('value')->value;?>
</a>
                <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['tags']['last']){?>
            ,
                <?php }?>
        </li>
        <?php }} ?>
    </ul>
</div>
<div class="clear"></div>
    <?php }?>
<div class="recordInfo">
    <div class="votePositive">
        <a href="#" title="+">+</a>
    </div>
    <div class="votes">+<?php echo $_smarty_tpl->getVariable('myRecord')->value->ratingPositive;?>
 / -<?php echo $_smarty_tpl->getVariable('myRecord')->value->ratingNegative;?>
</div>
    <div class="voteNegative">
        <a href="#" title="-">-</a>
    </div>
    <div class="username">
        <span></span> <a href="#"><?php echo $_smarty_tpl->getVariable('username')->value;?>
--</a>
    </div>
    <div class="date">
        <span></span>
        <a href="/articles/archive/<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('myRecord')->value->getCreationTime(),"%d-%m-%Y");?>
">
                <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('myRecord')->value->getCreationTime(),"%A, %e %b %Y, %H:%M");?>

        </a>
    </div>
    <div class="favorites"><a href="#"><span>*</span></a></div>
    <div class="link"><a href="#"><span>#</span></a></div>
    <div class="comments"><span></span> 3200</div>
</div>