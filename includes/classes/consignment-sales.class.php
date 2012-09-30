<?php

class clsPage extends Smarty {
	function renderPage($template){
		global $app;
		
		$meta = array("title"=>"Consignment Sale in Bolivar Missouri - Family Frenzy","keywords"=>"Consignment Sale,missouri,bolivar,consigment sale in bolivar missouri,consignment sale in missouri");
		
		$this->assign("meta",$meta);
		$this->display($template . ".tpl");
	}
}

?>