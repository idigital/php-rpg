<?php

class dbClass{

    var $dbconn = "";
    var $result = "";
    
    function __construct($dbHost,$dbPort,$dbDatabase,$dbUser,$dbPassword){
        $this->dbconn=mysql_pconnect($dbHost,$dbUser,$dbPassword);
        mysql_select_db($dbDatabase);
    }

    function query($SQL, $displayErrors = true){
    	global $app;
        $this->result = @mysql_query($SQL, $this->dbconn);
        
        /*if ($displayErrors && !$this->result){
            echo "SQL Error: " . mysql_error() . "<br><br>" . $SQL . "<br><br>";
        }*/
		if ( !$this->result ){
			$errFile = fopen($app->path . "/logs/error_" . date("m-d-Y") . ".txt","a+");
				fwrite($errFile,"SQL Error: " . mysql_error() . "<br><br>" . $SQL . "<br><br>");
			fclose($errFile);
		}
        
        return $this->result;
    }

    function queryrow($SQL, $displayErrors = true){
        // queryrow does the query and just returns one row
        $result = $this->query($SQL, $displayErrors);
            if ($result){
                return $this->fetchrow($result);
                @mysql_free_result($result);
            }else{
                return false;
            }        
    }

    function fetchrow($result = 0){
        
        if (!$result)
            $result = $this->result;
                    
        $row = @mysql_fetch_assoc($result);
        return $row;
    }

    function lastid($result = 0){
        if (!$result)
            $result = $this->result;
    
        return mysql_insert_id();
    }

    function numrows($result=0){
        if (!$result)
            $result = $this->result;
            
        return @mysql_num_rows($result);
    }
	
	function affectedrows(){
        
        return @mysql_affected_rows();
    }

    function __destructor(){
        mysql_close($this->dbconn);
    }
    
    function insertRow($table, $columns, $values){
    	debugLog("insertRow();");
    	debugLog($table);
    	debugLog($columns);
    	debugLog($values);
        $SQL = "INSERT INTO $table (";
        $SQLv = "";
        foreach ( $values as $k => $v ){
            if ( in_array($k,$columns) ){
                $SQLv .= "'" . addslashes($v) . "',";            
                $SQL .= "$k,";
            }
        }
        $SQL = substr($SQL,0,strlen($SQL)-1);
        $SQLv = substr($SQLv,0,strlen($SQLv)-1);
        
        $SQL .= ") values(" . $SQLv . ")";
            
        $SQL = substr($SQL,0,strlen($SQL)-1);
        
        $SQL .= ")";
        
        debugLog($SQL);
        
        $results = $this->query($SQL);
        if ( $results )
            return $this->lastid();
        else
            return false;
    }
    
    function updateRow($table,$columns,$values,$key,$keyValue){
		debugLog("updateRow();");
    	debugLog($table);
    	debugLog($columns);
    	debugLog($values);
		debugLog($key);
		debugLog($keyValue);
    	$SQL = "UPDATE $table SET";
        $SQLv = "";
        foreach ( $values as $k => $v ){
            if ( in_array($k,$columns) ){
                //$SQLv .= "'" . addslashes($v) . "',";            
                $SQL .= " $k = \"" . addslashes($v) . "\", ";
            }
        }
        $SQL = substr($SQL,0,strlen($SQL)-1);
        //$SQLv = substr($SQLv,0,strlen($SQLv)-1);
        
        //$SQL .= ") values(" . $SQLv . ")";
            
        $SQL = substr($SQL,0,strlen($SQL)-1);
        
        $SQL .= " WHERE $key = '" . addslashes($keyValue) . "'";
		
		debugLog($SQL);
        $results = $this->query($SQL);
        if ( $results )
            return $this->lastid();
        else
            return false;
    }
	
	function getTableCols($table){
		$retVal = array();
		$SQL = "SHOW FIELDS FROM $table";
		$results = $this->query($SQL);
		while ( $row = $this->fetchrow($results) ){
			$retVal[] = $row['Field'];
		}
		
		return $retVal;
	}
}

?>