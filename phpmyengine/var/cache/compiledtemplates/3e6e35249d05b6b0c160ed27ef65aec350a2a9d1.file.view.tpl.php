<?php /* Smarty version Smarty3-RC3, created on 2010-10-08 21:59:34
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15153085284caf5c06b18721-93490250%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e6e35249d05b6b0c160ed27ef65aec350a2a9d1' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/view.tpl',
      1 => 1286560772,
    ),
  ),
  'nocache_hash' => '15153085284caf5c06b18721-93490250',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_bbcode')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.bbcode.php';
if (!is_callable('smarty_modifier_sitelink')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smartyplugins/modifier.sitelink.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/lib/smarty/plugins/modifier.date_format.php';
?><div class="block">
    <h2><?php echo $_smarty_tpl->getVariable('myRecord')->value->mutagenData->title;?>
</h2>
    <?php echo smarty_modifier_bbcode(nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('myRecord')->value->mutagenData->content,"htmlall")));?>

    <?php if ($_smarty_tpl->getVariable('myRecord')->value->tags){?>
    <div class="tags">
        <span></span>
        <ul>
        <?php  $_smarty_tpl->tpl_vars["value"] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('myRecord')->value->tags; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["value"]->total=($_from instanceof Traversable)?iterator_count($_from):count($_from);
 $_smarty_tpl->tpl_vars["value"]->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tags"]['total'] = $_smarty_tpl->tpl_vars["value"]->total;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["value"]->key => $_smarty_tpl->tpl_vars["value"]->value){
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["value"]->key;
 $_smarty_tpl->tpl_vars["value"]->iteration++;
 $_smarty_tpl->tpl_vars["value"]->last = $_smarty_tpl->tpl_vars["value"]->iteration === $_smarty_tpl->tpl_vars["value"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tags"]['last'] = $_smarty_tpl->tpl_vars["value"]->last;
?>
            <li>
                <a href="<?php echo smarty_modifier_sitelink("tagsearch/Article/".($_smarty_tpl->getVariable('value')->value));?>
"><?php echo $_smarty_tpl->getVariable('value')->value;?>
</a>
                <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['tags']['last']){?>
                ,
                <?php }?>
            </li>
        <?php }} ?>
        </ul>
    </div>
    <div class="cls"></div>
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
</a>
        </div>
        <div class="date">
            <span></span>
            <a href="/archive/<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('myRecord')->value->getCreationTime(),"%d%m%Y");?>
">
                <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('myRecord')->value->getCreationTime(),"%A, %e %b %Y, %H:%M");?>

            </a>
        </div>
        <div class="favorites"><a href="#"><span>*</span></a></div>
        <div class="link"><a href="#"><span>#</span></a></div>
        <div class="comments"><span></span> 3200</div>
    </div>
</div>