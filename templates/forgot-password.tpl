{include file="header.tpl"}
<h1>Forgot Password</h1>
<form action="forgot-password" method="post">
<input type="hidden" name="doit" value="1">
If you have forgotten your password enter your e-mail address below and a password change e-mail will be sent to you.<br />
<br/>
Email Address: <input type="text" name="email_address" value="" size="30" /><br />
<input type="submit" value="Reset Password" />
</form>
{include file="footer.tpl"}