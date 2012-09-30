<?php /* Smarty version 2.6.19, created on 2011-06-13 20:41:38
         compiled from contact-us.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Contact <?php echo $this->_tpl_vars['site_name']; ?>
</h1>
Please fill out the following form to send an e-mail to <?php echo $this->_tpl_vars['site_name']; ?>
. All fields are required.<br />
<br />
<form action="<?php echo $this->_tpl_vars['site_url']; ?>
/contact-us" method="post">
<input type="hidden" name="doit" value="1" />
<table>
	<tr><td align="right">Name</td><td><input type="text" name="contact[name]" size="40" value="<?php echo $this->_tpl_vars['contact']['name']; ?>
"/></td></tr>
	<tr><td align="right">Email</td><td><input type="text" name="contact[email]" size="40" value="<?php echo $this->_tpl_vars['contact']['email']; ?>
" /></td></tr>
	<tr><td align="right">Phone #</td><td><input type="text" name="contact[phone]" value="<?php echo $this->_tpl_vars['contact']['phone']; ?>
" /></td></tr>
	<tr><td align="right">Subject</td><td>
															<select name="contact[subject]">
																<option value="General Question">General Question</option>
															</select>
														</td>
	</tr>
	<tr><td align="right">Message</td><td><textarea name="contact[message]" cols="35" rows="5"><?php echo $this->_tpl_vars['contact']['message']; ?>
</textarea></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="Send" /></td></tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>