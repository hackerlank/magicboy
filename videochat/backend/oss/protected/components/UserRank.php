<?php
class UserRank {
	protected $_db;
	//文件保存地址
	//protected $_file = '';
	CONST KEY = 'user_rank';
	//排序人数
	protected $_limit = 10;
	public function __construct($file = null) {
		$this->_db = new User();
	}

	public function gen() {
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->order = "score desc";
		$criteria->limit = "10";

		$res = $this->_db->findAll($criteria);
		$num = count($res);

		$data = array();
		for($i = 0; $i < $num; $i++) {
			$data[] = $res[$i]->attributes;
		}

		return yii::app()->cache->set(self::KEY, json_encode($data));
	}

	public function get() {
		$res = yii::app()->cache->get(self::KEY);
		if (empty($res)) {
			return false;
		}

		return json_decode($res, true);
	}
}