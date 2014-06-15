<?php
/**
 * 消息盒中的消息
 * @author ballqiu
 *
 */
class Msg {
	public static function get($type = 0) {
		$type = intval($type);
		//key参看后台DistributeAction.php
		if ($type == 0){
			$key = 'message';
		}
		else if ($type == 1){
			$key = 'sysmsg';
		}

		$mem = App::getMCache();
		$data = $mem->get($key);
		if (!$data) {
			return json_encode(array());
		}

		return $data;
	}
}