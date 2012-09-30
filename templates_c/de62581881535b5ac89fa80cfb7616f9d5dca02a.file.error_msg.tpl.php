<?php /* Smarty version Smarty-3.0.8, created on 2011-06-13 21:26:03
         compiled from "../templates\error_msg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68794df6c6bb165929-38274899%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de62581881535b5ac89fa80cfb7616f9d5dca02a' => 
    array (
      0 => '../templates\\error_msg.tpl',
      1 => 1308018361,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68794df6c6bb165929-38274899',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('err_msg')->value!=''){?>
    <div class="errMsg">
        <?php echo $_smarty_tpl->getVariable('err_msg')->value;?>

    </div>
<?php }?>