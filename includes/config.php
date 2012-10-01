<?php
$appPath = dirname(dirname(__FILE__));

set_include_path($appPath); 
  
//define("SMARTY_DIR","includes/smarty/");
include($appPath . "/includes/globals.php");

  include($appPath . "/includes/smarty/Smarty.class.php");  
  include($appPath . "/includes/settings.class.php");
  include($appPath . "/includes/bible_settings.php");
  include($appPath . "/includes/app.class.php");  
  include($appPath . "/includes/db.class.php");
  include($appPath . "/includes/user.class.php");
  include($appPath . "/includes/dbVariables.php");
  
  // this file creates a mailer object and has some functions to make setting up
  // to send a message easier
  include($appPath . "/includes/mailer.php");
  
  include($appPath . "/includes/functions.php");
  include($appPath . "/includes/captcha_functions.php");
  include($appPath . "/includes/twitter_functions.php");
  include($appPath . "/includes/functions_htmlrend.php");


  
if ( !isCli() ){

session_start();


  if ( $_SESSION['language'] == "" ){
		$_SESSION['language'] = "english";
  }
  
  
  		if ( stripos($_SERVER['HTTP_USER_AGENT'],"iphone") !== false ){
  			$_SESSION['browser'] = "iphone/";
  		} else {
  			$_SESSION['browser'] = "";
  		}
  
}
  

  ?>
