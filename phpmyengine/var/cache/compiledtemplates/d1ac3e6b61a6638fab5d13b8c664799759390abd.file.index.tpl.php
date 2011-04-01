<?php /* Smarty version Smarty-3.0.7, created on 2011-02-15 10:18:13
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/configure/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18682732744d5a28b57397d2-63352069%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1ac3e6b61a6638fab5d13b8c664799759390abd' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/configure/index.tpl',
      1 => 1288121733,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18682732744d5a28b57397d2-63352069',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Configure</h2>
<form action="#" method="POST">
    <fieldset>
        <legend>Design</legend>
        <select name="skin">
            <option>coldblue</option>
            <option>modern</option>
        </select>
    </fieldset>

    <fieldset>
        <legend>Ad</legend>
    </fieldset>

    <fieldset>
        <legend>Statistics</legend>
        <fieldset>
            <legend><input type="checkbox" id="useGA" name="useGA"> <label for="useGA">Google Analytics</label></legend>
            <label>ID:</label>
            <input type="text" name="gaCode" value="<?php echo $_smarty_tpl->getVariable('gaCode')->value;?>
">
        </fieldset>
        <fieldset>
            <legend><input type="checkbox" id="useYAM" name="useYAM"> <label for="useYAM">Яндекс.Метрика</label></legend>
            <label>ID:</label>
            <input type="text" name="yamCode" value="<?php echo $_smarty_tpl->getVariable('yamCode')->value;?>
">
        </fieldset>
    </fieldset>

    <input type="submit" value="Save">
</form>