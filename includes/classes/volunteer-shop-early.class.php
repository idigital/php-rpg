<?php

class clsPage extends Smarty {
	function renderPage($template){
		global $app;
		
		$meta = array("title"=>"Volunteer/Shop Early - Family Frenzy Consignment Sale");
		$this->assign("meta",$meta);
		$this->display($template . ".tpl");
	}
}