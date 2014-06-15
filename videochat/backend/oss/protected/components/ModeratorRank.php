<?php
/*
 * 主持人排行榜静态化 
 */
class ModeratorRank {
	protected $_db;
	//文件保存地址
	//protected $_file = '';
	
	CONST KEY = 'moderator_rank';
	//排序人数
	protected $_limit = 10;
	public function __construct($file=null) {
		$this->_db = new Moderator();
	}
	
	public function gen(){
		$criteria = new CDbCriteria();
		$criteria->select = 'id,name,nick,score,url';
		$criteria->order = "score desc";
		$criteria->limit = "10";
		
		$res = $this->_db->findAll($criteria);
		$num = count($res);
		
		$data = array();
		for ($i=0; $i<$num; $i++){
			$data[] = array(
				'name' => $res[$i]['name'],
				'nick' => $res[$i]['nick'],
				'score' => $res[$i]['score'],
				'url' => $res[$i]['url']?yii::app()->params['imgurl'].$res[$i]['url']:$res[$i]['url'],
			);
		}
		
		return yii::app()->cache->set(self::KEY, json_encode($data));
	}
	
	public function get(){
		$res = yii::app()->cache->get(self::KEY);
		if (empty($res)){
			return false;
		}
		
		return json_decode($res);
	}
	
	
}