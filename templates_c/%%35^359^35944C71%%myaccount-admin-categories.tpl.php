<?php /* Smarty version 2.6.19, created on 2010-10-25 23:58:52
         compiled from myaccount-admin-categories.tpl */ ?>
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
<h1>Sale Item Categories</h1>
<form action="myaccount/admin-categories" method="post">
	<input type="hidden" name="doit" value="1" />
<table>
	<tr><th>Categories</th></tr>
	<?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
		<tr><td><input type="hidden" name="cat_id[]" value="<?php echo $this->_tpl_vars['cat']['cat_id']; ?>
"><input type="text" name="cat_name[]" value="<?php echo $this->_tpl_vars['cat']['cat_name']; ?>
" size="30" /></td></tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr><td><input type="text" name="cat_name[]" value="" size="30" /></td></tr>
	<tr><td><input type="submit" value="Save Categories" /></td></tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>