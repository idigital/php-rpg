<?php /* Smarty version Smarty-3.0.8, created on 2012-05-12 00:22:51
         compiled from "../templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51444fadf3ab6eef59-26385613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3c1efef4679fe5e8f70f9b0ab7ff16de2de2da3' => 
    array (
      0 => '../templates\\header.tpl',
      1 => 1336800169,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51444fadf3ab6eef59-26385613',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<title><?php echo $_smarty_tpl->getVariable('meta')->value['title'];?>
 - <?php echo $_smarty_tpl->getVariable('site_name')->value;?>
</title>
	<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('meta')->value['keywords'];?>
">
	<meta name="description" content="<?php echo $_smarty_tpl->getVariable('meta')->value['description'];?>
">
	<meta name="robots" content="<?php echo $_smarty_tpl->getVariable('meta')->value['robots'];?>
">
	<base href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/" />
	
	<?php  $_smarty_tpl->tpl_vars['scr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('js')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['scr']->key => $_smarty_tpl->tpl_vars['scr']->value){
?>
		<script language="javascript" src="<?php echo $_smarty_tpl->tpl_vars['scr']->value;?>
"></script>
	<?php }} ?>
	
	<script language="javascript" src="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/js/ajax.js"></script>
	<script language="javascript" src="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/js/XMLObjTree.js"></script>
	<script language="javascript" src="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/js/debug.js"></script>
	<script language="javascript" src="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/js/tools.js"></script>
	
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/css/style.css">
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/css/date_style.css">

<script type="text/javascript">
/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9774793-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/
</script>

</head>
<body>
<center>
<div id="top-bar">
<?php if ($_smarty_tpl->getVariable('user')->value['loggedIn']==true){?>Welcome back <?php echo $_smarty_tpl->getVariable('user')->value['user_cname'];?>
! <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/login?logout=1">Logout</a><?php }else{ ?><a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/login">Login / Sign-Up</a><?php }?>
</div>
<div id="header">

</div>
<div id="content">
<div id="content-text">
<?php $_template = new Smarty_Internal_Template("error_msg.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>