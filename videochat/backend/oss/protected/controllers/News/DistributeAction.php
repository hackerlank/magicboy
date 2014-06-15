<?php
class DistributeAction extends Distribute {
	//发布的新闻条数
	const LIMIT = 10;
	const KEY = 'news';

	protected function setValConf(){
		$this->_valConf = array(
			'tb'=>'news',
			'select'=>'*',
			'order'=>'id',
			'limit'=>self::LIMIT,
		);
	}

	protected function getKey($conf){
		return self::KEY;
	}
}