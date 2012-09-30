<?php

class clsPage extends Smarty {
	function renderPage($template){
		global $app;
		
		$meta = array("title"=>"Acceptable Consignment Items - Family Frenzy");
		$this->assign("meta",$meta);
		$this->display($template . ".tpl");
	}
}

?>