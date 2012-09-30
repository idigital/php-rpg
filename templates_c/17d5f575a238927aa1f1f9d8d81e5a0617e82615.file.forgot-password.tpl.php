<?php /* Smarty version Smarty-3.0.8, created on 2012-09-29 00:45:37
         compiled from "../templates\forgot-password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2025450668b01868fc2-87209157%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17d5f575a238927aa1f1f9d8d81e5a0617e82615' => 
    array (
      0 => '../templates\\forgot-password.tpl',
      1 => 1288406538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2025450668b01868fc2-87209157',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<h1>Forgot Password</h1>
<form action="forgot-password" method="post">
<input type="hidden" name="doit" value="1">
If you have forgotten your password enter your e-mail address below and a password change e-mail will be sent to you.<br />
<br/>
Email Address: <input type="text" name="email_address" value="" size="30" /><br />
<input type="submit" value="Reset Password" />
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>