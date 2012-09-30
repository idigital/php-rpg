<?php /* Smarty version 2.6.19, created on 2010-12-02 21:42:59
         compiled from myaccount-admin-users.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_table', 'myaccount-admin-users.tpl', 4, false),)), $this); ?>
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
<h1>Consignors</h1>
<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['users'],'cols' => "ID,Name,Email,City & State,&nbsp;",'tr_attr' => $this->_tpl_vars['tr'],'table_attr' => "bgcolor='#000000' cellspacing='1' width='615'",'td_attr' => $this->_tpl_vars['td']), $this);?>
	
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>