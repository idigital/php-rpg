<?php /* Smarty version 2.6.19, created on 2010-10-29 22:38:25
         compiled from password-reset.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Reset Password</h1>
Choose a new password.<br />
<form action="<?php echo $this->_tpl_vars['site_url']; ?>
/forgot-password/?reset=1" method="post">
<input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
" />
<input type="hidden" name="code" value="<?php echo $this->_tpl_vars['code']; ?>
" />
New Password <input type="password" name="new_password" /><br />
Retype New Password <input type="password" name="new_password2" /><br />
<input type="submit" value="Reset Password" />
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>