<?php /* Smarty version Smarty3-RC3, created on 2010-10-26 23:35:36
         compiled from "/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/configure/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6407251584cc72d882f2822-51856973%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1ac3e6b61a6638fab5d13b8c664799759390abd' => 
    array (
      0 => '/home/desigency/web/dev/phpmyengine.dev/phpmyengine/usr/templates/controlpanel/configure/index.tpl',
      1 => 1288121733,
    ),
  ),
  'nocache_hash' => '6407251584cc72d882f2822-51856973',
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