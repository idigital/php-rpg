<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
		   
		   requireLogin();
		   
	   $meta = array("keywords" => "",
			"description" => "",
			"robots" => "follow,index",
			"title" => "Game");
			
		$js = array("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js","https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js","/js/game.js");
		
		
		$SQL = "SELECT max(activity_id) as aid FROM activity";
		$row = $app->db->queryrow($SQL);
		
		$this->assign("last_id",$row['aid']);
		$this->assign("js",$js);
		$this->assign("meta",$meta);
        $this->display($template . ".tpl");
       }
  }
?>
