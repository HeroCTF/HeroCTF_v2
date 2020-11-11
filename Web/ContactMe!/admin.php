<?php
	require_once('Session.php');
	Session::initSession(0);
	if(isset($_SESSION['admin']) && $_SESSION['admin']) echo "Hero{b3_c4r3ful_w1th_xss_!!}";
	else echo "This page is PRIVATE!";
?>
