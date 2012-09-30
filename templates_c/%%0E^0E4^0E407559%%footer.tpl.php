<?php /* Smarty version 2.6.19, created on 2011-06-13 20:46:01
         compiled from footer.tpl */ ?>
<div style="clear: both;"></div>
</div>
</div>
<div id="footer">
<a href="<?php echo $this->_tpl_vars['site_url']; ?>
/">Home</a> - <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/game">Game</a> - <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/signup">Sign Up</a> - <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/contact-us">Contact Us</a>

<?php if ($this->_tpl_vars['user']['user_admin'] == 1): ?>
 - <a href="<?php echo $this->_tpl_vars['site_url']; ?>
/admin">Admin</a>
<?php endif; ?>

</div>
</center>
<center><span style="font-size: 8pt"><a href="http://www.bremaweb.com/">Web Design</a> by Brema Web Solutions</span></center>

<!-- Woopra Code Start -->

<?php echo '
 <script type="text/javascript">

(function(){
var wsc=document.createElement(\'script\');
wsc.src=document.location.protocol+\'//static.woopra.com/js/woopra.js\';
wsc.async=true;
var ssc = document.getElementsByTagName(\'script\')[0];
ssc.parentNode.insertBefore(wsc, ssc);
})();

</script>
'; ?>


<script type="text/javascript">
<?php 
	global $app;
	if ( $app->user->loggedIn == true ){
		echo "woopraTracker.addVisitorProperty(\"name\", \"" . $app->user->data['user_cname'] . "\");\r\n";
		echo "woopraTracker.addVisitorProperty(\"email\", \"" . $app->user->data['user_email'] . "\");";		
	}
 ?>

woopraTracker.track();
</script>
<!-- Woopra Code End -->
</body>
</html>