<?php
	class clsPage extends Smarty {
		function renderPage($template,$pageArgs=""){
			global $app;
			global $plans;
			$meta = array("title" => "Signup","robots"=>"nofollow,noindex");
			$this->assign("meta",$meta);
			$this->assign("plans",$plans);
			
			if ( $_GET['cancel'] == "1" ){
				$SQL = "DELETE FROM users WHERE user_id = " . $app->user->data['user_id'];
				$app->db->query($SQL);
				$app->user->logout();
			}
			
			switch ( $template ){	
				case "signup":
					if ( $_POST['submit'] ){
						$error = false;
						debugLog($_POST);
						// verify all required information
						$requiredFields = array("user_cname","user_email","user_password","user_password2","terms");
						foreach ( $requiredFields as $v ){
							if ( $_POST['user']["$v"] == "" ){
								// didn't fill out one of the fields
								$error = true;
								$errorMsg = "Please fill out all fields and agree to the Terms of Use! ";
								$this->assign("user",$_POST['user']);
							}
						}
						
						if ( $_POST['user']['user_password'] != $_POST['user']['user_password2'] ){
							$error = true;
							$errorMsg = "Passwords did not match!";							
						}
						
						
						if ( $_POST['user']['user_promo'] != "" ){
							$SQL = "SELECT * FROM promo_codes WHERE promo_code = '" . strtoupper(addslashes($_POST['user']['user_promo'])) . "'";
							$pcode = $app->db->queryrow($SQL);							
							
							if ( $pcode === false ){
								$error = true;
								$errorMsg = "Promo code does not exists!";
								$_POST['user']['user_promo'] = "";
							}else if ( $pcode['promo_count'] == 0 || $pcode['promo_expires'] < time() ){
								$error = true;
								$errorMsg = "Promo code has expired or there are no more available";
								$_POST['user']['user_promo'] = "";
							} else {
								// it's valid
								$SQL = "UPDATE promo_codes SET promo_count = ( promo_count - 1 ) WHERE promo_code = '" . strtoupper(addslashes($_POST['user']['user_promo'])) . "'";
								$app->db->query($SQL);
								
								$_POST['user']['user_credit'] = $pcode['promo_value'];								
							}
							
						}
						
						if ( $error == false ){
							// see if this e-mail address is already in use
							$SQL = "SELECT * FROM users WHERE user_email = '" . addslashes($_POST['user']['user_email']) . "'";
							$results = $app->db->query($SQL);
							if ( $app->db->numrows($results) > 0 ){
								$error = true;
								$errorMsg = "Email address " . $_POST['user']['user_email'] . " already in use!";								
								$_POST['user']['user_email'] = "";								
							} else {
								// actually add them to the database now
								$_POST['user']['user_expires'] = (time() + 2592000);
								$_POST['user']['user_verified']='0';
								$_POST['user']['user_paid'] = '0';
								$_POST['user']['user_password'] = md5($_POST['user']['user_password']);
								$_POST['user']['user_verify_code'] = md5($_POST['user']['user_email'] . time());
								$_POST['user']['tile_id'] = 3;
								$_POST['user']['user_avatar'] = "noavatar.jpg";
								if ( $userid = $app->db->insertRow("users",$app->db->getTableCols('users'),$_POST['user']) ){
									// add them to a roster, whether we create one or add them to one they've been invited too...
									
									
									// send them a welcome email!
									$data['site_url'] = $app->settings->getVal('site_url');
									$_POST['user']['user_id'] = $userid;
									$data['user'] = $_POST['user'];
									sendTemplateEmail($_POST['user']['user_email'],"Welcome to " . $app->settings->getVal('site_name'),"welcome_email.tpl",$data,"brandon@bremaweb.com");
									$errorMsg = "Your account has been created. Please check your e-mail to verify your e-mail address and sign into your account!";
									// must create a session and move them onto the my account page									
									//$app->user->createSession($userid);
									//header("location: " . $app->settings->getVal('sec_url') . "/signup/payment");
									
								}
							}
							
						} 
						
						if ( $error === true ){
							$_POST['user']['user_password'] = "";
							$_POST['user']['user_password2'] = "";
							$this->assign("user",$_POST['user']);
						}
						
					}
				break;
				
				case "signup-payment":
					include("includes/quicklink.class.php");
					
					debugLog("Userdata:");
					debugLog($app->user->data);
					
					$plan = $plans[$app->user->data['user_membership_plan']];
					debugLog("Selected Plan:");
					debugLog($plan);								
					$chargeAmt = number_format($plan['price'] - $app->user->data['user_credit'],2,'.',',');
					
					if ( $chargeAmt == "0.00" )
						$_POST['submit'] = "1";	// if there is nothing to pay we will 'fake' a submit from the payment form to move the process along
					
					$this->assign("chargeAmt",$chargeAmt);
					$this->assign("planPrice",$plan['price']);
					$this->assign("plan",$plan);
					if ( $_POST['submit'] || $_POST['custom'] ){
							if ( $_POST['submit'] && $app->user->loggedIn == true ){
								debugLog("Credit Card");
									$qlink = new QuickLink("pj-ql-01","pj-ql-01p");
									
									if ( $chargeAmt != "0.00" )
										$result = $qlink->Charge($_POST['card']['cc_name'],$_POST['card']['cc_num'],$_POST['card']['cc_expm'],$_POST['card']['cc_expy'],$_POST['card']['cc_cvv'],"","","","",$chargeAmt,"");
									else 
										$credit=true;
									
									debugLog("Payment processing result!");
									debugLog($result);
								
								if ( $result['dc_response_code'] == "00" || $result['dc_response_code'] == "85" || $credit == true ){
									// all good
									// set some notes
									//$chknum = $result['dc_card_brand'] . " " . ltrim($result['dc_card_number'],'XXXX-') . " AUTH " . $result['dc_approval_code'] . " PayJunction";
									$trans_id = $result['dc_transaction_id'];								
									$app->db->updateRow("users",$app->db->getTableCols("users"),array("pj_trans_id"=>$trans_id,"user_verified"=>"1","user_paid"=>"1","user_expires"=>($app->user->data['user_expires'] + $plan['length'])),"user_id",$app->user->data['user_id']);
									
									if ( $chargeAmt < $plan['price'] )
										$app->user->updateVal(array("user_credit"=>($app->user->data['user_credit'] - $plan['price'])));
									
									sendTemplateEmail($app->user->data['user_email'],"Welcome to Inflatable Trading Post!","welcome_email.tpl",$app->user->data,"brandon@ambergentertainment.com");
									
									header("location: " . $app->settings->getVal('site_url') . "/myaccount");
									return;
								} else {
									$errorMsg = "Unable to process payment: " . $result['dc_response_message'];														
									//return;
								}						
							}
							
					}
				break;
				
				case "signup-payment-paypal":
					$plan = $plans[$app->user->data['user_membership_plan']];
					debugLog($plan);								
					$chargeAmt = number_format($plan['price'] - $app->user->data['user_credit'],2,'.',',');
					
					
					if ( $chargeAmt == "0.00" ){
						$this->assign("processed",true);
						$app->db->updateRow("users",$app->db->getTableCols("users"),array("pj_trans_id"=>$trans_id,"user_verified"=>"1","user_paid"=>"1","user_expires"=>($app->user->data['user_expires'] + $plan['length'])),"user_id",$app->user->data['user_id']);
									
						if ( $chargeAmt < $plan['price'] )
							$app->user->updateVal(array("user_credit"=>($app->user->data['user_credit'] - $plan['price'])));
						
						sendTemplateEmail($app->user->data['user_email'],"Welcome to Inflatable Trading Post!","welcome_email.tpl",$app->user->data,"brandon@ambergentertainment.com");
						
						//header("location: " . $app->settings->getVal('site_url') . "/myaccount");					
					} else {
						$this->assign("processed",false);
					}
					
				break;
			}
			/*
			if ( $_GET['verify'] ){
				$SQL = "SELECT * FROM users WHERE user_verify_code = '" . $_GET['verify'] . "' AND user_email = '" . $_GET['email'] . "'";
				$results = $app->db->query($SQL);
				if ( $app->db->numrows($results) > 0 ){
					$user = $app->db->fetchrow($results);
					$user['user_verified'] = '1';
					$app->db->updateRow("users",$app->db->getTableCols('users'),$user,"user_id",$user['user_id']);
					$errorMsg = "Your account has been successfully verified. You can now <a href=\"/login\">log in</a> to your account!";
				} else {
					$errorMsg = "Sorry, we were unable to verify your account. Try again. If this error persists please <a href=\"/contact-us\">contact us</a> and we will help you with this problem.";
				}
								
			}
			*/
			$this->assign("err_msg",$errorMsg);
			$this->display($template . ".tpl");
		}
	}
?>