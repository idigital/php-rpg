<?php

$authorizedFunctions = array("initializeGame","updateGame","doChat","updateStats");

function initializeGame($user_id){
global $app;
$settings = array();	
	$SQL = "SELECT * FROM settings";
	$results = $app->db->query($SQL);

	//$retXML = "<settings>\r\n";
	while ( $row = $app->db->fetchrow($results) ){
		$settings["{$row['setting']}"] = $row['setting_value'];
		//$retXML .= "<" . $row['setting'] . ">" . $row['setting_value'] . "</" . $row['setting'] . ">\r\n";
	}
	
	//$retXML .= "</settings>\r\n";
	$retVal = json_encode($settings);
	return $retVal;
}


function updateGame($last_id){
global $app;
$retVal = array("last_id"=>"","activity"=>array());
	// this loads all activities since the last update
	$SQL = "SELECT activity_message,activity_js,activity_id FROM activity WHERE ( tile_id = " . $app->user->data['tile_id'] . " OR tile_id = 0 ) AND user_id != " . $app->user->data['user_id'] . " AND activity_id > " . $last_id . " ORDER BY activity_dt ASC";
	$results = $app->db->query($SQL);
	if ( $app->db->numrows($results) > 0 ){
		//$retXML = "<activity>\r\n";
		//$retXML .= "<update_time>" . microtime(true) . "</update_time>\r\n";
		//$retVal['update_time'] = microtime(true);
		while ( $row =  $app->db->fetchrow($results) ){
			$retVal['activity'][] = $row;
			//$retXML .= "<activity_row>\r\n";
			//$retXML .= arrayToXML($row);
			//$retXML .= "</activity_row>\r\n";
			//if ( $row['activity_id'] > $retVal['last_id'] )
			$retVal['last_id'] = $row['activity_id'];
		}
		//$retXML .= "</activity>\r\n";
		//return $retXML;
		$retVal = json_encode($retVal);
		return $retVal;
	}
}

function doChat($message){
global $app;
	activityLog($app->user->data['tile_id'],$app->user->data['user_id'],$app->user->data['user_cname'] . " says, &quot;" . $message . "&quot;");
}

function updateStats(){
global $app;
	$SQL = "SELECT user_health,user_mana,user_energy FROM users WHERE user_id = " . $app->user->data['user_id'];
	$stats = $app->db->queryrow($SQL);

$retVal = json_encode($stats);
return $retVal;
	
}
?>