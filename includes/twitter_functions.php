<?php
  function updateTwitterStatus($status){
  	global $app;
  	// make sure curl is installed or just skip this function
  	if ( !function_exists("curl_init") || !function_exists("curl_setopt") || !function_exists("curl_close") || !function_exists("curl_exec") ){
		debugLog("curl fuctions not available, twitter not updated");
  		return; 
  	}
  	
        // Set username and password
        $username = $app->settings->getVal('twitter_username');
        $password = $app->settings->getVal('twitter_password');
        
        $status = urlencode(stripslashes($status));
        
        // The twitter API address
        $url = 'http://twitter.com/statuses/update.xml';
        // Alternative JSON version
        // $url = 'http://twitter.com/statuses/update.json';
        // Set up and execute the curl process
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "$url");
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "status=$status");
        curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        // check for success or failure
        if (empty($buffer)) {
			debugLog("twitter update failed");
            return false;
        } else {
        	debugLog($buffer);
			debugLog("twitter update success");
            return true;
        }
        
      
  }
function twitterSendDM($user,$message){
  	global $app;
  	// make sure curl is installed or just skip this function
  	if ( !function_exists("curl_init") || !function_exists("curl_setopt") || !function_exists("curl_close") || !function_exists("curl_exec") ){
		debugLog("curl fuctions not available, twitter not updated");
  		return; 
  	}
  	
        // Set username and password
        $username = $app->settings->getVal('twitter_username');
        $password = $app->settings->getVal('twitter_password');
        
        $message = urlencode(stripslashes($message));
        
        // The twitter API address
        $url = 'http://api.twitter.com/1/direct_messages/new.xml';
        // Alternative JSON version
        // $url = 'http://twitter.com/statuses/update.json';
        // Set up and execute the curl process
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "$url");
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "text=$message&user=$user");
        curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        // check for success or failure
        if (empty($buffer)) {
			debugLog("dm to " . $user . " failed!");
            return false;
        } else {
        	debugLog($buffer);
			debugLog("dm to " . $user . " successful!");
            return true;
        }
        
      
  }
  
  
  function getMentions(){
  	global $app;
  	
  	$username = $app->settings->getVal('twitter_username');
    $password = $app->settings->getVal('twitter_password');
    
    // The twitter API address
        $url = 'http://api.twitter.com/1/statuses/mentions.xml';
        if ( $app->settings->getVal('twitter_since_id') != "0" )
        	$url .= "?since_id="	 . $app->settings->getVal('twitter_since_id');
        	
        // Alternative JSON version
        // $url = 'http://twitter.com/statuses/update.json';
        // Set up and execute the curl process
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "$url");
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPGET, true);        
        curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        // check for success or failure
        if (empty($buffer)) {			
            return false;
        } 
        
        // parse the xml file containing mentions
        //echo $buffer;
        while ( strpos($buffer,"<text>") !== false ){
        	
        }        
  }
  
  function processDM(){
  	global $app;
  	
  	$username = $app->settings->getVal('twitter_username');
    $password = $app->settings->getVal('twitter_password');
    
    // The twitter API address
        $url = 'http://api.twitter.com/1/direct_messages.xml';
        if ( $app->settings->getVal('twitter_dm_since_id') != "0" )
        	$url .= "?since_id="	 . $app->settings->getVal('twitter_dm_since_id');
        	
        // Alternative JSON version
        // $url = 'http://twitter.com/statuses/update.json';
        // Set up and execute the curl process
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "$url");
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPGET, true);        
        curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        // check for success or failure
        if (empty($buffer)) {			
            return false;
        } 
        $startPos = 0;
        $i=0;
        /*
        while ( ($spos = strpos($buffer,"<id>",$startPos)) !== false ) {
        	$spos = strpos($buffer,"<id>",$startPos) + 4;
        	$epos = strpos($buffer,"</id>",$spos);
        	$length = $epos - $spos;
        	$id = substr($buffer,$spos,$length);

        	$tpos = strpos($buffer,"<text>",$epos) + 6;
        	$etpos = strpos($buffer,"</text>",$tpos);
        	$length = $etpos - $tpos;
        	$text = substr($buffer,$tpos,$length);

        	//echo "id: '" . $id . "'<br>";
        	//echo "text: '" . $text . "'<br>";
        	
        	$startPos = $etpos;
        	$i++;
        	
        	if ( $i >= 3 )
        		break;
        }
        */
        
        $doc = new DomDocument;
        // We need to validate our document before refering to the id
		$doc->validateOnParse = true;
		$doc->LoadXML($buffer);
        
		$dms = $doc->getElementsByTagName("direct_message");
		$highestID = 0;
		foreach ( $dms as $dm ){
			$dmIDtag = $dm->getElementsByTagName("id");
			$dmID = $dmIDtag->item(0)->nodeValue;
			echo "dmID: " . $dmID . "<br>";
			
			if ( $dmID > $highestID )
				$highestID = $dmID;
			
			$dmTexttag = $dm->getElementsByTagName("text");
			$dmText = $dmTexttag->item(0)->nodeValue;
			echo "dmText: " . $dmText . "<br>";
			
			$aryRequest['req']['pr_request'] = $dmText;
			$aryRequest['req']['pr_via'] = "Twitter DM";
			submitRequest($aryRequest,false);
			unset($aryRequest);
		}
		if ( $highestID > 0 )
			$app->settings->setVal('twitter_dm_since_id',$highestID);
		
		echo "<!--";
        echo $buffer;
        echo "-->";
  }

 function twitterSearch($query){
	global $app;
	global $highestID;
	global $addedEntries;  	
  	// The twitter API address
        $url = 'http://search.twitter.com/search.atom?lang=en&q=' . urlencode($query);
        	if ( $app->settings->getVal('twitter_search_since_id') > 0 )
        		$url .= "&since_id=" . $app->settings->getVal('twitter_search_since_id');
        
        $buffer = file_get_contents($url);
        
        // check for success or failure
        if (empty($buffer)) {			
            return false;
        } 
                
        $doc = new DomDocument;
        // We need to validate our document before refering to the id
		$doc->validateOnParse = true;
		$doc->LoadXML($buffer);
        
		$entries = $doc->getElementsByTagName("entry");
		//$highestID = 0;
		$count=0;
		
		foreach ( $entries as $entry ){
			
			if ( $count > 4 )
				break;
				
			$entryIDtag = $entry->getElementsByTagName("id");
			list($dummy,$dummy,$entryID) = explode(":",$entryIDtag->item(0)->nodeValue);
			
			
			if ( $entryID > $highestID )
				$highestID = $entryID;
			
			$entryTexttag = $entry->getElementsByTagName("content");
			$entryText = $entryTexttag->item(0)->nodeValue;
			
			$authorTag = $entry->getElementsByTagName("author");
			if ( $authorTag->item(0)->getElementsByTagName("name")->item(0)->nodeValue == "connectpray (Connect Pray Affect)" )
				continue;

			list($author,$dummy) = explode(" ",$authorTag->item(0)->getElementsByTagName("name")->item(0)->nodeValue);	
			echo "author: " . $author;
			// the @ means it's most likely a retweet so we will bypass it so we don't risk
			// a lot of duplication
			if ( strpos($entryText,"@") !== false )
				continue;

			foreach ( $addedEntries as $v ){
				//echo $entryText . "<br>" . $v . "<br>";
				if ( $v == $entryText ){
					//echo "dup!<br>";
					continue 2;
				}
			}

			echo "entryID: " . $entryID . "<br>";
			echo "entryText: " . $entryText . "<br>";
			
			
				
			if ( stripos($entryText,"serious") || stripos($entryText,"icu") || stripos($entryText,"critical") || stripos($entryText,"trauma") || stripos($entryText,"severe") ){
				$aryRequest['req']['pr_urgent'] = 1;
			} else {
				continue;	// only adding if it seem like and urgent
			}	
			$addedEntries[] = $entryText;
			$aryRequest['req']['pr_request'] = $entryText;
			$aryRequest['req']['pr_via'] = "Twitter BOT";
			list($template,$errMsg,$reqId) = submitRequest($aryRequest,false);
			unset($aryRequest);
			
			
			if ( $errMsg == "" ){
				// no error so it must have been added to the database
				$url = "http://www.connectprayaffect.com/browse.php?pr_id=$reqId&utm_source=twitter&utm_medium=mention&utm_campaign=TwitterBot";
				$shorturl = file_get_contents("http://is.gd/api.php?longurl=" . $url);
				updateTwitterStatus("@" . $author . ", We have added your prayer request to our prayer list. $shorturl");			
			}
			
			
			$count++;
		}
		
		echo "<!--";
        echo $buffer;
        echo "-->";
 	
		return count($addedEntries); 	
 }
  
?>
