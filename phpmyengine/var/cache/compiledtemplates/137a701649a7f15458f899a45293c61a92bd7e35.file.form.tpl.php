<?php /* Smarty version Smarty-3.0.7, created on 2011-03-29 20:07:40
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/tags/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1339294834d9203cc142216-19527159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '137a701649a7f15458f899a45293c61a92bd7e35' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/opt/articles/usr/templates/default/articles/tags/form.tpl',
      1 => 1301414859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1339294834d9203cc142216-19527159',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="/articles/tagsearch/" method="GET">
    <label for="tag" class="title">Тег: </label>
    <input type="text" value="<?php echo $_smarty_tpl->getVariable('tag')->value;?>
" name="t"> <input type="submit" value="Найти">
</form>