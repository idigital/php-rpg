<?php

include("../includes/config.php");

getStats();

  $app = new application;
  $app->settings->loadSettings();

/*
if ( $_GET['redir_ad'] ){
	$SQL = "SELECT * FROM ads WHERE ad_id = " . $_GET['redir_ad'];
	$row = $app->db->queryrow($SQL);
	
	$row['ad_clicks']++;
	$app->db->updateRow("ads",$app->db->getTableCols("ads"),$row,"ad_id",$row['ad_id']);
	
	header("location: " . $row['ad_link']);
	return;
}
*/

  $app->user = new user;
  
  $requestURI = $_SERVER['REQUEST_URI'];
  $requestURI = rtrim($requestURI,'/');
  
  debugLog("Original URI: " . $requestURI);
  $parpos = strpos($requestURI,"?");
  if (  $parpos !== false ){
	// strip the parameters off the end of the requesturi
	debugLog("parpos: " . $parpos);
	$requestURI = substr($requestURI,0,$parpos);
  }
  
  debugLog("Mod URI: " . $requestURI);
  
if ( $requestURI != "/" && $requestURI != "/index.php" && $requestURI != "" ){

	// selecting a custom page
	$aryPage = explode("/",$requestURI);	
	debugLog($aryPage);
	$template = "";
	$i=0;
	$pageArgs = array();
	foreach ( $aryPage as $k => $v ){

		if ( $v != "" && $k < 3 )
			$template .= $v . "-";
		//$i++;
		//if ( $i == 3 )
		//	break;
		
		if ( $k >= 3 )
			$pageArgs[] = $v;
	}

	$template = rtrim($template,"-");
	
	if ( file_exists($appPath . "/includes/classes/" . $aryPage[1] . ".class.php") && file_exists($app->settings->getVal('template_dir') . "/" . $template . ".tpl") ){
		debugLog($aryPage[1] . ".class.php");
		include($appPath . "/includes/classes/" . $aryPage[1] . ".class.php");
	} elseif ( file_exists($app->settings->getVal('template_dir') . "/" . $template . ".tpl") ) {
		include($appPath . "/includes/classes/index.class.php");
		errorLog("missing class for " . $aryPage[1] . " using index.class.php");
	} else { 
		errorLog("missing class and template for " . $aryPage[1]);
		header("HTTP/1.0 404 Not Found");
		header("location: " . $app->settings->getVal('site_url') . "/404");
		return;
	}
		
} else {

	// just serve the default

	include($appPath . "/includes/classes/index.class.php");
	$template = "index";

}

debugLog("Template: " . $template);
debugLog("Page Args: ");
debugLog($pageArgs);

$app->page = new clsPage;

// set the template path based on settings
if ( !file_exists($app->settings->getVal('template_dir')) )
	mkdir($app->settings->getVal('template_dir'));

if ( !file_exists($app->settings->getVal('template_dir') . "_c") )
	mkdir($app->settings->getVal('template_dir') . "_c");

$app->page->template_dir = $app->settings->getVal('template_dir');
$app->page->compile_dir = $app->settings->getVal('template_dir') . "_c";

$app->page->assign('sec_url',$app->settings->getVal('sec_url'));
$app->page->assign('site_url',$app->settings->getVal('site_url'));
$app->page->assign("site_name",$app->settings->getVal('site_name'));
$app->page->assign("user",$app->user->data);
$app->page->assign("image_url",$app->settings->getVal('image_url'));
$app->page->assign("avatar_url",$app->settings->getVal('avatar_url'));
$app->page->assign("template_url","http://" . $_SERVER['HTTP_HOST'] . "/" . $app->settings->getVal('template_dir'));

$app->page->assign("pageArgs",$pageArgs);

$app->page->renderPage($template,$pageArgs);

debugLog(headers_list());

?>
