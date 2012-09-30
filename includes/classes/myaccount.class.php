<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;          
			global $clothSizes;
			global $genders;
			global $prices; 
			
       		requireLogin();
           
			$meta = array("keywords" => "",
				"description" => "",
				"robots" => "nofollow,noindex");
				
			$this->assign("js", array("js/myaccount.js"));
		
	    	switch ( $template ){
				
				
				case "myaccount-profile":
					$meta['title']  = "My Profile";
					
					if ( $_GET['user_id'] != "" && ( $_GET['user_id'] == $app->user->data['user_id']  || $app->user->data['user_admin'] == "1" ) ) {
						$user_id = $_GET['user_id'];
						$SQL = "SELECT * FROM users WHERE user_id = " . $user_id;
						$profileData = $app->db->queryrow($SQL);
					} else {
						$user_id = $app->user->data['user_id'];
						$profileData = $app->user->data;
						$this->assign("who","My");
					}
					
					
					$profileData['user_password'] = "";
					
					$this->assign("user",$profileData);
					if ( $_POST['doit'] == "1" ){
						// update their information
						$error = false;
						$requiredFields = array("user_cname","user_email");
						foreach ( $requiredFields as $v ){
							if ( $_POST['user']["$v"] == "" ){
								// didn't fill out one of the fields
								$error = true;
								$errMsg = "Please fill out all fields!";
								$this->assign("user",$_POST['user']);
							}
						}
						if ( $error == false ){
							if ( $_POST['user']['user_password'] != "" ){
								// they are changing their password
								if ( $_POST['user']['user_password'] == $_POST['user']['user_password2'] ){
									$_POST['user']['user_password'] = md5($_POST['user']['user_password']);
									$errMsg = "Password changed successfully!";
								} else {
									$errMsg = "Passwords did not match! Password not changed.";
								}
									
							} else {
								unset($_POST['user']['user_password']);
								unset($_POST['user']['user_password2']);
							}
							if ( !$errMsg )
								$errMsg = "Changes Saved!";
							
							// see if an avatar was uploaded that needs to be processed
							if ( $_FILES['new_avatar'] ){
								$target = $app->path . "/avatar_tmp/" . basename($_FILES['new_avatar']['tmp_name']);
								$final_location = $app->path . $app->settings->getVal('avatar_dir') . "/user" . $app->user->data['user_id'] . "avatar-" . md5(time()) . ".jpg";
							
								if ( move_uploaded_file($_FILES['new_avatar']['tmp_name'], $target) ){
									resampimagejpg(64,64,$target,$final_location);
									$_POST['user']['user_avatar'] = basename($final_location);
								} else {
									
									$errMsg = "Unable to update avatar - Error " . $_FILES['new_avatar']['error'];
								}
								
							}
							
							$app->db->updateRow("users",$app->db->getTableCols("users"),$_POST['user'],"user_id",$user_id);
							
							if ( $user_id = $app->user->data['user_id'] )
								$app->user->loadUser($app->user->data['user_id']);
								
							$userData = $app->user->data;
							$userData['user_password'] = "";
							$this->assign("user",$userData);
						}
					}
					
				break;
				}
					
			$this->assign("meta",$meta);
	   	   $this->assign('err_msg',$errMsg);
           $this->display($template . ".tpl");
       }
  }
?>