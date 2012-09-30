<?php /* Smarty version 2.6.19, created on 2011-05-02 22:13:59
         compiled from myaccount-admin-sales.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_table', 'myaccount-admin-sales.tpl', 67, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['site_url']; ?>
/js/tiny_mce/tiny_mce.js"></script>
<?php echo '
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
'; ?>

        // Example content CSS (should be your site CSS)
        content_css : "<?php echo $this->_tpl_vars['site_url']; ?>
/style.css",
<?php echo '
        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "my_account_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php 
	if ( $_GET['edit'] != "" || $_GET['add'] != "" ) {
 ?>
	<table>
		<tr><td align="right">Title</td><td><input type="text" name="sale[sale_title]" value="<?php echo $this->_tpl_vars['sale']['sale_title']; ?>
" size="30" /></td></tr>
		<tr><td>&nbsp;</td><td><b>Location</b></td></tr>
		<tr><td align="right">Location</td><td><input type="text" name="sale[sale_location]" value="<?php echo $this->_tpl_vars['sale']['sale_location']; ?>
" size="30" /></td></tr>
		<tr><td align="right">Address</td><td><input type="text" name="sale[sale_address]" value="<?php echo $this->_tpl_vars['sale']['sale_address']; ?>
" size="30" /></td></tr>
		<tr><td align="right">&nbsp;</td><td><input type="text" name="sale[sale_address2]" value="<?php echo $this->_tpl_vars['sale']['sale_address2']; ?>
" size="30" /></td></tr>
		<tr><td align="right">City</td><td><input type="text" name="sale[sale_city]" value="<?php echo $this->_tpl_vars['sale']['sale_address2']; ?>
" size="15" /> State <input type="text" name="sale[sale_state]" value="<?php echo $this->_tpl_vars['sale']['sale_state']; ?>
" size="3" /> Zip <input type="text" name="sale[state_zip]" value="<?php echo $this->_tpl_vars['sale']['sale_zip']; ?>
" size="6" /></td></tr>
		<tr><td>&nbsp;</td><td><b>Dates & Times</b></td></tr>
		<tr><td>Start Date</td><td><input type="text" name="sale[sale_start]" value="<?php echo $this->_tpl_vars['sale']['sale_start']; ?>
" size="12" id="start" /> <img src="images/show-calendar.gif" onclick="displayDatePicker('start');" /></td></tr>
		<tr><td>End Date</td><td><input type="text" name="sale[sale_end]" value="<?php echo $this->_tpl_vars['sale']['sale_end']; ?>
" size="12" id="end" /> <img src="images/show-calendar.gif" onclick="displayDatePicker('end');" /></td></tr>
		<tr><td>End Signup</td><td><input type="text" name="sale[sale_signup_end]" value="<?php echo $this->_tpl_vars['sale']['sale_end']; ?>
" size="12" id="signup" /> <img src="images/show-calendar.gif" onclick="displayDatePicker('signup');" /></td></tr>
		<tr><td>&nbsp;</td><td><b>Descriptions</b></td></tr>
		<tr><td>Main Text</td><td><textarea name="sale[sale_desc]"><?php echo $this->_tpl_vars['sale']['sale_desc']; ?>
</textarea></td></tr>
		<tr><td>Side Note</td><td><textarea name="sale[sale_note]"><?php echo $this->_tpl_vars['sale']['sale_note']; ?>
</textarea></td></tr>
	</table>
<?php 
	} else {
 ?>
<span style="float: right;"><a href="<?php echo $this->_tpl_vars['site_url']; ?>
/myaccount/admin-sales?add=1"><img src="images/add-sale.jpg" /></a></span>
	<h1>Sales</h1>
	<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['sales'],'cols' => "Title,Location,Start Date,End Date,&nbsp;",'tr_attr' => $this->_tpl_vars['tr'],'table_attr' => "bgcolor='#000000' cellspacing='1' width='615'",'td_attr' => $this->_tpl_vars['td']), $this);?>

<?php 
	}
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>