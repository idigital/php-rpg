<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 14:11:00
         compiled from "../templates\admin-settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19024e12104479d107-23750535%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ebbc0f6b7f00ca309c1fac170deeb1fb8fcfff3' => 
    array (
      0 => '../templates\\admin-settings.tpl',
      1 => 1309806656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19024e12104479d107-23750535',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("admin_nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<form action="/admin/settings" method="post">
<input type="hidden" name="doit" value="1" />
<table>
	<tr><th>Setting</th><th>Value</th></tr>
<?php  $_smarty_tpl->tpl_vars["val"] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('settings')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["val"]->key => $_smarty_tpl->tpl_vars["val"]->value){
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["val"]->key;
?>
	<tr><td><?php echo $_smarty_tpl->getVariable('key')->value;?>
</td><td><input type="text" name="settings[<?php echo $_smarty_tpl->getVariable('key')->value;?>
]" size="30" value="<?php echo $_smarty_tpl->getVariable('val')->value;?>
" /></td></tr>
<?php }} ?>
	<tr><td>&nbsp;</td><td><input type="submit" value="Save" /></td></tr>
</table>
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>