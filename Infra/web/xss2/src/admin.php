<?php
	require_once('Session.php');
	Session::initSession(0);
	if(isset($_SESSION['admin']) && $_SESSION['admin']) echo "Hero{htmlspecialchars_m4y_b3_y0ur_fr13nd_!!}";
	else echo "This page is PRIVATE!";
?>
