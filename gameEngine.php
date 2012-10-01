<?php
ini_set("display_errors",0);
include("includes/config.php");

$cli = isCli();

if ( $cli == true )
	$lineEnd = "\r\n";
else
	$lineEnd = "<br />";

if ( !$cli ){
?>
<html>
<head>
<title>RPG Game Engine</title>

<script type="text/javascript">
	window.setTimeout(function (){
		window.
	}, 5500);
</script>

</head>
<body>
<?
}

echo "RPG Game Engine" . $lineEnd;
echo "Loading settings...";



$app = new application;
$app->settings->loadSettings();

echo "done." . $lineEnd;
echo $lineEnd ;

$strE = array("north","south","east","west","up","down");

do {
// move mobs
$SQL = "SELECT mobs.mob_name,mobs.mob_id,tiles.tile_x,tiles.tile_y,tiles.tile_z,mobs.tile_id,mobs.mob_avatar FROM mobs INNER JOIN tiles ON tiles.tile_id = mobs.tile_id WHERE mob_stationary = 0";
$results = $app->db->query($SQL);
while ( $mob = $app->db->fetchrow($results) ){
	$exits = getTileExits(array("x"=>$mob['tile_x'],"y"=>$mob['tile_y'],"z"=>$mob['tile_z']));
	//debugLog($exits);
		$dir = rand(0,28);
	if ( @$exits["{$strE[$dir]}"] ){
		// move the mob in a direction
		//echo "New Tile: " . $xmlObj->exit[$dir]->tile_id . "" . $lineEnd ;
		$new_tile = $exits["{$strE[$dir]}"]['tile_id'];
		$SQL = "UPDATE mobs SET tile_id = " . $new_tile . " WHERE mob_id = " . $mob['mob_id'];
		$app->db->query($SQL);
		echo("Moving mob " . $mob['mob_name'] . " " . $strE[$dir] . "" . $lineEnd );
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
	echo "Activity Rows Deleted: " . $app->db->affectedrows($results) . "" . $lineEnd ;

// check expired sessions
$SQL = "SELECT * FROM sessions WHERE session_expire < " . time();
$results = $app->db->query($SQL);
while ( $row = $app->db->fetchrow($results) ){
	echo "Killing session for user_id " . $row['user_id'] . $lineEnd;
	activityLog($row['tile_id'],0,"","removeUser(" . $row['user_id'] . ");");
	$SQL = "DELETE FROM sessions WHERE session_id = '" . $row['session_id'] . "'";
	$app->db->query($SQL);
}

if ( $cli )
	sleep(5);
	
} while ( $cli );


if ( $cli == false ){
?>
</body>
</html>
<?
}
?>