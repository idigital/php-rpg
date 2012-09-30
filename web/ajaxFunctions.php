<?php
include("../includes/config.php");
$app = new application;
$app->settings->loadSettings();
$app->user = new user;


$_GET['module']  = str_replace(array(".","/","\\"),"",$_GET['module']);
include($appPath . "/includes/ajaxFunctions/" . $_GET['module'] . ".ajax.php");

if ( in_array($_GET['function'],$authorizedFunctions) ){
		$requestValue = call_user_func_array($_GET['function'], $_POST);
		echo $requestValue;
		exit;
}

echo "alert('ajax function not found or not authorized!');";

?>