<?php
  function getVerse(){
      global $app;
            $verse_pointer = $app->settings->getVal('verse_pointer');
           
           if ( $verse_pointer > $app->settings->getVal('num_verses') )
            $verse_pointer = 1;
            
           $SQL="SELECT * FROM verses WHERE verse_id = " . $verse_pointer;
           $results = $app->db->query($SQL);
           $row = $app->db->fetchrow($results);
           $verse_pointer=$verse_pointer+1;
           $app->settings->setVal('verse_pointer',$verse_pointer);
           
           $search = array("prayed","prayer","pray","prayers");
           $replace = array("<b>prayed</b>","<b>prayer</b>","<b>pray</b>");
           $row['verse_text'] = str_ireplace($search,$replace,$row['verse_text']);   
           
           return array($row['verse_text'],$row['verse_ref']);
  }
  
// calculates the distances based on latitude and longitude
  function calcDist($lat_A, $long_A, $lat_B, $long_B) {

  $distance = sin(deg2rad($lat_A))
                * sin(deg2rad($lat_B))
                + cos(deg2rad($lat_A))
                * cos(deg2rad($lat_B))
                * cos(deg2rad($long_A - $long_B));

  $distance = (rad2deg(acos($distance))) * 69.09;

  return $distance;
}

function getLatLonRange($lat_A, $lon_A, $distance){
    $lat_range = $distance/69.172;
    $lon_range = abs($distance/(cos($lon_A) * 69.172));
    
    $min_lat = $lat_A - $lat_range;
    $max_lat = $lat_A + $lat_range;
    $min_lon = $lon_A - $lon_range;
    $max_lon = $lon_A + $lon_range;   
    
    return array($min_lat,$max_lat,$min_lon,$max_lon);
}

// now how do we take the distance and find the furthest latitudes and longitudes that
// distance encompasses?

function getChurchesInArea($lat_A, $lon_A, $distance ){
global $app;
    
    list($min_lat,$max_lat,$min_lon,$max_lon) = getLatLonRange($lat_A,$lon_A,$distance);
        
    // now pull all of the churches from the database within this latitude and longitude
    $SQL = "SELECT * FROM churches WHERE ( church_lat BETWEEN $min_lat AND $max_lat ) AND ( church_lon BETWEEN $min_lon AND $max_lon ) AND church_active = 1 AND church_type != 3 ORDER BY church_name";
    $results = $app->db->query($SQL);

    while ( $row = $app->db->fetchrow($results) )
        $retVal[] = $row['church_id'];   
    
    
    return $retVal;
}

function getUsersInArea($lat_A, $lon_A, $distance ){
global $app;
    
    list($min_lat,$max_lat,$min_lon,$max_lon) = getLatLonRange($lat_A,$lon_A,$distance);
    
    // now pull all of the users from the database within this latitude and longitude
    $SQL = "SELECT * FROM users WHERE ( user_lat BETWEEN $min_lat AND $max_lat ) AND ( user_lon BETWEEN $min_lon AND $max_lon )";
    $results = $app->db->query($SQL);

    while ( $row = $app->db->fetchrow($results) )
        $retVal[] = $row['user_id'];   
    
    
    return $retVal;
}

function geocodeAddress($address,$address2,$city,$state,$zip,$country){
// geocodes the address using the google api, this will give of the latitude and longitude
// of the address as well as tells us if the address is valid
global $googleAPIKey;

if ( $address && $address2 )
    $strAddress = $address . "," . $address2 . ",";
elseif ( $address && !$address2 )
    $strAddress = $address . ",";
else
    $strAddress = "";

$http = "http://maps.google$country/maps/geo?q=" . urlencode($strAddress) . urlencode($city) . "," . urlencode($state) . "," . urlencode($zip) . "&output=csv&key=$googleAPIKey";

$location = file($http);

list ($stat,$acc,$north,$east) = explode(",",$location[0]);
  $retVal['latitude'] = $north;
  $retVal['longitude'] = $east;
  
  return $retVal;  
}

function getGeoInfo($address,$address2,$city,$state,$zipcode,$country){
global $app;
if ( !$address && !$address2 ){
    $SQL = "SELECT latitude,longitude FROM zip_codes WHERE state = '$state' and zip = '$zipcode' and city='" . $city . "' and country='" . $country . "'";
    $results = $app->db->query($SQL,true);
    if ( $app->db->numrows($results) > 0 ){
        $retVal = $app->db->fetchrow($results);
    } else {
        // it's not in our geocoding database, so we pull the information from google maps
        $retVal = geocodeAddress($address,$address2,$city,$state,$zipcode,$country);        
        //print_r($retVal);
        $SQL = "INSERT INTO zip_codes (zip,state,latitude,longitude,city,country) values('$zipcode','$state','" . $retVal['latitude'] . "','" . $retVal['longitude'] . "','$city','$country')";        
        $app->db->query($SQL,true);
    }
} else {
    // we geocode the actual address when a full address is given
    $retVal = geocodeAddress($address,$address2,$city,$state,$zipcode,$country);        
}
    return $retVal;
}

function getChurchInfo($church_id){
global $app;
    $SQL = "SELECT * FROM churches WHERE church_id = " . $church_id;
    $row = $app->db->queryrow($SQL,true);
    
    return $row;  
}

function getVerseESV($book,$chapter,$verse){

	$url = "http://www.esvapi.org/v2/rest/passageQuery?key=IP&passage=" . $book . "%20" . $chapter . ":" . $verse . "&output-format=crossway-xml-1.0";
	$xml = file_get_contents($url);
	
	$p = xml_parser_create();
		xml_parse_into_struct($p, $xml, $vals, $index);
	xml_parser_free($p);
	
	debugPrint("Vals:");
	debugPrint($vals);
	
	debugPrint("Index:");
	debugPrint($index);
	
}

function isSpam($text){
global $app;
	debugLog("isSpam(" . $text . ")");
	$spamWords = array("/fuck/i","/shit/i","/cunt/i","/pussy/i","/http:/i","/ftp:/i","/https:/i","/mailto:/i","/\.com|\.edu|\.net|\.org|\.mil|\.gov|\.us|\.co\.uk|\.co\.au|\bdot com\b/i","/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i","/damn/i","/bitch/i","/bastard/i","/goddamn/i","/goddam/i","/godamn/i","/\bass.*\b/i","/nude/i","/naked/i","/milf/i","/viagra/i","/penis enlargement/i");
	foreach ( $spamWords as $v ){

		if ( @preg_match($v,$text) > 0 ){
			debugLog("preg_match(" . $v . ")=" . @preg_match($v,$text));
			return true;
		}
	}	
	return false;
}

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

function getStats(){
if ( $_COOKIE['consign_referer_host'] == "" ){

	$referer = $_SERVER['HTTP_REFERER'];
	$queryTag = "";
	$st = @strpos($referer,"//")+2;
	$en = @strpos($referer,"/",$st);
	$referer_host = @substr($referer,$st,($en-$st));

	if ( @strpos($referer_host,"google.com") !== false || @strpos($referer_host,"ask.com") !== false || @strpos($referer_host,"bing.com") !== false )
		$queryTag = "q=";
	elseif ( @strpos($referer_host,"yahoo.com") !== false )
		$queryTag = "p=";
	elseif ( @strpos($referer_host,"yellowpages.com") !== false )
		$queryTag = "search_terms=";
	elseif ( @strpos($referer_host,"lycos.com") !== false )
		$queryTag = "query=";
	elseif ( @strpos($referer_host,"mywebsearch.com") !== false )
		$queryTag = "searchfor=";

	$start = @strpos($referer,$queryTag);
	if ( $start !== false ){
		$start = $start + 2;
		$end = @strpos($referer,"&",$start);

		if ( $end === false )
			$end = strlen($referer);

		if ( $queryTag != "" )
			$kw = urldecode(substr($referer,$start,($end-$start)));
	}

	setcookie("consign_referer_host",$referer_host);
	setcookie("consign_referer_keywords",$kw);
}
	
}

function printLabels($user_id){
	global $app;
	// this function generates the PDF they will use to print their labels
	
	require_once('includes/tcpdf/config/lang/eng.php');
	require_once('includes/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Family Frenzy Sale');
$pdf->SetTitle('Sale Labels');
$pdf->SetSubject('Family Frenzy Sale Labels');

// set default header data
$SQL = "SELECT user_lname,user_fname FROM users WHERE user_id = " . $user_id;
$row = $app->db->queryrow($SQL);
$pdf->SetHeaderData("","", "Family Frenzy Sale Labels", $row['user_fname'] . " " . $row['user_lname']);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(.25,.25,.25);
$pdf->SetHeaderMargin(.5);
$pdf->SetFooterMargin(.25);

//set auto page breaks
$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 255);

// fill the page in with their data
$SQL = "SELECT * FROM items INNER JOIN categories ON categories.cat_id = items.cat_id WHERE user_id = " . $user_id . " AND sale_id = " . $app->settings->getVal('active_sale');
$results = $app->db->query($SQL);
$r = 0;
$c = 0;
while ( $row = $app->db->fetchrow($results) ){
	$posx = $pdf->pixelsToUnits(($c * 240) + 5);
	$posy = $pdf->pixelsToUnits(($r * 110) + 50);
	$txt = "\r\n";
	$txt .= $row['user_id'] . "-" . $row['item_id'] . "      ";
	$txt .= "\$" . number_format($row['item_price'],2,'.',',') . "\r\n";
	
	if ( $row['item_brand'] )
		$txt .= $row['item_brand'] . "\r\n";
	
	$txt .= $row['item_color'] . " ";
	$txt .= $row['item_description'] . "\r\n";
	

		$txt .= strtoupper($row['item_gender']) . " - ";

		$txt .= strtoupper($row['item_size']) . "\r\n";
		
	
	$pdf->MultiCell($pdf->pixelsToUnits(240),$pdf->pixelsToUnits(110),$txt,1,'C',false,1,$posx,$posy,true);
	
	if ( $row['item_halfoff'] == "1" ){
		$pdf->Circle($posx+$pdf->pixelsToUnits(228),$posy+$pdf->pixelsToUnits(100),3,0,360,"DF","",array(0,0,0));
	}
	
	$c++;
	if ( $c == 3 ){
		$c = 0;
		$r++;
	}
	
	if ( $r == 8 ){
		// add a page
		$pdf->AddPage();
		$r = 0;
		$c = 0;
	}
}
	
$pdf->Output('FamilyFrenzyLabels-' . $user_id . '.pdf', 'D');
	
}

function printInventory($user_id=""){
// this generates a PDF of their inventory for them to download
global $app;

	require_once('includes/tcpdf/config/lang/eng.php');
	require_once('includes/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Family Frenzy Sale');
$pdf->SetTitle('Inventory Sheet');
$pdf->SetSubject('Family Frenzy Inventory Sheet');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(.25,.25,.25);
$pdf->SetHeaderMargin(.5);
$pdf->SetFooterMargin(.25);

//set auto page breaks
$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 255);


$data=array();
if ( $user_id != "" )
	$SQL = "SELECT DISTINCT user_id FROM items WHERE user_id = " . $user_id;
else
	$SQL = "SELECT DISTINCT user_id FROM items ORDER BY user_id";
	
	$results = $app->db->query($SQL);
	//$pdf->AddPage();
	while ( $row = $app->db->fetchrow($results) ){
		$SQL = "SELECT user_lname,user_fname FROM users WHERE user_id = " . $row['user_id'];
			$urow = $app->db->queryrow($SQL);
			$pdf->SetHeaderData("","", "Family Frenzy Inventory Sheet", $row['user_id'] . " - " . $urow['user_fname'] . " " . $urow['user_lname']);
	
		// add a page
		$pdf->AddPage();
	
		//$data = getInventoryList($row['user_id']);
		$SQL = "SELECT * FROM items INNER JOIN categories ON categories.cat_id = items.cat_id WHERE user_id= " . $row['user_id'] . " AND sale_id = " . $app->settings->getVal('active_sale');
		$iResult = $app->db->query($SQL);
		$data = array();
		$data[] = "Item #";
		$data[] = "Category";
		$data[] = "Description";
		$data[] = "Price";
		$r = 0;
		$y = $pdf->PixelsToUnits(14);
		$page = 0;
		$totalPage = $app->db->numrows($iResult) / 40;
		while ( $iRow = $app->db->fetchrow($iResult)){
			$y = $y + $pdf->pixelsToUnits(25);
			$x = $pdf->pixelsToUnits(0);
			$h = $pdf->pixelsToUnits(25);	// never changes
			$w = $pdf->pixelsToUnits(90);			
			$pdf->MultiCell($w,$h,$iRow['user_id'] . "-" . $iRow['item_id'],1,'C',true,1,$x,$y,true,false,false,$h,'M',true);
			
			$x += $w;
			//$y += $h;
			$w = $pdf->PixelsToUnits(190);
			$pdf->MultiCell($w,$h,$iRow['cat_name'],1,'L',true,1,$x,$y,true,false,false,$h,'M',true);
			
			$x += $w;
			//$y += $h;
			$w = $pdf->PixelsToUnits(375);
			$pdf->MultiCell($w,$h,$iRow['item_color'] . " " . $iRow['item_brand'] . " " . $iRow['item_description'],1,'L',true,1,$x,$y,true,false,false,$h,'M',true);
			
			$x += $w;
			$w = $pdf->PixelsToUnits(80);
			$pdf->MultiCell($w,$h,"\$" . $iRow['item_price'],1,'R',true,1,$x,$y,true,false,false,$h,'M',true);			
			$r++;
			if ( $r == 40 ){
				$r = 0;
				$pdf->AddPage();
				$y = $pdf->PixelsToUnits(14);
				$page++;
			}
			
		}
		//$app->page->assign("data",$data);
		
		//$html = $app->page->fetch($template);
		//$pdf->writeHTML($html,false,true);
		
		//unset($data);
	}

	if ( $user_id != "" )
		$filename="InventoryList-" . $user_id . ".pdf";
	else
		$filename="MasterInventoryList.pdf";
		
	$pdf->Output($filename, 'D');

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

?>
