<?php
	if(php_sapi_name() != "cli")
		die("Désolé le bot est assez pudique..");
	require_once('Session.php');
	require_once('Config.php');
	$sessions = Session::getAllSessions();
	Session::initSession(1);
	session_write_close();
	system("chmod -R 777 /var/www/html/sessions/");
	foreach($sessions as $key=>$session) {
		$host = Config::$hostBot;
		$url = Config::$url."?botSenpai=".$key;
		$cookieName = Config::$cookieName;
		$cookie = Config::getCookie();
		system("QT_QPA_PLATFORM=offscreen phantomjs --ignore-ssl-errors=true --local-to-remote-url-access=true --web-security=false --ssl-protocol=any bot.js $host $url $cookieName $cookie");	
		
		if(strtotime('now') >= $session['expiration'])
			Session::deleteSession($key);
	}
?>
