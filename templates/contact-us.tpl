{include file="header.tpl"}
<h1>Contact {$site_name}</h1>
Please fill out the following form to send an e-mail to {$site_name}. All fields are required.<br />
<br />
<form action="{$site_url}/contact-us" method="post">
<input type="hidden" name="doit" value="1" />
<table>
	<tr><td align="right">Name</td><td><input type="text" name="contact[name]" size="40" value="{$contact.name}"/></td></tr>
	<tr><td align="right">Email</td><td><input type="text" name="contact[email]" size="40" value="{$contact.email}" /></td></tr>
	<tr><td align="right">Phone #</td><td><input type="text" name="contact[phone]" value="{$contact.phone}" /></td></tr>
	<tr><td align="right">Subject</td><td>
															<select name="contact[subject]">
																<option value="General Question">General Question</option>
															</select>
														</td>
	</tr>
	<tr><td align="right">Message</td><td><textarea name="contact[message]" cols="35" rows="5">{$contact.message}</textarea></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="Send" /></td></tr>
</table>
</form>
{include file="footer.tpl"}