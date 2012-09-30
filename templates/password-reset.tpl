{include file="header.tpl"}
<h1>Reset Password</h1>
Choose a new password.<br /><br />
<form action="{$site_url}/forgot-password/?reset=1" method="post">
<input type="hidden" name="user_id" value="{$user_id}" />
<input type="hidden" name="email" value="{$email}" />
<input type="hidden" name="code" value="{$code}" />
New Password <input type="password" name="new_password" /><br />
Retype New Password <input type="password" name="new_password2" /><br />
<input type="submit" value="Reset Password" />
</form>
{include file="footer.tpl"}