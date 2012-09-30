<?php /* Smarty version 2.6.19, created on 2011-03-14 22:31:01
         compiled from myaccount-items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_table', 'myaccount-items.tpl', 22, false),array('function', 'html_options', 'myaccount-items.tpl', 50, false),)), $this); ?>
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
<span style="float: right;">
<a href="#" onclick="showAddForm();return false;"><img src="images/add-item.jpg"></a>
<a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/?print-labels=1&user_id=<?php echo $this->_tpl_vars['user_id']; ?>
" target="_blank"><img src="images/print-labels.jpg" /></a>
<a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/?print-inventory=1&user_id=<?php echo $this->_tpl_vars['user_id']; ?>
"><img src="images/print-inventory.jpg" /></a>
</span>
<?php 
	if ( $_GET['all'] ){
 ?>
<h1>Prev Sale Items</h1>
<span style="font-size:10pt;"><a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/items?user_id=<?php echo $this->_tpl_vars['user_id']; ?>
">Current Sale Items</a></span>
<?php 
	} else {
 ?>
<h1>Sale Items</h1>
<span style="font-size:10pt;"><a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/items?all=1&user_id=<?php echo $this->_tpl_vars['user_id']; ?>
">View Previous Sale Items</a></span>
<?php 
	}
 ?>

<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['items'],'cols' => "Category,Item Description,Price,&nbsp;",'tr_attr' => $this->_tpl_vars['tr'],'table_attr' => "bgcolor='#000000' cellspacing='1' width='615'",'td_attr' => $this->_tpl_vars['td']), $this);?>


<div style="position: absolute; top: 0px; left: 0px; height: 1280px; width: 1280px; opacity: .5; background-color: #000000; filter: alpha(opacity = 50); display: none;" id="shading"> 
	&nbsp;
</div> 

<div id="addForm" style="display: none; position: absolute; top: 100px; left: 325px;">
<?php 
	if ( $_GET['edit'] )
		echo "<h2>Edit Item</h2>";
	else
		echo "<h2>Add New Item</h2>";
 ?>
<form action="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/items?user_id=<?php echo $this->_tpl_vars['user_id']; ?>
" method="post">
	<?php 
		if ( $_GET['edit'] )
			echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"2\" />";
		else
			echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"1\" />";
	 ?>
	<input type="hidden" name="item[user_id]" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
	<input type="hidden" name="item[item_id]" value="<?php echo $this->_tpl_vars['item']['item_id']; ?>
" />
	<table>
		<tr><td><b>Category</b><br /><?php echo tableToSelect("item[cat_id]","","categories","cat_id","cat_name","cat_name ASC","cat_active = '1'"); ?></td></tr>
		<tr><td><b>Description</b> <span class="light-text">(i.e. Onsie, Striped Shirt, Jungle Bouncer, etc...)</span><br /><input type="text" name="item[item_description]" size="50" value="<?php echo $this->_tpl_vars['item']['item_description']; ?>
" /></td></tr>
		<tr><td><b>Brand</b><br /><input type="text" name="item[item_brand]" size="20" value="<?php echo $this->_tpl_vars['item']['item_brand']; ?>
" /></td></tr>
		<tr><td><b>Color</b><br /><input type="text" name="item[item_color]" size="20" value="<?php echo $this->_tpl_vars['item']['item_color']; ?>
" /></td></tr>
		<tr><td><b>Gender</b><br />
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['genders'],'name' => "item[item_gender]",'selected' => $this->_tpl_vars['item']['item_gender']), $this);?>

		</td>
		</tr>
		<tr>
		<td><b>Price</b><br />
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prices'],'name' => "item[item_price]",'selected' => $this->_tpl_vars['item']['item_price']), $this);?>

		</td>
		</tr>
		<tr>
		<td><b>Size</b><br />
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['clothSizes'],'name' => "item[item_size]",'selected' => $this->_tpl_vars['item']['item_size']), $this);?>

		</td>
		</tr>
		<tr><td><input type="checkbox" name="item[item_halfoff]" value="1" <?php if ($this->_tpl_vars['item']['item_halfoff'] == '1'): ?>CHECKED<?php endif; ?>> Sell for 50% on last day of sale</td></tr>
		<?php echo '
		<tr><td><input type="submit" value="Submit"> <a href="#" onclick="if ( confirm(\'Are you sure you want to cancel?\') ){hideAddForm('; ?>
<?php echo $this->_tpl_vars['user_id']; ?>
<?php echo ');return false;} else {return false;}">Cancel</a></td></tr>
		'; ?>

	</table>
</form>
</div>
<?php 
	if ( $_GET['edit'] ) {
 ?>
<script language="javascript">
	document.getElementById('item[cat_id]').value='<?php echo $this->_tpl_vars['item']['cat_id']; ?>
';
	showAddForm();
</script>
<?php 
	}
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>