<?php
  function generateCaptcha(){      
    global $app;
    
    // first delete expired captchas
    $SQL = "DELETE FROM captcha WHERE captcha_expire < " . time();
    $app->db->query($SQL);
    
    if ( $app->settings->getVal('use_captcha') == "0" )
    	return false;
    
    $captchaImage = imagecreate(200,63);
    
    // allocate the background color
    imagecolorallocate($captchaImage,rand(150,255),rand(150,255),rand(150,255));
    
    srand(time());
    $backgroundcolors = array();
    $backgroundcolors["red"] = imagecolorallocate($captchaImage,rand(85,191),0,0);
    $backgroundcolors["green"] = imagecolorallocate($captchaImage,0,rand(85,191),0);
    $backgroundcolors["blue"] = imagecolorallocate($captchaImage,0,0,rand(85,191));
    $backgroundcolors["black"] = imagecolorallocate($captchaImage,0,0,0);
    
    $textcolors = array();
    $textcolors["purple"] =  imagecolorallocate($captchaImage,rand(153,208),0,rand(153,208));
    $textcolors["yellow"] =  imagecolorallocate($captchaImage,255,255,rand(0,45));
    $textcolors["orange"] =  imagecolorallocate($captchaImage,255,rand(102,145),rand(0,71));
    $textcolors["white"] = imagecolorallocate($captchaImage,255,255,255);
   
    $boxCoords = array();
    $boxCoords[0]["x"] = 2;
    $boxCoords[0]["y"] = 2;
    $boxCoords[0]["x2"] = 52;
    $boxCoords[0]["y2"] = 28;
    
    $boxCoords[1]["x"] = 60;
    $boxCoords[1]["y"] = 2;
    $boxCoords[1]["x2"] = 109;
    $boxCoords[1]["y2"] = 28;
    
    $boxCoords[2]["x"] = 118;
    $boxCoords[2]["y"] = 2;
    $boxCoords[2]["x2"] = 167;
    $boxCoords[2]["y2"] = 28;
   
   $boxes = "";
   
   $textstring = md5(time());
   
   srand(time());
   $uniqueColor = rand(0,1);
   $correct = rand(0,2);
   $abackground = randValue($backgroundcolors);
   $atextcolor = randValue($textcolors);
                //$border = randValue($borderstyle);
           // generate the boxes
       for ($i=0; $i<3; $i++){
            while ( 1 ){
                $background = randValue($backgroundcolors);
                $textcolor = randValue($textcolors);
                //$border = randValue($borderstyle);
                srand($i);
                $strLength = rand(3,5);
                $strStart = rand(1,30);                
                $textvalue = strtoupper(substr($textstring,$strStart,$strLength));
                
                if ( $uniqueColor == 0 ){
                    if ( $textcolor != $atextcolor )
                        break;
                } else {
                    if ( $background != $abackground )
                        break;
                }
            }
            
            if ( $i==$correct ){            
                $answer = $textvalue;
                $background = $abackground;
                $textcolor = $atextcolor;
                $instruction = "Enter the " . $textcolor . " text ";
                $instruction2 = "in the " . $background . " box";
            }
            // draw the boxes on the image
            imagefilledrectangle($captchaImage, $boxCoords[$i]["x"],$boxCoords[$i]["y"],$boxCoords[$i]["x2"],$boxCoords[$i]["y2"],$backgroundcolors["$background"]);
            
            imageWriteString($captchaImage,$textvalue,"8",$textcolors["$textcolor"],($boxCoords[$i]["x"] + 3),-1,true);
            //$boxes .= $textvalue . " -- ";
            //$boxes .= "<span style=\"padding: 3px; background-color: " . $backgroundcolors["$background"] . "; color: " . $textcolors["$textcolor"] . "; font-weight: bold; \">$textvalue</span>&nbsp;&nbsp;";
       }

   imageWriteString($captchaImage,$instruction,"8",$backgroundcolors["black"],3,30);
   imageWriteString($captchaImage,$instruction2,"8",$backgroundcolors["black"],3,45);
   
   //$captchaImageFile = "images/captcha/" . $textstring . ".jpg";
   ob_start();
    imagejpeg($captchaImage,'',80);
   $fileContents = ob_get_clean();
   
   $fileContents = base64_encode($fileContents);
   
   // now insert it into the database
   $SQL = "INSERT INTO captcha (captcha_answer,captcha_expire,captcha_image) values('" . $answer . "'," . ( time() + 3600 ) . ",'" . $fileContents . "')";
   $app->db->query($SQL);
   $captcha_id = $app->db->lastid();
   
   return $captcha_id;
  }
  
  function checkCaptcha($captcha_id,$answer){
      global $app;
      
      if ( $app->settings->getVal('use_captcha') == "0" )
      	return true;
      
       // this function just checks the answer against the database   
       $SQL="SELECT * FROM captcha WHERE captcha_id = $captcha_id";
       $row = $app->db->queryrow($SQL);
       if ( $row['captcha_answer'] == strtoupper($answer) )
        $retVal = true;
       else
        $retVal = false;
       
       // delete this used captcha and expired captchas from the database
       $SQL="DELETE FROM captcha WHERE captcha_id = $captcha_id OR captcha_expire < " . time();
       $app->db->query($SQL);
       
       return $retVal;             
  }
  
  function randValue($ary){
    // this pulls a random value from the given array
    $aryCount = count($ary);
    srand();
    $num = rand(0,$aryCount-1);
    $i=0;
    foreach ( $ary as $k => $v ){
        $retVal = $k;
        if ( $i == $num )
            break;
    $i++;
    }
    return $retVal;
  }

function imageWriteString($img,$string,$font_size,$color,$oxpos,$oypos=-1,$randSpacing=false){
global $backgroundcolors; 
 $len=strlen($string);

for($i=0;$i<$len;$i++){
    srand();
    if ( $randSpacing && $i>0 )
        $rand = rand(0,3);
    else
        $rand = 0;
        
    $xpos=$oxpos + (($i*imagefontwidth($font_size) - $rand ));
    if ( $oypos == -1 )
        $ypos=rand(6,12);
    else
        $ypos = rand($oypos-1,$oypos+1);
    
    
        imagechar($img,$font_size,$xpos,$ypos,$string,$color);
    
    $string = substr($string,1);   
   
}
    
    
}
?>
