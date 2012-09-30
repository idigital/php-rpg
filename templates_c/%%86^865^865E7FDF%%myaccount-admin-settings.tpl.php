<?php /* Smarty version 2.6.19, created on 2010-11-27 17:31:42
         compiled from myaccount-admin-settings.tpl */ ?>
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
<form action="/myaccount/admin-settings" method="post">
<input type="hidden" name="doit" value="1" />
<table>
	<tr><th>Setting</th><th>Value</th></tr>
<?php $_from = $this->_tpl_vars['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
	<tr><td><?php echo $this->_tpl_vars['key']; ?>
</td><td><input type="text" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" size="30" value="<?php echo $this->_tpl_vars['val']; ?>
" /></td></tr>
<?php endforeach; endif; unset($_from); ?>
	<tr><td>&nbsp;</td><td><input type="submit" value="Save" /></td></tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>