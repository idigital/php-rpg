<?php /* Smarty version 2.6.19, created on 2010-12-07 22:15:33
         compiled from myaccount-profile.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "my_account_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>My Profile</h1>
<form action="myaccount/profile?user_id=<?php echo $this->_tpl_vars['consignor']['user_id']; ?>
" method="post">
	<input type="hidden" name="doit" value="1" />
<table>
	<tr><td align="right">First Name</td><td><input type="text" name="consignor[user_fname]" size="30" value="<?php echo $this->_tpl_vars['consignor']['user_fname']; ?>
"></td></tr>
		<tr><td align="right">Last Name</td><td><input type="text" name="consignor[user_lname]" size="30" value="<?php echo $this->_tpl_vars['consignor']['user_lname']; ?>
"></td></tr>
		<tr><td align="right">Address</td><td><input type="text" name="consignor[user_address]" size="55"  value="<?php echo $this->_tpl_vars['consignor']['user_address']; ?>
"></td></tr>
		<tr><td align="right">City</td><td><input type="text" name="consignor[user_city]" size="20"  value="<?php echo $this->_tpl_vars['consignor']['user_city']; ?>
"> State <input type="text" name="consignor[user_state]" size="3" value="<?php echo $this->_tpl_vars['consignor']['user_state']; ?>
"> Zip <input type="text" name="consignor[user_zip]" value="<?php echo $this->_tpl_vars['consignor']['user_zip']; ?>
" size="6"></td></tr>
		<tr><td align="right">Phone</td><td><input type="text" name="consignor[user_phone]" size="15" value="<?php echo $this->_tpl_vars['consignor']['user_phone']; ?>
"></td></tr>
		<tr><td colspan="2>&nbsp;<br /><br /></td></tr>
		<tr><td colspan="2"><br /><b>Login Information</b></td></tr>
		<tr><td align="right">E-Mail</td><td><input type="text" name="consignor[user_email]" size="20" value="<?php echo $this->_tpl_vars['consignor']['user_email']; ?>
"></td></tr>
		<tr><td align="right">Change Password</td><td><input type="password" name="consignor[user_password]" size="20" value=""></td></tr>
		<tr><td align="right">Retype Password</td><td><input type="password" name="consignor[user_password2]" size="20" value=""></td></tr>
		<tr><td align="right"><input type="submit" name="submit" value="Save Changes"></td><td>&nbsp</td></tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>