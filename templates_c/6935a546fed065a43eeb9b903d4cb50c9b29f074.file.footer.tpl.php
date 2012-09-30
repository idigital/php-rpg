<?php /* Smarty version Smarty-3.0.8, created on 2011-06-24 12:39:16
         compiled from "../templates\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:298354e04cbc49faff1-54475862%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6935a546fed065a43eeb9b903d4cb50c9b29f074' => 
    array (
      0 => '../templates\\footer.tpl',
      1 => 1308936975,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298354e04cbc49faff1-54475862',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="clear: both;"></div>
</div>
</div>
<div id="footer">
<a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/">Home</a> - <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/game">Game</a> - <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/signup">Sign Up</a> - <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/contact-us">Contact Us</a>

<?php if ($_smarty_tpl->getVariable('user')->value['user_admin']==1){?>
 - <a href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/admin">Admin</a>
<?php }?>

</div>
</center>
<center><span style="font-size: 8pt"><a href="http://www.bremaweb.com/">Web Design</a> by Brema Web Solutions</span></center>
</body>
</html>