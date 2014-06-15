<?php
class App
{
	// 数据库
	public static function getDB($conf='db'){
		$key = "PDODB.{$conf}";
		$obj = self::get($key);
		if($obj === false){
			$data = AppConfig::get($conf);
			$obj = new PDODB();
			$obj->connect($data);

			self::set($key, $obj);
		}
		return $obj;
	}

	// Memcache
	public static function getMCache($conf='mcache'){
		$key = "MCache.{$conf}";
		$obj = self::get($key);
		if($obj === false){
			$data = AppConfig::get($conf);
			$obj = new Memcache();
			$obj->connect($data['memcache']['host'], $data['memcache']['port']);

			self::set($key, $obj);
		}
		return $obj;
	}

	///////////////////

	private static $caches = array();

	public static function get($key, $defVal=false){
		return isset(self::$caches[$key]) ? self::$caches[$key] : $defVal;
	}

	public static function gets(){
		return self::$caches;
	}

	public static function set($key, $val){
		self::$caches[$key] = $val;
	}

	//获取类实例，如果不存在，则自动创建
	public static function getInstance($className, $key=''){
		if($key == '') $key = $className;
		$obj = self::get($key);
		if($obj === false){
			$obj = new $className;
			self::set($key, $obj);
		}
		return $obj;
	}

	public static function isExists($key){
		return isset(self::$caches[$key]);
	}

	public static function sessionStart(){
		$key = 'app.session_start';
		if(self::get($key, false) === false){
			session_start();
			self::set($key, true);
		}
	}

	/**
	 * 获取用户ip
	 */
    public static function getClientIP() {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = false;
        }
        $ip = explode(",", $ip, 2);
        $ip = trim($ip[0]);
        return $ip;
    }

    /**
     * 页面跳转
     * @param str $url
     */
    public static function jump($url){
		header("Location: {$url}");
		exit;
    }
}
?>