<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
	   $meta = array("keywords" => "",
			"description" => "",
			"robots" => "follow,index",
			"title" => "RPG 2011");
				
	   $this->assign("meta",$meta);
           $this->display($template . ".tpl");
       }
  }
?>
