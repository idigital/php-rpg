<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
		   
		   requireAdminLogin();
		   
		switch ( $template ){
			case "admin-mapeditor":
				$meta = array("title" => "Map Editor");
				$js = array("/js/mapeditor.js");
				$this->mapeditor();
			break;
			
			case "admin-mobeditor":
				$meta = array("title" => "Mob Editor");
				$js = array("/js/mobeditor.js");
				$this->mobeditor();
			break;
			
			case "admin-settings":
					if ( $app->user->data['user_admin'] != "1" )
						die("Unauthorized!");
						
					$meta['title'] = "Settings";
					if ( $_POST['doit'] ){						
						foreach ( $_POST['settings'] as $k => $v )
							$app->settings->setVal($k,$v);
							
						$errMsg = "Settings saved!";
					}
					
						$this->assign("settings",$app->settings->settingValues);
			break;
		}
	   
			$this->assign('js', $js);
			$this->assign("meta",$meta);
			$this->display($template . ".tpl");
       }
	   
	   
	   
	   
		private function mapeditor(){
			
		}
		
		private function mobeditor(){
		global $app;
			// get the list of mobs for the select box
			$SQL = "SELECT * FROM mobs ORDER BY mob_id";
			$results = $app->db->query($SQL);
			$mobs = array();
			while ( $row = $app->db->fetchrow($results) ){
				$mobs[] = $row;
			}
			$this->assign("mobs",$mobs);
			
			if ( $_POST['save'] ){
				// the save routines... either update or insert new mob
				// see if an avatar was uploaded that needs to be processed
				if ( $_FILES['new_avatar'] ){
					$target = $app->path . "/avatar_tmp/" . basename($_FILES['new_avatar']['tmp_name']);
					$final_location = $app->path . $app->settings->getVal('avatar_dir') . "/mobs/mobavatar-" . md5(time()) . ".jpg";
				
					if ( move_uploaded_file($_FILES['new_avatar']['tmp_name'], $target) ){
						resampimagejpg(64,64,$target,$final_location);
						$_POST['mob']['mob_avatar'] = basename($final_location);
					} else {
						$errMsg = "Unable to update avatar - Error " . $_FILES['new_avatar']['error'];
					}
					
				}
				
				if ( $_POST['mob']['mob_id'] != "" ){
					// update
					$app->db->updateRow("mobs",$app->db->getTableCols("mobs"),$_POST['mob'],"mob_id",$_POST['mob']['mob_id']);
					$mob_id = $_POST['mob']['mob_id'];
				} else {
					// insert
					$mob_id = $app->db->insertRow("mobs",$app->db->getTableCols("mobs"),$_POST['mob'],"mob_id",$_POST['mob']['mob_id']);
				}
				header("location: /admin/mobeditor/?mob_id=" . $mob_id);
			}
			
			if ( $_GET['mob_id'] != "" ){
				$SQL = "SELECT * FROM mobs WHERE mob_id=" . $_GET['mob_id'];
				$mob = $app->db->queryrow($SQL);
				$this->assign("mob",$mob);
			}
			
		}
	   
  }
?>
