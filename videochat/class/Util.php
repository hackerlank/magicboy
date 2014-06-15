<?php
class Util {
	public static function htmlencode($text) {
		return htmlspecialchars($text, ENT_QUOTES, 'utf-8');
	}

	public static function toUTF8($str) {
		if (function_exists(mb_convert_encoding)) {
			return mb_convert_encoding($str, 'UTF-8', 'GBK');
		}

		return iconv('GBK', 'UTF-8', $str);
	}

	public static function memGet($key, $decode = true){
		$mem = App::getMCache();
		$data = $mem->get($key);

		if ($decode){
			return json_decode($data, true);
		}

		return $data;
	}
}