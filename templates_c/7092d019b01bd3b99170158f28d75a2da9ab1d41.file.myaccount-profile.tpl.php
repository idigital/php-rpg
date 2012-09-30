<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 14:24:22
         compiled from "../templates\myaccount-profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62484e121366a0a7a1-97574890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7092d019b01bd3b99170158f28d75a2da9ab1d41' => 
    array (
      0 => '../templates\\myaccount-profile.tpl',
      1 => 1309807458,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62484e121366a0a7a1-97574890',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("my_account_nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1>My Profile</h1>
<form action="myaccount/profile?user_id=<?php echo $_smarty_tpl->getVariable('user')->value['user_id'];?>
" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<input type="hidden" name="doit" value="1" />
<table>
	<tr><td align="right">Character Name</td><td><input type="text" name="user[user_cname]" size="30" value="<?php echo $_smarty_tpl->getVariable('user')->value['user_cname'];?>
" readonly="true"></td></tr>
	<tr><td align="right">Avatar</td><td><img src="<?php echo $_smarty_tpl->getVariable('avatar_url')->value;?>
/<?php echo $_smarty_tpl->getVariable('user')->value['user_avatar'];?>
" /> <input type="file" name="new_avatar"></td></tr>
		
		<tr><td colspan="2>&nbsp;<br /><br /></td></tr>
		<tr><td colspan="2"><br /><b>Login Information</b></td></tr>
		<tr><td align="right">E-Mail</td><td><input type="text" name="user[user_email]" size="20" value="<?php echo $_smarty_tpl->getVariable('user')->value['user_email'];?>
"></td></tr>
		<tr><td align="right">Change Password</td><td><input type="password" name="user[user_password]" size="20" value=""></td></tr>
		<tr><td align="right">Retype Password</td><td><input type="password" name="user[user_password2]" size="20" value=""></td></tr>
		<tr><td align="right"><input type="submit" name="submit" value="Save Changes"></td><td>&nbsp</td></tr>
</table>
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>