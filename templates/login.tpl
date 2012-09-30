{include file="header.tpl"}
<h1>Login</h1>
<table width="90%">
	<tr>
		<td>
			Please login using your e-mail address and password.<br>
			<br />
			<form action="{$site_url}/login" method="post">				
				<input type="hidden" name="doit" value="1">
				<table>
					<tr><td>Email:</td><td><input type="text" name="login[email]" value="{$login.email}" id="email"></td></tr>
					<tr><td>Password:</td><td><input type="password" name="login[password]" value=""></td></tr>					
					<tr><td><input type="submit" value="Login"></td><td>&nbsp;</td></tr>
					<tr><td colspan="2"><a href="{$site_url}/forgot-password">I Forgot My Password</a></td></tr>
				</table>
			</form>
		</td>
		<td width="15">
			&nbsp;
		</td>
		<td align="center">
			If you have not already signed up, you can sign up now for a FREE 30 Day Trial.<br />
			<br />
			<a href="{$site_url}/signup"><img src="{$image_url}/sign-up.png" /></a>
		</td>
	</tr>
</table>
<script language="javascript">
	document.getElementById('email').focus();
</script>
{include file="footer.tpl"}
