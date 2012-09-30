<html>
<head>
	<title>{$meta.title} - {$site_name}</title>
	<meta name="keywords" content="{$meta.keywords}">
	<meta name="description" content="{$meta.description}">
	<meta name="robots" content="{$meta.robots}">
	<base href="{$site_url}/" />
	
	{foreach $js as $scr}
		<script language="javascript" src="{$scr}"></script>
	{/foreach}
	
	<script language="javascript" src="{$site_url}/js/ajax.js"></script>
	<script language="javascript" src="{$site_url}/js/XMLObjTree.js"></script>
	<script language="javascript" src="{$site_url}/js/debug.js"></script>
	<script language="javascript" src="{$site_url}/js/tools.js"></script>
	
	<link rel="stylesheet" href="{$site_url}/css/style.css">
	<link rel="stylesheet" href="{$site_url}/css/date_style.css">
{literal}
<script type="text/javascript">
/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9774793-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/
</script>
{/literal}
</head>
<body>
<center>
<div id="top-bar">
{if $user.loggedIn == true}Welcome back {$user.user_cname}! <a href="{$site_url}/login?logout=1">Logout</a>{else}<a href="{$site_url}/login">Login / Sign-Up</a>{/if}
</div>
<div id="header">

</div>
<div id="content">
<div id="content-text">
{include file="error_msg.tpl"}