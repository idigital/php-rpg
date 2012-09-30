<?php

echo "RPG Game Engine\r\n";
echo "Loading settings...";
include("includes/config.php");
$app = new application;
$app->settings->loadSettings();
echo "done.\r\n";
echo "\r\n";

$strE = array("north","south","east","west","up","down");

while (1){
// move mobs
$SQL = "SELECT mobs.mob_name,mobs.mob_id,tiles.tile_exits,mobs.tile_id,mobs.mob_avatar FROM mobs INNER JOIN tiles ON tiles.tile_id = mobs.tile_id WHERE mob_stationary = 0";
$results = $app->db->query($SQL);
while ( $mob = $app->db->fetchrow($results) ){
	$exits = unserialize($mob['tile_exits']);
	//debugLog($exits);
		$dir = rand(0,28);
	if ( @$exits["{$strE[$dir]}"] ){
		// move the mob in a direction
		//echo "New Tile: " . $xmlObj->exit[$dir]->tile_id . "\r\n";
		$new_tile = $exits["{$strE[$dir]}"]['tile_id'];
		$SQL = "UPDATE mobs SET tile_id = " . $new_tile . " WHERE mob_id = " . $mob['mob_id'];
		$app->db->query($SQL);
		echo("Moving mob " . $mob['mob_name'] . " " . $strE[$dir] . "\r\n");
		activityLog($mob['tile_id'],0,"","removeMob(" . $mob['mob_id'] . ");");
		activityLog($new_tile,0,"","showMob(" . $mob['mob_id'] . ",'" . $mob['mob_name'] . "','" . $mob['mob_avatar'] . "');");
	}
}

$SQL = "UPDATE users SET user_energy = ( user_energy + ( user_stamina / 60 ) ) WHERE user_id IN ( SELECT user_id FROM sessions ) AND user_energy < 1";
$app->db->query($SQL);

// delete old activity log entries... we are only going to store 60 seconds on activity log... that should be enough
$SQL = "DELETE FROM activity WHERE activity_dt < " . (time()  - 60);
$results = $app->db->query($SQL);
if ( $app->db->affectedrows($results) > 0 )
	echo "Activity Rows Deleted: " . $app->db->affectedrows($results) . "\r\n";

// check expired sessions
$SQL = "SELECT * FROM sessions WHERE sessions_expire < " . time();
$results = $app->db->query($SQL);
while ( $row = $app->db->fetchrow($results) ){
	echo "Killing session for " . $row['user_id'];
	activityLog($row['tile_id'],0,"","removeUser(" . $row['user_id'] . ");");
}
	
sleep(5);
}