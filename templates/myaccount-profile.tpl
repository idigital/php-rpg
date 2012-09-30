{include file="header.tpl"}
{include file="my_account_nav.tpl"}
<h1>My Profile</h1>
<form action="myaccount/profile?user_id={$user.user_id}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<input type="hidden" name="doit" value="1" />
<table>
	<tr><td align="right">Character Name</td><td><input type="text" name="user[user_cname]" size="30" value="{$user.user_cname}" readonly="true"></td></tr>
	<tr><td align="right">Avatar</td><td><img src="{$avatar_url}/{$user.user_avatar}" /> <input type="file" name="new_avatar"></td></tr>
		
		<tr><td colspan="2>&nbsp;<br /><br /></td></tr>
		<tr><td colspan="2"><br /><b>Login Information</b></td></tr>
		<tr><td align="right">E-Mail</td><td><input type="text" name="user[user_email]" size="20" value="{$user.user_email}"></td></tr>
		<tr><td align="right">Change Password</td><td><input type="password" name="user[user_password]" size="20" value=""></td></tr>
		<tr><td align="right">Retype Password</td><td><input type="password" name="user[user_password2]" size="20" value=""></td></tr>
		<tr><td align="right"><input type="submit" name="submit" value="Save Changes"></td><td>&nbsp</td></tr>
</table>
</form>
{include file="footer.tpl"}