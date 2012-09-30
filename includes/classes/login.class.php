<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
           
            $meta = array("title"=>"Login","robots"=>"nofollow,noindex");
           
           $this->assign("meta",$meta);
       if ( $_POST['doit'] ){
		   if ( $_POST['login']['email'] == "" || $_POST['login']['password'] == "" ){
			   $errMsg = "Please enter an e-mail address and password.";		
			   $_POST['login']['password'] = "";	// make sure the password field is clear
		   } else {
			// check their login credentials
			
				if ( $app->user->login($_POST['login']['email'],$_POST['login']['password'])){
					// login success
					activityLog($app->user->data['tile_id'],$app->user->data['user_id'],$app->user->data['user_cname'] . " appears from within the void!","showUser('" . $app->user->data['user_id'] . "');");
					header("location: " . $app->settings->getVal('site_url') . "/");
				} else {
					// login failed	
					$errMsg = "Incorrect Login!";
					$this->assign("err_msg",$errMsg);
					$_POST['login']['password'] = "";
				}	
			}
		}
		
		if ( $_GET['logout'] ){
			activityLog($app->user->data['tile_id'],$app->user->data['user_id'],$app->user->data['user_cname'] . " disappears into the void","removeUser('" . $app->user->data['user_id'] . "');");
			$app->user->logout();
			$errMsg = "You have been logged out successfully!";
		}
	   
		   $this->assign("err_msg",$errMsg);
		   $this->assign("login",$_POST['login']);
           $this->display($template . ".tpl");

       }
  }
?>