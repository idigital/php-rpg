{include file="header.tpl"}
{include file="admin_nav.tpl"}
<div id="admin_content">
<h1>{$site_name} Map Editor</h1>


	<div id="map_layout">
		{for $i=0 to 99}
			<div class="map_tile" id="tile_{$i}" onclick="clickTile({$i});">&nbsp;</div>
		{/for}
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
{include file="footer.tpl"}