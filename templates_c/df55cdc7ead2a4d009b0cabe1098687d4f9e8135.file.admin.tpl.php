<?php /* Smarty version Smarty-3.0.8, created on 2011-06-13 21:27:56
         compiled from "../templates\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:199664df6c72c3f77d7-83180557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df55cdc7ead2a4d009b0cabe1098687d4f9e8135' => 
    array (
      0 => '../templates\\admin.tpl',
      1 => 1308016419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199664df6c72c3f77d7-83180557',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("admin_nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div id="admin_content">
<h1><?php echo $_smarty_tpl->getVariable('site_name')->value;?>
 Administration</h1>
</div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>