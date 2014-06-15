<?php
class DistributeAction extends CAction {
	//发布的消息条数
	const MSG_LIMIT = 10;
	const MSG_KEY = 'message';
	const SYSMSG_KEY = 'sysmsg';

	//消息类型
	protected $_type = '';
	public function run() {
		if (!$this->getType()){
			Yii::app()->user->setFlash('error', '消息类型错误');
			$this->display();
			return;
		}

		$msg = $this->getMsg($this->_type);
		$key = $this->getKey($this->_type);
		$res = yii::app()->cache->set($key, json_encode($msg));
		if (!$res){
			Yii::app()->user->setFlash('error', '发布失败数据');
			$this->display();
			return;
		}

		Yii::app()->user->setFlash('success', '发布成功');
		$this->display();
		return;
	}

	protected function display(){
		$this->getController()->render('distribute');
	}

	/**
	 * 根据消息类型取数据库中消息
	 * @param num $type:消息类型
	 */
	protected function getMsg($type){
		$command = yii::app()->db->createCommand()
			->select('msg')
			->from('message')
			->where("type=:type", array(':type'=>$type))
			->order('time')
			->limit(self::MSG_LIMIT);

		return $command->queryAll();
	}

	/**
	 * 获取cache中相应的key
	 * @param num $type:消息类型
	 * return str/false
	 */
	protected function getKey($type){
		if ($type == 0){
			return self::MSG_KEY;
		}
		else if ($type == 1){
			return self::SYSMSG_KEY;
		}

		return false;
	}

	protected function getType(){
		$this->_type = intval($_GET['type']);
		if ($this->_type !== 0 && $this->_type !== 1){
			return false;
		}

		return true;
	}
}