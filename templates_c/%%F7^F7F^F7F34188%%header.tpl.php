<?php /* Smarty version 2.6.19, created on 2011-06-13 20:45:07
         compiled from header.tpl */ ?>
<html>
<head>
	<title><?php echo $this->_tpl_vars['meta']['title']; ?>
 - <?php echo $this->_tpl_vars['site_name']; ?>
</title>
	<meta name="keywords" content="<?php echo $this->_tpl_vars['meta']['keywords']; ?>
">
	<meta name="description" content="<?php echo $this->_tpl_vars['meta']['description']; ?>
">
	<meta name="robots" content="<?php echo $this->_tpl_vars['meta']['robots']; ?>
">
	<base href="<?php echo $this->_tpl_vars['site_url']; ?>
/" />
	<?php $_from = $this->_tpl_vars['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['script']):
?>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['script']; ?>
"></script>
	<?php endforeach; endif; unset($_from); ?>
	<link rel="stylesheet" href="<?php echo $this->_tpl_vars['site_url']; ?>
/css/style.css">
	<link rel="stylesheet" href="<?php echo $this->_tpl_vars['site_url']; ?>
/css/date_style.css">
<?php echo '
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-9774793-8\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
'; ?>

</head>
<body>
<center>
<div id="top-bar">
<?php if ($this->_tpl_vars['user']['loggedIn'] == true): ?>Welcome back <?php echo $this->_tpl_vars['user']['user_cname']; ?>
! <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/login?logout=1">Logout</a><?php else: ?><a href="<?php echo $this->_tpl_vars['site_url']; ?>
/login">Login / Sign-Up</a><?php endif; ?>
</div>
<div id="header">

</div>
<div id="content">
<div id="content-text">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>