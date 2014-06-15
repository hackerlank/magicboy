<?php
class Moderator
{
	private $uid;
	
	function __construct($uid){
		$this->uid = intval($uid);
	}
	
	public function getInfo(){
		$db = $this->getDB();
		$sql = "select * from moderator where id=?";
		$ret = $db->query_row($sql, array($this->uid));
		return $ret;
	}
	
	public function updateScore($score){
		$db = $this->getDB();
		$sql = "update moderator set score=score+{$score} where id=?";
		return $db->exec($sql, array($this->uid));
	}
	
	public function getScore(){
		$db = $this->getDB();
		$sql = "select score from moderator where id=?";
		$ret = $db->query_one($sql, array($this->uid));
		if($ret === false){
			$ret = 0;
		}
		return $ret;
	}
	
	public function updateWorkTime($start, $total){
		$db = $this->getDB();
		$sql = "insert into moderator_worktime(mid, start, total) values(?,?,?)";
		return $db->exec($sql, array($this->uid, $start, $total));
	}

	private function getDB(){
		return App::getDB();
	}

	private function log($s){
		$time = date("Y-m-d H:i:s");
		file_put_contents('c:/fms.log', "{$time}\t{$s}\r\n", FILE_APPEND);
	}	
}
?>