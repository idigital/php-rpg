<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 14:10:01
         compiled from "../templates\admin_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37824e121009cee943-14139821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77b9ecb28b6465ddb9ce02d611ca2759329bfab6' => 
    array (
      0 => '../templates\\admin_nav.tpl',
      1 => 1309806472,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37824e121009cee943-14139821',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="admin_nav">
	<b>Administration</b>
	<ul>
		<li><a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/admin">Home</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/admin/mapeditor">Map Editor</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/admin/mobeditor">Mob Editor</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/admin/settings">Settings</a></li>
	</ul>
</div>