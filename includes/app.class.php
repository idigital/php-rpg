<?php
  class application {
      public $db;
      var $page;
      var $settings;
	  var $path;
	  public $init;
      public $user;
	  
      function __construct(){
			$this->init=false;
			// find the root path for the MPN application, I like to use full paths for accessing files when possible
			$this->path = dirname(dirname(__FILE__));
			
	        $this->db = new dbClass("10.0.0.225","3306","rpg2011","root","dbpa55");
			//$this->db = new dbClass("mysql.familyfrenzysale.com","3306","ff_consign","familyfrenzy","ffsalepass5");
	        $this->settings = new clsSettings();
	        $this->init=true;
      }

      function cacheMail($mailObject){
      	// here we serialize the mailer object and store it in a file to attempt to mail it later
      	$smailObject = serialize($mailObject);
      	$fh = fopen($this->path . "\mail_spool\\" . md5(time() . $user['user_email']),"w+");
			fwrite($fh,$smailObject);			
		fclose($fh);
      }

  }
?>
