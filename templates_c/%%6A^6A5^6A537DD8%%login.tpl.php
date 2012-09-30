<?php /* Smarty version 2.6.19, created on 2011-05-12 22:35:47
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Login</h1>
<table width="90%">
	<tr>
		<td>
			Please login using your e-mail address and password.<br>
			<br />
			<form action="<?php echo $this->_tpl_vars['site_url']; ?>
/login" method="post">				
				<input type="hidden" name="doit" value="1">
				<table>
					<tr><td>Email:</td><td><input type="text" name="login[email]" value="<?php echo $this->_tpl_vars['login']['email']; ?>
" id="email"></td></tr>
					<tr><td>Password:</td><td><input type="password" name="login[password]" value=""></td></tr>					
					<tr><td><input type="submit" value="Login"></td><td>&nbsp;</td></tr>
					<tr><td colspan="2"><a href="<?php echo $this->_tpl_vars['site_url']; ?>
/forgot-password">I Forgot My Password</a></td></tr>
				</table>
			</form>
		</td>
		<td width="15">
			&nbsp;
		</td>
		<td align="center">
			If you have not already signed up, you can sign up now for a FREE 30 Day Trial.<br />
			<br />
			<a href="<?php echo $this->_tpl_vars['site_url']; ?>
/signup"><img src="<?php echo $this->_tpl_vars['image_url']; ?>
/sign-up.png" /></a>
		</td>
	</tr>
</table>
<script language="javascript">
	document.getElementById('email').focus();
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>