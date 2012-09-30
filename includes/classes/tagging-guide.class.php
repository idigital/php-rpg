<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
	   $meta = array("keywords" => "tagging consignment sale items,consignment sale,tagging guide",
			"description" => "How to tag items for Family Frenzy Consignment Sale",
			"robots" => "follow,index",
			"title" => "Tagging Guide - Family Frenzy");
				
	   $this->assign("meta",$meta);
           $this->display($template . ".tpl");
       }
  }
?>
