<?php
class user {

	public $loggedIn = false;
	public $data = array();
	private $type;
	
	function __construct(){
		global $app;
		// check to see if a session is active when the user is created
		$this->restoreSession($_COOKIE['mpn_sessid']);
	}
	
	function changePassword($newPassword){
		global $app;
			$SQL = "UPDATE users SET user_password='" . md5($newPassword) . "' WHERE user_id = " . $this->data['user_id'];
			$app->db->query($SQL);
	}
	
	function restoreSession($sessid){
		global $app;				
		//debugLog("restoreSession($sessid)");
		$SQL = "SELECT * FROM sessions WHERE session_id = '" . $sessid . "' AND session_expire > " . time();
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) ) {
			//debugLog("Restoring session");
			$user = $app->db->fetchrow($results);
			$SQL = "UPDATE sessions SET session_expire = " . (time() + 3600) . " WHERE session_id = '" . $sessid . "'";
			$app->db->query($SQL);
			$this->loggedIn = true;
			$this->loadUser($user['user_id']);
			$this->data['loggedIn'] = true;
		} else {
			//debugLog("Session does not exist or is expired");
			$this->loggedIn = false;
			$this->data['loggedIn'] = false;
		}		
	}
	
	function createSession($userid){	
		global $app;	
		debugLog("createSession($userid)");
		$sessid = md5( ($userid . time()) );
		$SQL = "SELECT * FROM sessions WHERE user_id = " . $userid;
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) > 0 ){
			debugLog("sessions row for userid exists");
			$SQL = "UPDATE sessions SET session_id = '" . $sessid . "', session_expire = " . (time() + 3600) . " WHERE user_id = " . $userid;
			$app->db->query($SQL);	
		} else {
			debugLog("creating new session row");
			$SQL = "INSERT INTO sessions (session_id,user_id,session_expire,tile_id) values('" . $sessid . "'," . $userid . "," . (time() + 3600) . "," . $this->data['tile_id'] . ")";
			$app->db->query($SQL);	
		}
		
		debugLog("Sessid: " . $sessid);
		setCookie("mpn_sessid",$sessid);		
		$this->loggedIn = true;
	}
	
	function login($email,$password){
		global $app;
		debugLog("login($email,$password)");
		$SQL = "SELECT * FROM users WHERE user_email = '" . $email . "' AND user_password = '" . md5($password) . "'";
					
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) == 0 ){
			//debugLog("login fail!");
			return false;
		} else {
			//debugLog("login success!");
			$row = $app->db->fetchrow($results);
			$this->data = $row;
			
			$this->createSession($row['user_id']);
			return true;
		}	
	}
	
	function logout(){
		// destroy the session from the database
		global $app;
		
		$SQL = "DELETE FROM sessions WHERE session_id = '" . $_COOKIE['mpn_sessid'] . "' OR session_expire < " . time();
		$app->db->query($SQL);
		
		//debugLog("logout()");
		setCookie("mpn_sessid","");
		header("location: " . $app->settings->getVal('site_url') );	
	}
	
	
	
	function loadUser($userid){
		global $app;
		//debugLog("loadUser($userid)");
		$SQL = "SELECT * FROM users WHERE user_id = " . $userid;
		$this->data = $app->db->queryrow($SQL);
		
		if ( is_object($app->page) )
			$app->page->assign("user",$this->data);	
	}
}
?>