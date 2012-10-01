<?php

function errorLog($txt){
global $app;
if ( $app->init == false )
	return;
	
      	$el = fopen($app->path . "/logs/error_" . date("m-d-Y") . ".txt", "a+");
      		fwrite($el,"[" . date("m/d/Y H:i:s") . "] " . $txt . "\r\n");
      	fclose($el);      	
}
      
function debugLog($txt){
global $app;
//if ( $app->init == false )
//	return;

    if ( $app->settings->getVal('debug') ){
		$debugFile = $app->path . "/logs/debug_" . date("m-d-Y") . ".txt";
		if ( is_array($txt) ){
		ksort($txt);
		ob_start();
			print_r($txt);
		$buff = ob_get_clean();
	
		$txt = $buff;
	}
	
		$text = "[" . date("m/d/Y H:i:s") . "] " . $txt;
		$h = fopen($debugFile,"a+");
			fwrite($h,$text . "\r\n");
		fclose($h);
	}
}

function debugPrint($txt){
	debugLog($txt);
}

function ucarray($ary,$exclude=""){
// capitalized all fields in an array
$retArray = array();
if ( is_array($ary) ){
	foreach ( $ary as $k => $v ){		
		if ( !in_array($k,$exclude) ) {
			if ( !is_array($v) )
				$v = strtolower($v);
					$retArray["$k"] = ucarray($v,$exclude);			
			
		} else  {
			$retArray["$k"] = $v;
		}
	
	}
} else {
	return ucwords($ary);
}

return $retArray;

}

function requireLogin(){
global $app;
/*
	if ( $_COOKIE['mpn_sessid'] != "" ){
	// there is a session here
		$app->user->restoreSession($_COOKIE['mpn_sessid']);
	}
*/
   // make sure they are logged in properly or give them the boot
   if ( $app->user->loggedIn == false ){
		header("location: " . $app->settings->getVal('site_url') . "/login");
		exit;
	}
}

function requireAdminLogin(){
	global $app;
	/*
	if ( $_COOKIE['mpn_sessid'] != "" ){
	// there is a session here
		$app->user->restoreSession($_COOKIE['mpn_sessid']);
	}
	*/
   // make sure they are logged in properly or give them the boot
   if ( $app->user->loggedIn == false ){
		header("location: " . $app->settings->getVal('site_url') . "/login");
		exit;
	}
	
	if ( $app->user->data['user_admin'] == 0 ){
		header("location: " . $app->settings->getVal('site_url') . "/");
		exit;
	}
}

function arrayToXML($ary){
$xmldata = "";
	foreach ( $ary as $k => $v ){
		$xmldata .= "\t<" . $k . ">";
			if ( is_array($v) )
				$xmldata .= "\r\n\t" . arrayToXML($v);
			else
				$xmldata .= $v;
		$xmldata .= "</" . $k . ">\r\n";
	}
	
	return $xmldata;
}

function activityLog($tile_id,$user_id,$activity_message,$activity_js=""){
global $app;

	$SQL = "INSERT INTO activity ( activity_dt, tile_id, user_id, activity_message, activity_js ) values(" . round(microtime(true),2) . "," . $tile_id . "," . $user_id . ",'" . addslashes($activity_message) . "','" . addslashes($activity_js) . "')";
	$app->db->query($SQL);
	debugLog($SQL);
}

function resampimagejpg( $forcedwidth, $forcedheight, $sourcefile, $destfile )
{
    $fw = $forcedwidth;
    $fh = $forcedheight;
    $is = getimagesize( $sourcefile );
    if( $is[0] >= $is[1] )
    {
        $orientation = 0;
    }
    else
    {
        $orientation = 1;
        $fw = $forcedheight;
        $fh = $forcedwidth;
    }
    if ( $is[0] > $fw || $is[1] > $fh )
    {
        if( ( $is[0] - $fw ) >= ( $is[1] - $fh ) )
        {
            $iw = $fw;
            $ih = ( $fw / $is[0] ) * $is[1];
        }
        else
        {
            $ih = $fh;
            $iw = ( $ih / $is[1] ) * $is[0];
        }
        $t = 1;
    }
    else
    {
        $iw = $is[0];
        $ih = $is[1];
        $t = 2;
    }
    if ( $t == 1 )
    {
        $img_src = imagecreatefromjpeg( $sourcefile );
        $img_dst = imagecreatetruecolor( $iw, $ih );
        imagecopyresampled( $img_dst, $img_src, 0, 0, 0, 0, $iw, $ih, $is[0], $is[1] );
        if( !imagejpeg( $img_dst, $destfile, 90 ) )
        {
            exit( );
        }
    }
    else if ( $t == 2 )
    {
        copy( $sourcefile, $destfile );
    }
}
 
function isCli() {
 
     if(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR'])) {
          return true;
     } else {
          return false;
     }
}

function getTileExits($coords){
global $app;
	$retVal = array();
	
		// north
		$SQL = "SELECT tile_id FROM tiles WHERE tile_x = " . $coords['x'] . " AND tile_y = " . ( $coords['y'] + 1 ) . " AND tile_z = " . $coords['z'];
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) > 0 ){
			$r = $app->db->fetchrow($results);
			$retVal['north'] = array('tile_id'=>$r['tile_id']);
		}
		debugPrint($SQL);
		// south
		$SQL = "SELECT tile_id FROM tiles WHERE tile_x = " . $coords['x'] . " AND tile_y = " . ( $coords['y'] - 1 ) . " AND tile_z = " . $coords['z'];
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) > 0 ){
			$r = $app->db->fetchrow($results);
			$retVal['south'] = array('tile_id'=>$r['tile_id']);
		}
		debugPrint($SQL);
		// east
		$SQL = "SELECT tile_id FROM tiles WHERE tile_x = " . ($coords['x'] + 1) . " AND tile_y = " . ( $coords['y'] ) . " AND tile_z = " . $coords['z'];
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) > 0 ){
			$r = $app->db->fetchrow($results);
			$retVal['east'] = array('tile_id'=>$r['tile_id']);
		}
		debugPrint($SQL);
		// west
		$SQL = "SELECT tile_id FROM tiles WHERE tile_x = " . ($coords['x'] - 1) . " AND tile_y = " . ( $coords['y']  ) . " AND tile_z = " . $coords['z'];
		$results = $app->db->query($SQL);
		if ( $app->db->numrows($results) > 0 ){
			$r = $app->db->fetchrow($results);
			$retVal['west'] = array('tile_id'=>$r['tile_id']);
		}
		debugPrint($SQL);
		
	return $retVal;
}
 
?>
