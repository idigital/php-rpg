<?php /* Smarty version 2.6.19, created on 2011-02-14 22:20:43
         compiled from consignment-sales.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'consignment-sales.tpl', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['sale']['sale_note'] != ""): ?>
<div style="float: right; width: 200px; border: solid 2px #0EAC4B; text-align: center; background-color: #FFFFFF; padding: 3px; font-size: 14pt;">
	<?php echo $this->_tpl_vars['sale']['sale_note']; ?>
<br />
	<br />
</div>
<?php endif; ?>
<h1>Kids Consignment Sale in <?php echo $this->_tpl_vars['sale']['sale_city']; ?>
, <?php echo $this->_tpl_vars['sale']['sale_state']; ?>
</h1>
<b>Location:</b> Railway Station Shopping Center (Behind Subway)<br />
<a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo ((is_array($_tmp=$this->_tpl_vars['sale']['sale_address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
+<?php echo ((is_array($_tmp=$this->_tpl_vars['sale']['sale_city'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
,+<?php echo $this->_tpl_vars['sale']['sale_state']; ?>
&z=16" target="_blank"><i><?php echo $this->_tpl_vars['sale']['sale_address']; ?>
, <?php echo $this->_tpl_vars['sale']['sale_city']; ?>
, <?php echo $this->_tpl_vars['sale']['sale_state']; ?>
</i></a><br />
<br />
<h3>Dates and Times</h3>
<ul>
<li>Wed. March 16th 10am-6pm</li>
<li>Thurs. March 17th 10am-6pm</li>
<li>Friday March 18th 10am-6pm</li>
<li>Saturday March 19th 10am-4pm</li>
</ul>
<b>
Drop Off, Pick Up and Early Shopping for Consignors will be announced. 
</b>
<?php echo $this->_tpl_vars['sale']['sale_desc']; ?>

<br />
<h2>WE CAN ONLY ACCEPT CASH AND CHECK. NO DEBIT OR CC WILL BE ACCEPTED AT THIS PARTICULAR SALE. </h2>
<br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>