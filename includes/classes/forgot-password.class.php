<?php
  class clsPage extends Smarty {
       function renderPage($template){
           global $app;
	   $meta = array("keywords" => "consignment sale,consign,family frenzy",
			"description" => "",
			"robots" => "nofollow,noindex",
			"title" => "Forgot Password - Family Frenzy");
				
				if ( $_POST['doit'] ){
					$SQL = "SELECT user_email FROM users WHERE user_email = '" . addslashes($_POST['email_address']) . "'";
					$results = $app->db->query($SQL);
					if ( $app->db->numrows($results) > 0 ){
						$verifyCode = md5($_POST['email_address'] . time());
						$SQL = "UPDATE users SET user_verify_code='" . $verifyCode . "' WHERE user_email = '" . addslashes($_POST['email_address']) . "'";
						$app->db->query($SQL);
						
						$data['verify_code'] = $verifyCode;
						$data['email_address'] = $_POST['email_address'];
						$data['site_url'] = $app->settings->getVal('site_url');
						sendTemplateEmail($_POST['email_address'],'Family Frenzy Password Reset','reset-password.tpl',$data);
					}
					$errMsg = "Password reset sent!";
				}
				
				if ( $_GET['email']  && $_GET['code'] ){
					$SQL = "SELECT * FROM users WHERE user_email='" . addslashes($_GET['email']) . "' AND user_verify_code='" . addslashes($_GET['code']) . "'";
					$results = $app->db->query($SQL);
					if ( $app->db->numrows($results) > 0 ){
						// give them the password reset form
						$row = $app->db->fetchrow($results);
						$template = "password-reset";
						$this->assign("code",$_GET['code']);
						$this->assign("email",$_GET['email']);
						$this->assign("user_id",$row['user_id']);
						$meta['title'] = "Choose New Password - Family Frenzy";
					} else {
						$errMsg = "Error resetting password!";
					}
				}
				
				if ( $_GET['reset'] ){
					if ( $_POST['new_password'] == $_POST['new_password2'] && $_POST['new_password'] != "" ){
						$SQL = "UPDATE users SET user_password='" . md5($_POST['new_password']) . "' WHERE user_id=" . $_POST['user_id'] . " AND user_email='" . addslashes($_POST['email']) . "' AND user_verify_code='" . addslashes($_POST['code']) . "'";
						if ( $app->db->query($SQL) )
							$errMsg = "Password reset successful!";
						else
							$errMsg = "Unable to reset password, please try again!";
						
					}
				}
				
			$this->assign("err_msg",$errMsg);
	   $this->assign("meta",$meta);
           $this->display($template . ".tpl");
       }
  }
?>
