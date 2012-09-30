<?php /* Smarty version 2.6.19, created on 2010-11-27 17:33:29
         compiled from my_account_nav.tpl */ ?>
<div id="nav_container">
Welcome back, <?php echo $this->_tpl_vars['user']['user_fname']; ?>
<br />
<?php if ($this->_tpl_vars['user']['user_admin'] == 1): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
<?php endif; ?>


<div id="my_account_nav">
<b>My Account</b><br />
	<li> <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount">Home</a></li>
	<li> <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/profile">My Profile</a></li>
	<li> <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/items">My Sale Items</a></li>
	<li> <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/FFTerms.pdf">Terms & Conditions</a></li>
	<li> <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/login?logout=1">Logout</a></li>
</div>

</div>