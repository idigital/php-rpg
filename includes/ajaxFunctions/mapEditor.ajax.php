<?php
/*
	All map editor specific ajax requests
*/

$authorizedFunctions = array("loadMap","saveTile");

$exits = array("north"=>array(0,1,0),"south"=>array(0,-1,0),"east"=>array(1,0,0),"west"=>array(-1,0,0),"up"=>array(0,0,1),"down"=>array(0,0,-1));

function loadMap($x,$y, $z=0){
global $app;
	$SQL = "SELECT * FROM tiles WHERE tile_x BETWEEN " . $x . " AND " . ( $x + 10 ) . " AND tile_y BETWEEN " . ( $y - 10 ) . " AND " . $y . " AND tile_z = " . $z;
	debugLog("loadMap SQL:" . $SQL);
	$results = $app->db->query($SQL);
$retXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$retXML .= "<maps>\r\n";
	while ( $row = $app->db->fetchrow($results) ){
		$retXML .= "<tile>\r\n";
		$retXML .= arrayToXML($row);
		$retXML .= "</tile>\r\n";
	}
$retXML .= "</maps>\r\n";

return $retXML;
}

function saveTile($tile_id,$tile_title,$tile_x,$tile_y,$tile_z,$tile_desc,$exit_update=false){
global $app;
global $exits;
debugLog("saveTile($tile_id,$tile_title,$tile_x,$tile_y,$tile_z,$tile_desc,$exits=false)");
// determine the exits & build the XML for these exits
$strExits = "";
$exit = array();
foreach ( $exits as $k => $v ){
	$SQL = "SELECT tile_id FROM tiles WHERE tile_x=" . ( $tile_x + $v[0] ) . " AND tile_y=" . ( $tile_y + $v[1] ) . " AND tile_z = " . ( $tile_z + $v[2] );
	$results = $app->db->query($SQL);
	if ( $app->db->numrows($results) > 0 ) {
		$row = $app->db->fetchrow($results);
		$exit[$k] = $row;
		//$strExits .= "<exit>\r\n";
		//$strExits .= "<direction>" . $k . "</direction>\r\n";
		//$strExits .= "<tile_id>" . $row['tile_id'] . "</tile_id>\r\n";
		//$strExits .= "</exit>\r\n";
		// hackish, but resave the tile's to update their exits
		if ( $exit_update == false ){
			$SQL = "SELECT * FROM tiles WHERE tile_id = " . $row['tile_id'];
			$tr = $app->db->queryrow($SQL);
			saveTile($tr['tile_id'],$tr['tile_title'],$tr['tile_x'],$tr['tile_y'],$tr['tile_z'],$tr['tile_desc'],true);
		}
	}
}
debugLog($exit);

	if ( $tile_id == "new" ){
		$SQL = "INSERT INTO tiles (tile_title,tile_x,tile_y,tile_z,tile_desc,tile_exits) values('" . addslashes($tile_title) . "'," . $tile_x . "," . $tile_y . "," . $tile_z . ",'" . addslashes($tile_desc) . "','" . serialize($exit) . "')";
		if ( !$app->db->query($SQL) ){
			$error = "1";
			$msg = mysql_error() . "\r\n\r\n" . $SQL;
		} else {
			$error = "0";
			$msg = "New tile '" . $tile_title . "' saved successfully!";
		}
			
	} else {
		$SQL = "UPDATE tiles set tile_title='" . addslashes($tile_title) . "', tile_x=" . $tile_x . ",tile_y=" . $tile_y . ",tile_z=" . $tile_z . ", tile_desc='" . addslashes($tile_desc) . "', tile_exits='" . serialize($exit) . "' WHERE tile_id=" . $tile_id;
		if ( !$app->db->query($SQL) ){
			$error = "1";
			$msg = mysql_error() . "\r\n\r\n" . $SQL;
		} else {
			$error = "0";
			$msg = "Tile '" . $tile_title . "' saved successfully!";
		}
	}
	
	debugLog("Save tile SQL:" . $SQL);
	
	
$retXML = <<<HEREDOC
<tile>
	<error>$error</error>
	<msg>$msg</msg>
	<tile_x>$tile_x</tile_x>
	<tile_y>$tile_y</tile_y>
</tile>
HEREDOC;
	
	return $retXML;
}
?>