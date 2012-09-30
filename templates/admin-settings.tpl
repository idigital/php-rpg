{include file="header.tpl"}
{include file="admin_nav.tpl"}
<form action="/admin/settings" method="post">
<input type="hidden" name="doit" value="1" />
<table>
	<tr><th>Setting</th><th>Value</th></tr>
{foreach from=$settings item="val" key="key"}
	<tr><td>{$key}</td><td><input type="text" name="settings[{$key}]" size="30" value="{$val}" /></td></tr>
{/foreach}
	<tr><td>&nbsp;</td><td><input type="submit" value="Save" /></td></tr>
</table>
</form>
{include file="footer.tpl"}