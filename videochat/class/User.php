<?php
class User
{
	private $uid;

	function __construct($uid){
		$this->uid = mysql_escape_string($uid);
	}

	public function getUser($input){
		$db = $this->getDB();
		$sql = "select * from user where uid='{$this->uid}'";
		$userData = $db->query_row($sql);
		if (!$userData){
			return $this->addUser($input);
		}

		//用户数据有变化，则更新
		if ($userData['level'] != $input['level']
			|| $userData['nick'] != $input['nick']
			|| $userData['area'] != $input['area']
			|| $userData['occupation'] != $input['occupation']){
			$userData['level'] = $input['level'];
			$userData['nick'] = $input['nick'];
			$userData['area'] = $input['area'];
			$userData['occupation'] = $input['occupation'];
			$userData['face_id'] = $this->getFace($input['occupation'], $input['sex']);

			$db = $this->getDB();
			$db->update('user', $userData, array('uid'=>$this->uid));
		}

		return $userData;
	}

	public function addUser($userInfo){
		$data = array(
			'uid' => $userInfo['uid'],
			'nick' => $userInfo['nick'],
			'level' => $userInfo['level'],
			'area' => $userInfo['area'],
			'occupation' => $userInfo['occupation'],
			'face_id' => $userInfo['face_id'],
			'score' => 0,
			'privilege' => 1,
		);

		$db = App::getDB();
		if (!$db->insert('user', $data)){
			//TODO error log
			return false;
		}

		//临时新增道具逻辑 有点恶心
		for ($id=1; $id<=16; $id++) {
			$prop = array(
				'uid' => $userInfo['uid'], 'prop_id' => $id, 'num' => 10
			);
			$res = $db->insert('user_prop', $prop);
			if (!$res) {
				//TODO log
			}
		}

		return $data;
	}

	/**
	 * 根据职业和性别获取头像
	 * @param string $occupation
	 * @param string $sex
	 */
	public static function getFace($occupation = '', $sex = '') {
		if (empty($occupation) || empty($sex)) {
			//默认头像 金刚男
			return 1;
		}

		$select = $occupation . $sex;
		switch ($select) {
			case '金刚男' :
				$face = 1;break;
			case '金刚女' :
				$face = 2;break;
			case '罗汉男' :
				$face = 3;break;
			case '修罗男' :
				$face = 4;break;
			case '修罗女' :
				$face = 5;break;
			case '羽士男' :
				$face = 6;break;
			case '羽士女' :
				$face = 7;break;
			case '真人男' :
				$face = 8;break;
			case '真人女' :
				$face = 9;break;
			case '尊者男' :
				$face = 10;break;
			case '尊者女' :
				$face = 11;break;
			default :
				$face = 1;break;
		}

		return $face;
	}

	public function updatePrivilege($privilege = 1){
		$db = $this->getDB();
		$sql = "select * from user where uid='{$this->uid}'";
		$data = $db->query_row($sql);
		if (!$data){
			return false;
		}
		//已有权限 不必改了
		if (intval($data['privilege']) != 0){
			return true;
		}

		return $db->update('user', array('privilege'=>$privilege), array('uid'=>$this->uid));
	}

	public function isAllowLogin(){
		// 允许登录的条件：不在登录黑名单中
		$ret = true;
		$db = $this->getDB();
		$sql = "select login from black where uid='{$this->uid}'";
		$login = $db->query_one($sql);
		if($login !== false){
			if($login == -1){ // 永久禁止登录
				$ret = false;
			}
			else{
				$ret = ($login == 0 || time() > $login);
			}
		}
		return $ret;
		/*
		// 允许登录的条件：user表记录存在，并且不在登录黑名单中
		$db = $this->getDB();
		$sql = "select count(*) from user where uid='{$this->uid}'";
		$ret = $db->query_one($sql) > 0;
		if($ret){
			$sql = "select login from black where uid='{$this->uid}'";
			$login = $db->query_one($sql);
			if($login !== false){
				if($login == -1){ // 永久禁止登录
					$ret = false;
				}
				else{
					$ret = ($login == 0 || time() > $login);
				}
			}
		}
		return $ret;
		*/
	}

	// 获取发言权限，返回：0-有权限 1-无发言权限 2-在发言黑名单中
	public function getSpeakPrivilege(){
		// 允许发言的条件：user表有发言权限，并且登录和发言都不在黑名单中
		$db = $this->getDB();
		$sql = "select count(*) from user where uid='{$this->uid}' and privilege=1";
		$ret = $db->query_one($sql) > 0 ? 0 : 1;
		if($ret == 0){
			$sql = "select speak from black where uid='{$this->uid}'";
			$row = $db->query_row($sql);
			if($row !== false){ // 黑名单中有记录
				$speak = $row['speak'];
				if($speak == -1){ // 永久禁止
					$ret = 2;
				}
				else{
					$now = time();
					if($speak != 0 && $now < $speak){
						$ret = 2;
					}
				}
			}
		}
		return $ret;
	}

	public function getInfo(){
		$db = $this->getDB();
		$sql = "select * from user where uid=?";
		$ret = $db->query_row($sql, array($this->uid));
		return $ret;
	}

	// 获取所有礼物及数量
	public function getProps(){
		$db = $this->getDB();
		$sql = "select pi.*, up.num from prop_info pi left join user_prop up on pi.id=up.prop_id and up.uid='{$this->uid}'";
		$rows = $db->query_rows($sql);
		foreach($rows as &$row){
			if($row['num'] == null){
				$row['num'] = 0;
			}
		}
		return $rows;
	}

	// 获取礼物个数
	public function getPropNum($propid){
		$db = $this->getDB();
		$sql = "select num from user_prop where uid=? and prop_id=?";
		$ret = $db->query_one($sql, array($this->uid, $propid));
		if($ret === false){
			$ret = 0;
		}
		return $ret;
	}

	// 获取礼物分值
	public function getPropScore($propid){
		$db = $this->getDB();
		$sql = "select score from prop_info where id=?";
		$ret = $db->query_one($sql, array($propid));
		if($ret === false){
			$ret = 0;
		}
		return $ret;
	}

	// 更新积分
	public function updateScore($score){
		$db = $this->getDB();
		$sql = "update user set score=score+{$score} where uid=?";
		return $db->exec($sql, array($this->uid));
	}

	// 更新礼物数量
	public function updatePropNum($propid, $count){
		$db = $this->getDB();
		$sql = "update user_prop set num=num-{$count} where prop_id=? and uid=?";
		return $db->exec($sql, array($propid, $this->uid));
	}

	// 获取当前积分
	public function getScore(){
		$db = $this->getDB();
		$sql = "select score from user where uid=?";
		$ret = $db->query_one($sql, array($this->uid));
		if($ret === false){
			$ret = 0;
		}
		return $ret;
	}

	// 禁言
	public function ban($val){
		$db = $this->getDB();
		$sql = "select count(*) from black where uid=?";
		$inBlack = $db->query_one($sql, array($this->uid)) > 0;
		if($inBlack){
			$sql = "update black set speak=? where uid=?";
			return $db->exec($sql, array($val, $this->uid));
		}
		else{
			$sql = "insert into black(uid, speak) values(?, ?)";
			return $db->exec($sql, array($this->uid, $val));
		}
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