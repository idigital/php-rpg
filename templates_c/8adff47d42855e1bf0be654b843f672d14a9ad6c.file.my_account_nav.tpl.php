<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 13:54:24
         compiled from "../templates\my_account_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:91514e120c60c76af9-79683593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8adff47d42855e1bf0be654b843f672d14a9ad6c' => 
    array (
      0 => '../templates\\my_account_nav.tpl',
      1 => 1309805663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91514e120c60c76af9-79683593',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="nav_container">
Welcome back, <?php echo $_smarty_tpl->getVariable('user')->value['user_fname'];?>
<br />

<div id="my_account_nav">
<b>My Account</b><br />
	<li> <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/myaccount">Home</a></li>
	<li> <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/myaccount/profile">My Profile</a></li>
	<li> <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/login?logout=1">Logout</a></li>
</div>

</div>
