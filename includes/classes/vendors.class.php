<?php

class clsPage extends Smarty {
	function renderPage($template){
		global $app;
		
		$meta = array("title"=>"Vendors - Family Frenzy");
		$this->assign("meta",$meta);
		$this->display($template . ".tpl");
	}
}