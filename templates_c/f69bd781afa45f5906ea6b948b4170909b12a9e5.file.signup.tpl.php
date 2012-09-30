<?php /* Smarty version Smarty-3.0.8, created on 2011-07-02 20:48:27
         compiled from "../templates\signup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120134e0fca6b4d60c5-58161293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f69bd781afa45f5906ea6b948b4170909b12a9e5' => 
    array (
      0 => '../templates\\signup.tpl',
      1 => 1309657706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120134e0fca6b4d60c5-58161293',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<form action="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/signup" method="post">
<h1><?php echo $_smarty_tpl->getVariable('site_name')->value;?>
 Free 30 Day Trial</h1>
<table width="100%">
	<tr>
		<td width="60%">
		Please fill out the the following information to sign up for <?php echo $_smarty_tpl->getVariable('site_name')->value;?>
. <i><b>Bold</b> fields are required</i><br /> <br />
	<table>
		<tr><td colspan="2"><br /><b><u>Character Information</u></b></td></tr>
		<tr><td align="right"><b>Character Name</b></td><td><input type="text" name="user[user_cname]" size="30" value="<?php echo $_smarty_tpl->getVariable('user')->value['user_cname'];?>
"></td></tr>
	</table>
	<table>
		<tr><td colspan="2"><br /><b><u>Login Information</u></b></td></tr>
		<tr><td align="right"><b>E-Mail</b></td><td><input type="text" name="user[user_email]" size="20" value="<?php echo $_smarty_tpl->getVariable('user')->value['user_email'];?>
"></td></tr>
		<tr><td align="right"><b>Password</b></td><td><input type="password" name="user[user_password]" size="20" value=""></td></tr>
		<tr><td align="right"><b>Retype Password</b></td><td><input type="password" name="user[user_password2]" size="20" value=""></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><input type="checkbox" name="user[terms]" /> I agree to the terms and conditions</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Continue"></td></tr>
	</table>
		</td>
		<td>
			<br />
			<h3>Membership Features</h3>
			<ul>
				<li>Blah Blah</li>
				<li>Blah Blah</li>
			</ul>
			<center>
				<h3>$15 / Month</h3>
			</center>
		</td>
	</tr>	
</table>
</form>
<br />
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>