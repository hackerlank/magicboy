<?php
class Distribute extends CAction{
	protected $_keyConf = array();
	protected $_valConf = array();

	public function run() {
		$this->setKeyConf();
		$this->setValConf();

		$key = $this->getKey($this->_keyConf);
		if (!$key){
			Yii::app()->user->setFlash('error', '未能获取key值');
			$this->display();
			return;
		}
		$val = $this->getVal($this->_valConf);
		if (!$val){
			Yii::app()->user->setFlash('error', '未能获取value值');
			$this->display();
			return;
		}
		$res = yii::app()->cache->set($key, json_encode($val));
		if (!$res) {
			Yii::app()->user->setFlash('error', '发布失败数据');
			$this->display();
			return;
		}

		Yii::app()->user->setFlash('success', '发布成功');
		$this->display();
		return;
	}

	protected function display() {
		$this->getController()->render('distribute');
	}

	/**
	 * 默认从数据库获得数据
	 * $conf支持条件:$tb, $select, $order, $limit
	 */
	protected function getVal($conf) {
		$tb = $conf['tb'];
		if (!$tb){
			return false;
		}
		$select = $conf['select'] ? $conf['select'] : '*';
		$order = $conf['order'] ? $conf['order'] : 'id';
		$limit = $conf['limit'] ? $conf['limit'] : 10;

		$command = yii::app()->db->createCommand()
			->select($select)
			->from($tb)
			->order($order)
			->limit($limit);

		return $command->queryAll();
	}

	protected function getKey($conf) {
		return false;
	}

	protected function setKeyConf(){
	}

	protected function setValConf(){
	}
}