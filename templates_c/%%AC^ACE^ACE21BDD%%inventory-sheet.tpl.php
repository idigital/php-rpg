<?php /* Smarty version 2.6.19, created on 2010-11-23 00:03:02
         compiled from inventory-sheet.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_table', 'inventory-sheet.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data'],'cols' => 4,'tr_attr' => $this->_tpl_vars['tr'],'table_attr' => "bgcolor='#000000' cellspacing='1' width='100%'",'td_attr' => $this->_tpl_vars['td']), $this);?>