<?php

$authorizedFunctions = array("getTileInfoById","getTileInfoByCoord","move");

function getTileInfoByCoord($x,$y,$z=0){
global $app;
	debugLog("getTileInfoByCoord($x,$y,$z)");

	$SQL = "SELECT * FROM tiles WHERE tile_x = $x AND tile_y = $y AND tile_z = $z";
	debugLog($SQL);
	$tileInfo = $app->db->queryrow($SQL);
$retXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$retXML .= "<tile>";
	if ( is_array($tileInfo) ){
		$retXML .= arrayToXML($tileInfo);
	} else {
		$retXML .= "<tile_id>new</tile_id>";
		$retXML .= "<tile_title></tile_title>";
		$retXML .= "<tile_x>" . $x . "</tile_x>";
		$retXML .= "<tile_y>" . $y . "</tile_y>";
		$retXML .= "<tile_z>" . $z . "</tile_z>";
	}
$retXML .= "</tile>";

return $retXML;
}

function getTileInfoById($tile_id){
global $app;
$retVal = array();

	$SQL = "SELECT * FROM tiles WHERE tile_id = $tile_id";
	$tileInfo = $app->db->queryrow($SQL);
/*
$retXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$retXML .= "<tile>";
	$retXML .= arrayToXML($tileInfo);
*/


$tileInfo['tile_exits'] = getTileExits(array("x" => $tileInfo['tile_x'],"y" => $tileInfo['tile_y'],"z" => $tileInfo['tile_z']));
$retVal['tile'] = $tileInfo;
$retVal['users'] = array();

//$retXML .= "<users>";

	$SQL = "SELECT users.user_cname, users.user_id,users.user_avatar FROM sessions INNER JOIN users ON users.user_id = sessions.user_id WHERE sessions.tile_id = " . $tile_id;
	$results = $app->db->query($SQL);
	while ( $row = $app->db->fetchrow($results) ){
		//$retXML .= "<user>\r\n";
		//$retXML .= arrayToXML($row);
		//$retXML .= "</user>\r\n";
		$retVal['users'][] = $row;
	}

//$retXML .= "</users>\r\n";

$retVal['mobs'] = array();
//$retXML .= "<mobs>\r\n";
	$SQL = "SELECT mobs.mob_name, mobs.mob_id,mobs.mob_avatar FROM mobs WHERE mobs.tile_id = " . $tile_id;
	$results = $app->db->query($SQL);
	while ( $row = $app->db->fetchrow($results) ){
//		$retXML .= "<mob>\r\n";
//		$retXML .= arrayToXML($row);
//		$retXML .= "</mob>\r\n";
		$retVal['mobs'][] = $row;
	}
//$retXML .= "</mobs>\r\n";
//$retXML .= "</tile>\r\n";

return json_encode($retVal);

}

function move($tile_id, $direction){
global $app;

	

	$SQL = "SELECT tile_resistance FROM tiles WHERE tile_id = " . $tile_id;
	$tile = $app->db->queryrow($SQL);
	
	if ( $app->user->data['user_energy'] < $tile['tile_resistance'] ){
		//
		return json_encode(array('success'=>false,'message'=>'You do not have enough energy'));
	}
	
	$SQL = "UPDATE users SET tile_id = ". $tile_id . ", user_energy = ( user_energy - (" . $tile['tile_resistance'] . " / user_stamina ) ) WHERE user_id = " . $app->user->data['user_id'];
	$app->db->query($SQL);
	
	$SQL = "UPDATE sessions SET tile_id = " . $tile_id . " WHERE user_id = " . $app->user->data['user_id'];
	$app->db->query($SQL);

	

	activityLog($tile_id,$app->user->data['user_id'],"","showUser(" . $app->user->data['user_id'] . ",'" . $app->user->data['user_cname'] . "','" . $app->user->data['user_avatar'] . "');");
	//$SQL = "INSERT INTO activity (activity_dt,tile_id,user_id,activity_message,activity_js) values(" . time() . "," . $tile_id . "," . $app->user->data['user_id'] . ",'<![CDATA[" . $app->user->data['user_cname'] . " has arrived]]>','<![CDATA[showUser(" . $app->user->data['user_id'] . ",\'" . $app->user->data['user_cname'] . "\');]]>')";
	//$app->db->query($SQL);
	
	activityLog($app->user->data['tile_id'],$app->user->data['user_id'],"","removeUser(" . $app->user->data['user_id'] . ");");
	//$SQL = "INSERT INTO activity (activity_dt,tile_id,user_id,activity_message,activity_js) values(" . time() . "," . $app->user->data['tile_id'] . "," . $app->user->data['user_id'] . ",'<![CDATA[" . $app->user->data['user_cname'] . " left to the " . $direction . "]]>','<![CDATA[removeUser(\'" . $app->user->data['user_id'] . "\');]]>')";
	//$app->db->query($SQL);
	
	return json_encode(array('success'=>true,'tile_id'=>$tile_id));
}

?>