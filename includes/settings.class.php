<?php
class clsSettings{
  public $settingValues = array();
            
      function loadSettings(){
        global $app;
        $SQL="SELECT * FROM settings";
        $results = $app->db->query($SQL);
        while ( $row = $app->db->fetchrow($results) )
            $this->settingValues["{$row['setting']}"] = $row['setting_value'];
      }
        
        function getVal($sName){
            return $this->settingValues["$sName"]; 
        }
        
        function setVal($sName,$sVal){
            global $app;
            
            if ( isset($this->settingValues["$sName"]) )
            	$SQL = "UPDATE settings SET setting_value = '" . addslashes($sVal) . "' WHERE setting='$sName'";
            else
				$SQL = "INSERT INTO settings ( setting, setting_value ) values('$sName','$sVal')";
            	
            
            $results = $app->db->query($SQL);
            if ( $results ) {
                $this->settingValues["$sName"]=$sVal;
                return true;
            } else {
                return false;
            }
        }
  }
?>
