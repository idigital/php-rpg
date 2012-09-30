<?php /* Smarty version Smarty-3.0.8, created on 2011-06-20 12:18:20
         compiled from "../templates\admin-mapeditor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:237014dff80dccc3da0-80440619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '626f63477dbf4676577d0207b960065c0662ecc1' => 
    array (
      0 => '../templates\\admin-mapeditor.tpl',
      1 => 1308590296,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '237014dff80dccc3da0-80440619',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("admin_nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div id="admin_content">
<h1><?php echo $_smarty_tpl->getVariable('site_name')->value;?>
 Map Editor</h1>


	<div id="map_layout">
		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 99+1 - (0) : 0-(99)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
			<div class="map_tile" id="tile_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" onclick="clickTile(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
);">&nbsp;</div>
		<?php }} ?>
		<div style="clear: both;"></div>
	</div>

	<div id="layout_info">
		<center><b>Viewport</b></center><br />
		X <input type="text" size="3" id="orig_x" value="0" />, Y <input type="text" size="3" id="orig_y" value="0" /> <input type="button" value="Update" onclick="updateOrigin();" /><br />
		<input type="button" onclick="moveMap(0,1);" value="Up" /> <input type="button" onclick="moveMap(0,-1);" value="Down" /> <input type="button" onclick="moveMap(-1,0);" value="Left" /> <input type="button" onclick="moveMap(1,0);" value="Right" /><br />
		<br />
		<center><b>Tile Info</b></center>
		<table>
			<tr><td>ID</td><td><input type="text" id="tile_id" size="4" readonly="readonly" disabled="true"/></td></tr>
			<tr><td>Title</td><td><input type="text" id="tile_title" /></td></tr>
			<tr><td>Desc</td><td><textarea id="tile_desc" rows="5"></textarea></td></tr>
			<tr><td>X</td><td><input type="text" id="tile_x" readonly="readonly" size="3" disabled="true" /></td></tr>
			<tr><td>Y</td><td><input type="text" id="tile_y" readonly="readonly" size="3" disabled="true" /></td></tr>
			<tr><td>Z</td><td><input type="text" id="tile_z" readonly="readonly" size="3" disabled="true" /></td></tr>
			<tr><td>&nbsp;</td><td><input type="button" value="Save Tile" onclick="saveTile();" /></td></tr>
		</table>
	</div>


</div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>