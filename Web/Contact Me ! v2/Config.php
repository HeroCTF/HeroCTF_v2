<?php

class Config {
	// Pour le bot
	public static $url = "http://localhost/index.php";
	public static $host = "challs.heroctf.fr";
	public static $hostBot = "localhost";
	// Pour le flag
	public static $cookieName = "PHPSESSID";
	
	public static function getCookie() {
		return session_id();
	}
	
	// Les sessions
	public static $lifetime = 600;
	public static $path = "/";
	public static $secure = false;
	public static $httponly = false;
	public static $session_path = "./sessions";
	public static $expirationUser = 5; // en minutes
	public static $expirationAdmin = 30; // en minutes
}

?>
