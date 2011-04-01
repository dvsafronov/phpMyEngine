<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 22:47:19
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/widgets/shares/horizontal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9846598724d5ad84783df08-04313815%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d9e7966e78ba2d803d9bf41090726e6c071f926' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/default/widgets/shares/horizontal.tpl',
      1 => 1297799238,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9846598724d5ad84783df08-04313815',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="clear"></div>
<div id="share">
    <div class="grid_4">
        
        <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>
        <script type="text/javascript"><!--
                document.write(VK.Share.button(false,{type: "round", text: "Сохранить"}));
        --></script>
        
    </div>
    <div class="grid_6">
        <script type="text/javascript">
                document.write('<iframe src="http://www.facebook.com/plugins/like.php?href=' + document.URL
                + '&amp;layout=button_count&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&height=24" scrolling="no" frameborder="0" style="border:none; overflow:hidden;height:24px"></iframe>' );
        </script>
    </div>

    <div class="grid_4">
        <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    </div>
    <div class="clear"></div>
</div>