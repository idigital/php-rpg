<?php /* Smarty version 2.6.19, created on 2011-01-17 21:09:57
         compiled from myaccount-admin-items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_table', 'myaccount-admin-items.tpl', 8, false),)), $this); ?>
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

<?php 
if ( $_GET['user_id'] ){
 ?>
<h1><?php echo $this->_tpl_vars['consignor']['user_fname']; ?>
 <?php echo $this->_tpl_vars['consignor']['user_lname']; ?>
's Sale Items</h1>
	<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['items'],'cols' => "Category,Item Description,Price,&nbsp;",'tr_attr' => $this->_tpl_vars['tr'],'table_attr' => "bgcolor='#000000' cellspacing='1' width='615'",'td_attr' => $this->_tpl_vars['td']), $this);?>

<?php 
} else {
 ?>
<h1>Consignors With Sale Items</h1>
<span style="font-size: 8pt;"><a href="/myaccount/admin-items?all=1">View Previous Sales</a></span>
	<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['consignors'],'cols' => "ID,Name,Items,Listings $,Sales $,FF $, Con $,&nbsp;",'tr_attr' => $this->_tpl_vars['tr'],'table_attr' => "bgcolor='#000000' cellspacing='1' width='615'",'td_attr' => $this->_tpl_vars['td']), $this);?>

<?php 
}
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>