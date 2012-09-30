<?php /* Smarty version 2.6.19, created on 2011-06-11 22:40:27
         compiled from signup.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $this->_tpl_vars['site_url']; ?>
/signup" method="post">
<h1><?php echo $this->_tpl_vars['site_name']; ?>
 Free 30 Day Trial</h1>
<table width="100%">
	<tr>
		<td width="60%">
		Please fill out the the following information to sign up for <?php echo $this->_tpl_vars['site_name']; ?>
. <i><b>Bold</b> fields are required</i><br /> <br />
	<table>
		<tr><td colspan="2"><br /><b><u>Character Information</u></b></td></tr>
		<tr><td align="right"><b>Character Name</b></td><td><input type="text" name="user[user_cname]" size="30" value="<?php echo $this->_tpl_vars['user']['user_cname']; ?>
"></td></tr>
	</table>
	<table>
		<tr><td colspan="2"><br /><b><u>Login Information</u></b></td></tr>
		<tr><td align="right"><b>E-Mail</b></td><td><input type="text" name="user[user_email]" size="20" value="<?php echo $this->_tpl_vars['user']['user_email']; ?>
"></td></tr>
		<tr><td align="right"><b>Password</b></td><td><input type="password" name="user[user_password]" size="20" value=""></td></tr>
		<tr><td align="right"><b>Retype Password</b></td><td><input type="password" name="user[user_password2]" size="20" value=""></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><input type="checkbox" name="user[terms]" /> I agree to the terms and conditions</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Continue"></td></tr>
	</table>
		</td>
		<td>
			<br />
			<h3>Membership Features</h3>
			<ul>
				<li>Blah Blah</li>
				<li>Blah Blah</li>
			</ul>
			<center>
				<h3>$15 / Month</h3>
			</center>
		</td>
	</tr>	
</table>
</form>
<br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>