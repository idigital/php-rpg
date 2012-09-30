<?php /* Smarty version 2.6.19, created on 2010-11-27 16:43:36
         compiled from myaccount.tpl */ ?>
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
<h1>My Account</h1>
Welcome to the My Account section of Family Frenzy Consignment Sale. In the My Profile section you can update your name, address, phone number, and change your password. 
Under My Sale Items you can enter your consignment sale items, and print labels for your sale items.<br />
<br />
<h1>Things you will need at drop off</h1>
<div style="padding-left: 225px;">
<ul>
	<li>$8.00 consignor fee (Cash or Check)</li>
	<li>Self addressed stamped envelope</li>
	<li>Signed <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/FFTerms.pdf" target="_blank">Terms & Conditions</a></li>
	<li><a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/?print-inventory=1&user_id=<?php echo $this->_tpl_vars['user']['user_id']; ?>
" target="_blank">Your Inventory Sheet</a></li>
	<li>All consignment items hung, tagged, and ready to be checked in</li>
</ul>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>