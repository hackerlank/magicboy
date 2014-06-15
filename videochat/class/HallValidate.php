<?php
class HallValidate {
	protected $_error;
	protected $_validateParam;

	/**
	 * 初步合法性检验（根据cookie信息）
	 * 给$_validateParam赋值巨人侧数据
	 */
	public function validate() {
		if (!$this->paramValidate()) {
			$this->_error = '请从游戏内部启动大厅';
			return false;
		}

		if (!$this->timeValidate()) {
			$this->_error = '尚未到大厅开启时间';
			return false;
		}

		if (!$this->sumValidate()) {
			$this->_error = '请从游戏内部启动大厅';
			return false;
		}

		return true;
	}

	public function getError(){
		return $this->_error;
	}

	public function getParam(){
		return $this->_validateParam;
	}

	/**
	 * cookie参数简单检验
	 * 为$this->_validateParam赋值
	 */
	protected function paramValidate() {
		if (!(isset($_COOKIE['uid']) && isset($_COOKIE['time']) && isset($_COOKIE['sum']) && isset($_COOKIE['nick']) && isset($_COOKIE['level']) && isset($_COOKIE['area']) && isset($_COOKIE['occupation']))) {
			return false;
		}

		$this->_validateParam['uid'] = $_COOKIE['uid'];
		$this->_validateParam['nick'] = $_COOKIE['nick'];
		$this->_validateParam['level'] = intval($_COOKIE['level']);
		$this->_validateParam['area'] = $_COOKIE['area'];
		$this->_validateParam['occupation'] = $_COOKIE['occupation'];
		$this->_validateParam['time'] = $_COOKIE['time'];
		$this->_validateParam['sum'] = $_COOKIE['sum'];
		$this->_validateParam['sex'] = $_COOKIE['sex'];
		$this->_validateParam['face_id'] = User::getFace($_COOKIE['occupation'], $_COOKIE['sex']);

		return true;
	}

	/**
	 * 验证检验核 确保是从巨人客户端启动
	 */
	protected function sumValidate() {
		$uid = $this->_validateParam['uid'];
		$time = $this->_validateParam['time'];

		//cookie有效期半天
		if (time() - $time > 43200) {
			return false;
		}

		$salt = substr(strval($time), -6, 6);
		$sum = md5($salt . $uid);

		if ($sum === $this->_validateParam['sum']) {
			return true;
		}

		return false;
	}

	/**
	 * 验证当前时间是否该开启大厅
	 *
	 */
	protected function timeValidate() {
		$conf = AppConfig::get('start');
		if (isset($conf['allowAll']) && $conf['allowAll']) {
			return true;
		}

		$timeStr = date('G-w');
		list ( $hour, $day ) = explode('-', $timeStr);
		$hour = intval($hour);
		$day = intval($day);
		if ($hour >= 22 && $hour<=24){
			return true;
		}
		if ($hour >=0 && $hour<=2){
			return true;
		}

		return false;
		/*
		if (isset($conf['hour'])) {
			if (!($hour >= $conf['hour']['begin'] && $hour <= $conf['hour']['end'])) {
				return false;
			}
		}*/
		/*
		if (isset($conf['day'])) {
			if (!in_array($day, $conf['day'])) {
				return false;
			}
		}*/

		return true;
	}
}