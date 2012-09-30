{include file="header.tpl"}
{include file="admin_nav.tpl"}
<h1>Mob Editor</h1>

<div style="float: left; width: 200px;">
<form method="get">
	<input type="button" value="New Mob" onclick="window.location='/admin/mobeditor/?new=1'" /> <input type="button" value="Load Mob" onclick="window.location='/admin/mobeditor/?mob_id=' + document.getElementById('mob_id').value" /><br />
	<select id="mob_id" multiple="multiple" size="25">
		{foreach from=$mobs item=list_mob}
			<option value="{$list_mob.mob_id}" {if $mob.mob_id==$list_mob.mob_id}SELECTED{/if}>{$list_mob.mob_name}</option>
		{/foreach}
	</select>
</form>
</div>

<div style="float: right; width: 500px;">
	<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<table>
			<tr><td>Mob Id</td><td><input type="text" name="mob[mob_id]" readonly="true" value="{$mob.mob_id}" size="5" /></td></tr>
			<tr><td>Mob Name</td><td><input type="text" name="mob[mob_name]" size="40" value="{$mob.mob_name}" /></td></tr>
			<tr><td>Tile Id</td><td><input type="text" name="mob[tile_id]" size="5" value="{$mob.tile_id}" /></td></tr>
			<tr><td>Avatar</td><td><img src="{$avatar_url}/mobs/{$mob.mob_avatar}" /> <input type="file" name="new_avatar"></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" name="save" value="Save" /></td></tr>
		</table>
	</form>
</div>

{include file="footer.tpl"}