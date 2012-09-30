<?php

class clsPage extends Smarty {
	function renderPage($template){
		global $app;
		
		if ( $_POST['doit'] ){
			// send the e-mail!
			if ( $_POST['contact']['name'] && $_POST['contact']['email'] && $_POST['contact']['phone'] && $_POST['contact']['message'] ){
				sendTemplateEmail("micki@familyfrenzysale.com","FFS Contact: " . $_POST['contact']['subject'],"contact-us-email.tpl",$_POST,"brandon@familyfrenzysale.com",$_POST['contact']['email']);
				$errMsg = "Message Sent Successfully!";
			} else {
				$errMsg = "Please fill out all fields!";
				$this->assign("contact",$_POST['contact']);
			}
		}
		
		$meta = array("title"=>"Contact Family Frenzy Consignment Sale");
		$this->assign("err_msg",$errMsg);
		$this->assign("meta",$meta);
		$this->display($template . ".tpl");
	}
}

?>