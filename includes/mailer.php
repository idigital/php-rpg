<?php
require('includes/phpMailer/class.phpmailer.php');

$mailer = new phpMailer(true);
$mailer->IsSMTP();
$mailer->SMTPAuth = true;
$mailer->Username = "no-reply@bremaweb.com";
$mailer->Password = "123nrpass";
$mailer->Host = "smtp.gmail.com";
$mailer->Port = "465";
$mailer->SMTPSecure = "ssl";
$mailer->Mailer = "smtp";

$mailer->AddReplyTo('no-reply@bremaweb.com', 'Brema Web');
$mailer->SetFrom('no-reply@bremaweb.com', 'Brema Web');

function sendTemplateEmail($to,$subject,$template,$template_data,$bcc="",$reply_to=""){
global $mailer;
global $app;
	$smarty = new Smarty;
	
	$smarty->template_dir = $app->settings->getVal('template_dir');
	$smarty->compile_dir = $app->settings->getVal('template_dir') . "_c";
	
	$smarty->assign($template_data);
	
	$htmlMsg = $smarty->fetch($template);
	
	return sendEmail($to,$subject,$htmlMsg,$bcc,$reply_to);
}

function sendEmail($to,$subject,$message,$bcc="",$reply_to=""){
	global $mailer;
	try {
		$mailer->MsgHTML($message);
		if ( is_array($to) ) {
			foreach ( $to as $v )
				$mailer->AddAddress($v);
		} else {
			$mailer->AddAddress($to);
		}
		
		if ( $bcc )
			$mailer->AddBCC($bcc);
		
		if ( $reply_to ){
			$mailer->ClearReplyTos();
			$mailer->AddReplyTo($reply_to);
		}
		
		$mailer->Subject = $subject;
		
		$mailer->Send();
	} catch ( phpMailerException $e ){
		debugLog("phpMailerException: " . $e->errorMessage());
		$app->cacheMail($mailer);
		return false;
	}
	resetMailer();
	return true;
}

function resetMailer(){
	// clears all names and messages
	global $mailer;
	$mailer->ClearAllRecipients();
	$mailer->ClearAttachments();
	$mailer->ClearCustomHeaders();
}

  function sendTestMessage(){
    global $mailer;
    $mailer->Body = "This is a test message from Family Frenzy Sale";
    $mailer->Subject = "Email Subject";
    $mailer->AddAddress("brandon.reese@gmail.com","Brandon Bohannon");    
    if ( $mailer->Send() )
        echo "Message Sent";
    else
        echo $mailer->ErrorInfo;
  }
?>
