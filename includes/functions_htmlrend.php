<?php

function selectBox($selName, $options, $selected="", $attributes=""){

debugLog($selected);
$retVal = "<select name=\"$selName\" id=\"$selName\" ";

	if ( is_array($attributes) ){
		foreach ( $attributes as $key => $v ){
			$retVal .= $key	. "=\"$v\" ";
		}
	}

$retVal .= ">\r\n";

 	if ( is_array($options) ){
 		foreach ($options as $key => $v){
 			if ( is_array($selected) ){
				if ( in_array($key,$selected) )
					$sel = " SELECTED";
				else
					$sel = "";
			} else {
 				if ( $key == $selected )
 					$sel = " SELECTED";
 				else
 					$sel = "";
			}

 			$retVal .= "<option value=\"$key\"$sel>$v</option>\r\n";
 		}
 	}

$retVal .= "</select>\r\n";

return $retVal;

}

  function select_country($selName,$selected=""){
  global $countries;
     $retVal = "<select name=\"$selName\">\r\n";
     foreach ( $countries as $k=>$v ){
         if ( $k == $selected )
            $sel = "selected";
         else
            $sel = "";            
         $retVal .= "<option value=\"$k\" $sel>" . $v . "</option>";
     }
     $retVal .= "</select>";
     
     return $retVal;
  }
  
  function select_listtype($selName,$selected=""){
	$options = array("1"=>"Global","2"=>"Local","3"=>"Exclusive");
	return selectBox($selName,$options,$selected);
  }

  
  function tableToSelect($selName,$selected,$table,$valueField,$textField,$orderBy="",$condition="",$attributes=""){
	global $app;
	$options = array();
	$SQL = "SELECT $valueField, $textField FROM $table";
	
	if ( $condition )
		$SQL .= " WHERE $condition ";
	
	if ( $orderBy )
		$SQL .= " ORDER BY " . $orderBy;
		
	debugLog($SQL);
		
	$results = $app->db->query($SQL);
	while ( $row = $app->db->fetchrow($results) ){
		$options["{$row["$valueField"]}"] = $row["$textField"];
	}
	debugLog($options);
	return selectBox($selName,$options,$selected,$attributes);
	
  }
?>
