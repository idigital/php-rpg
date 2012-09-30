<?php /* Smarty version Smarty-3.0.8, created on 2011-07-02 20:49:20
         compiled from "../templates\welcome_email.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150264e0fcaa0d48239-21716361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8dd2d3ec0c28a35afa9a2de983bbbc25f39e049d' => 
    array (
      0 => '../templates\\welcome_email.tpl',
      1 => 1305598615,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150264e0fcaa0d48239-21716361',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('user')->value['user_fname'];?>
,<br />
Welcome to <?php echo $_smarty_tpl->getVariable('site_name')->value;?>
! <br />
<br />
To verify your account please click on the following link:<br />
<br />
<a href="<?php echo $_smarty_tpl->getVariable('data')->value['user']['verify_code'];?>
"><?php echo $_smarty_tpl->getVariable('data')->value['user']['verify_code'];?>
</a><br />
<br />
Thanks,<br />
<br />
Brandon<br />
brandon@bremaweb.com<br />
