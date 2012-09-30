<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 15:09:50
         compiled from "../templates\admin-mobeditor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:257734e121e0e5c7926-25814821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '040ff909a23f91d04bbc6e3f9571dc446f01b3a8' => 
    array (
      0 => '../templates\\admin-mobeditor.tpl',
      1 => 1309810187,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '257734e121e0e5c7926-25814821',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("admin_nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1>Mob Editor</h1>

<div style="float: left; width: 200px;">
<form method="get">
	<input type="button" value="New Mob" onclick="window.location='/admin/mobeditor/?new=1'" /> <input type="button" value="Load Mob" onclick="window.location='/admin/mobeditor/?mob_id=' + document.getElementById('mob_id').value" /><br />
	<select id="mob_id" multiple="multiple" size="25">
		<?php  $_smarty_tpl->tpl_vars['list_mob'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mobs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['list_mob']->key => $_smarty_tpl->tpl_vars['list_mob']->value){
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['list_mob']->value['mob_id'];?>
" <?php if ($_smarty_tpl->getVariable('mob')->value['mob_id']==$_smarty_tpl->tpl_vars['list_mob']->value['mob_id']){?>SELECTED<?php }?>><?php echo $_smarty_tpl->tpl_vars['list_mob']->value['mob_name'];?>
</option>
		<?php }} ?>
	</select>
</form>
</div>

<div style="float: right; width: 500px;">
	<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<table>
			<tr><td>Mob Id</td><td><input type="text" name="mob[mob_id]" readonly="true" value="<?php echo $_smarty_tpl->getVariable('mob')->value['mob_id'];?>
" size="5" /></td></tr>
			<tr><td>Mob Name</td><td><input type="text" name="mob[mob_name]" size="40" value="<?php echo $_smarty_tpl->getVariable('mob')->value['mob_name'];?>
" /></td></tr>
			<tr><td>Tile Id</td><td><input type="text" name="mob[tile_id]" size="5" value="<?php echo $_smarty_tpl->getVariable('mob')->value['tile_id'];?>
" /></td></tr>
			<tr><td>Avatar</td><td><img src="<?php echo $_smarty_tpl->getVariable('avatar_url')->value;?>
/mobs/<?php echo $_smarty_tpl->getVariable('mob')->value['mob_avatar'];?>
" /> <input type="file" name="new_avatar"></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" name="save" value="Save" /></td></tr>
		</table>
	</form>
</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>