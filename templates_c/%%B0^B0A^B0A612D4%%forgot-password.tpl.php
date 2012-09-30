<?php /* Smarty version 2.6.19, created on 2010-10-29 22:08:29
         compiled from forgot-password.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Forgot Password</h1>
<form action="forgot-password" method="post">
<input type="hidden" name="doit" value="1">
If you have forgotten your password enter your e-mail address below and a password change e-mail will be sent to you.<br />
<br/>
Email Address: <input type="text" name="email_address" value="" size="30" /><br />
<input type="submit" value="Reset Password" />
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>