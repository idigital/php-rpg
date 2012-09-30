<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
	   $meta = array("keywords" => "consignment sale,consign,family frenzy",
			"description" => "",
			"robots" => "nofollow,noindex",
			"title" => "Error 404 - File Not Found");
				
	   $this->assign("meta",$meta);
           $this->display($template . ".tpl");
       }
  }
?>
