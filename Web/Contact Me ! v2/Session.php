<?php
require_once('Config.php');

class Session {
	public static function initSession($admin) {
		session_save_path(Config::$session_path);
		session_set_cookie_params(
			Config::$lifetime,
            		Config::$path,
            		Config::$host,
            		Config::$secure,
            		Config::$httponly
        	);
		session_start();
        	$_SESSION['expiration'] = strtotime('now +'.Config::$expirationUser.' minutes');
			if(!isset($_SESSION['admin']) && $admin !== 0) {
				$_SESSION['admin'] = $admin;
            			$_SESSION['expiration'] = strtotime('now +'.Config::$expirationAdmin.' minutes');
        		}
		if(!isset($_SESSION['comments']))
            		$_SESSION['comments'] = [];
	}
		
	public static function getAllSessions() {
		$sessions = [];
		chdir(Config::$session_path);
		$sessionsFiles = glob('*');
		chdir('..');
		foreach($sessionsFiles as $sessionFile) {
			$sess = Session::getSession($sessionFile);
			if($sess) {
				$sessions[$sessionFile] = $sess;
			}
		}
		return $sessions;
	}
	
	public static function deleteSession($sess) {
		unlink(Config::$session_path.'/'.$sess);
	}
	
	public static function getSession($sess) {
		$sess = Config::$session_path.'/'.$sess;
		$fSess = fopen($sess, "r");
		$data = fread($fSess, filesize($sess));
		fclose($fSess);
		return Session::unserialize($data);
	}
	
    public static function unserialize($session_data) {
        $method = ini_get("session.serialize_handler");
        switch ($method) {
            case "php":
                return self::unserialize_php($session_data);
                break;
            case "php_binary":
                return self::unserialize_phpbinary($session_data);
                break;
            default:
                throw new Exception("Unsupported session.serialize_handler: " . $method . ". Supported: php, php_binary");
        }
    }

    private static function unserialize_php($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            if (!strstr(substr($session_data, $offset), "|")) {
                throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
            }
            $pos = strpos($session_data, "|", $offset);
            $num = $pos - $offset;
            $varname = substr($session_data, $offset, $num);
            $offset += $num + 1;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }

    private static function unserialize_phpbinary($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            $num = ord($session_data[$offset]);
            $offset += 1;
            $varname = substr($session_data, $offset, $num);
            $offset += $num;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }
}

?>
