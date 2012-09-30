<?php /* Smarty version Smarty-3.0.8, created on 2011-06-13 21:28:22
         compiled from "../templates\contact-us.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187834df6c7469a56a6-90950853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04849c8c76f1f84981a7b4456c299c0a142b07b2' => 
    array (
      0 => '../templates\\contact-us.tpl',
      1 => 1308015695,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187834df6c7469a56a6-90950853',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1>Contact <?php echo $_smarty_tpl->getVariable('site_name')->value;?>
</h1>
Please fill out the following form to send an e-mail to <?php echo $_smarty_tpl->getVariable('site_name')->value;?>
. All fields are required.<br />
<br />
<form action="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/contact-us" method="post">
<input type="hidden" name="doit" value="1" />
<table>
	<tr><td align="right">Name</td><td><input type="text" name="contact[name]" size="40" value="<?php echo $_smarty_tpl->getVariable('contact')->value['name'];?>
"/></td></tr>
	<tr><td align="right">Email</td><td><input type="text" name="contact[email]" size="40" value="<?php echo $_smarty_tpl->getVariable('contact')->value['email'];?>
" /></td></tr>
	<tr><td align="right">Phone #</td><td><input type="text" name="contact[phone]" value="<?php echo $_smarty_tpl->getVariable('contact')->value['phone'];?>
" /></td></tr>
	<tr><td align="right">Subject</td><td>
															<select name="contact[subject]">
																<option value="General Question">General Question</option>
															</select>
														</td>
	</tr>
	<tr><td align="right">Message</td><td><textarea name="contact[message]" cols="35" rows="5"><?php echo $_smarty_tpl->getVariable('contact')->value['message'];?>
</textarea></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="Send" /></td></tr>
</table>
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>