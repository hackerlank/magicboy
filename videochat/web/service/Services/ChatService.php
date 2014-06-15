<?php
// 最大用户数
class ChatService
{
	public function hello($name){
		return $name . ", hello world";
	}
	
	private function getDB(){
		return App::getDB();
	}
	
	private function log($s){
		$time = date("Y-m-d H:i:s");
		file_put_contents('c:/fms.log', "{$time}\t{$s}\r\n", FILE_APPEND);
	}
	
	// 获取session里的用户信息
	public function getUserInfo($sid){
		session_id($sid);
		session_start();
		$ret = new StdClass;
		$ret->valid = true;
		$paramNames = array('uid', 'nick', 'role', 'logo', 'area', 'level', 'sex', 'occupation');
		foreach($paramNames as $paramName){
			if(!isset($_SESSION[$paramName])){
				$ret->valid = false;
				break;
			}
			$ret->$paramName = $_SESSION[$paramName];
		}
		$ret->maxUserCount = FMS_MAX_USER_COUNT;
		$ret->bd = 500000;
		
		// 实时读取score
		if($ret->valid){
			if($ret->role == 0){
				$user = new User($ret->uid);
				$ret->score = $user->getScore();
			}
			elseif($ret->role == 1){
				$user = new Moderator($ret->uid);
				$ret->score = $user->getScore();
			}
			else{
				$ret->score = 0;
			}
		}
		
		return $ret;
	}
	
	// 登录：黑名单验证
	// info => rid vid uid nick logo score
	public function login($info){
		/*
		// 验证用户
		$info = $this->getUserInfo($sid);
		if(!$info->valid){
			$ret = new StdClass;
			$ret->allow = false;
			$ret->msg = '';
			return $ret;
		}
		*/
		$ret = new StdClass;
		if($info->role == 0){ // 普通用户登录
			$user = new User($info->uid);
			$ret->allow = $user->isAllowLogin();
			if($ret->allow){
				$ret->msg = $this->getUserLoginHint($info);
			}
		}
		else{ // 主持人和管理员登录
			$ret->allow = true;
			$ret->msg = '';
		}
		return $ret;
	}
	
	// 登录提示消息
	private function getUserLoginHint($info){
		// 坐骑
		$horses = array('奔驰', '宝马', '布加迪', '法拉利', '劳斯莱斯', '宾利', '保时捷');
		$nick = $info->nick;
		$inx = array_rand($horses);
		$ret = $nick . "开着{$horses[$inx]}来了";
		return $ret;
	}
	
	// 发送消息
	public function sendMsg($sid, $msg, $to, $tonick, $torole, $tologo, $font, $color, $size){
		// 验证用户
		$info = $this->getUserInfo($sid);
		if(!$info->valid){
			$ret = new StdClass;
			$ret->speak = 1;
			$ret->msg = '您没有发言权限';
			return $ret;
		}

		$user = new User($info->uid);
		$ret = new StdClass;
		if($info->role != 0){ // 主持人和管理员，不验证发言权限
			$ret->speak = 0;
		}
		else{
			$ret->speak = $user->getSpeakPrivilege();
		}
		$s = '';
		if($ret->speak === 0){
			$biaoqing = AppConfig::get('biaoqing');
			$biaoqingNames = array_keys($biaoqing);
			$biaoqingPics = array_values($biaoqing);
			$msg = strip_tags($msg);
			$msg = str_replace(
				$biaoqingNames,
				$biaoqingPics,
				$msg);
			$msg = "<span style=\"font-family:{$font};color:{$color};font-size:{$size}px\">{$msg}</span>";
			
			if($to == ''){
				$s = $this->getChatWithLink($info->uid, $info->nick, $info->role, $info->logo) . ' 说: ' . $msg;
			}
			else{
				$s = $this->getChatWithLink($info->uid, $info->nick, $info->role, $info->logo) . '对' . $this->getChatWithLink($to, $tonick, $torole, $tologo) . ' 说：' . $msg;
			}
		}
		elseif($ret->speak == 1){
			$s = '您没有发言权限';
		}
		elseif($ret->speak == 2){
			$s = '您已被禁言';
		}
		$ret->msg = $s;
		return $ret;
	}
	
	// 生成chatWith链接
	private function getChatWithLink($uid, $nick, $role, $logo){
		$nick = htmlspecialchars($nick);
		$pic = $this->getFaceImage($role, $logo);
		return "<a href=\"###\" class=\"name\" onclick=\"chatWith('{$uid}',{$role});\"><img src=\"{$pic}\" alt=\"\" class=\"face\" />[{$nick}]</a>";
	}
	
	// 获取道具及数量
	public function getProps($sid){
		// 验证用户
		$info = $this->getUserInfo($sid);
		if(!$info->valid){
			return array();
		}

		$user = new User($info->uid);
		return $user->getProps();
	}
	
	// 赠送礼物
	public function sendGift($sid, $propid, $sendCount, $to, $tonick, $torole, $tologo, $propName){
		// 验证用户
		$info = $this->getUserInfo($sid);
		if(!$info->valid || $info->uid == $to){ // 也不允许自己送给自己
			$ret = new StdClass;
			$ret->allow = false;
			$ret->content = '错误数据';
			return $ret;
		}

		$ret = new StdClass;
		$ret->allow = false;
		$ret->sendCount = 0;
		
		// 无效数据检测，避免作弊
		if($sendCount <= 0){
			$ret->content = '错误数据';
			return $ret;
		}
		
		$user = new User($info->uid);
		$ownCount = $user->getPropNum($propid);
		
		if($ownCount == 0){
			$ret->content = "您已经没有【{$propName}】了，赠送失败！";
		}
		elseif($ownCount < $sendCount){
			$ret->content = "您只有{$ownCount}个【{$propName}】，不够{$sendCount}个，请重新选择赠送数量。";
		}
		else{
			// 赠送礼物
			$moderator = new Moderator($to);
			$propScore = $user->getPropScore($propid);
			$score = intval($propScore * $sendCount);
			$moderator->updateScore($score);
			$user->updateScore($score);
			$user->updatePropNum($propid, $sendCount);

			$ret->content = $this->getChatWithLink($info->uid, $info->nick, $info->role, $info->logo) . '送给' . $this->getChatWithLink($to, $tonick, $torole, $tologo) . " %sendCount%个<img src=\"" . $this->getPropImageSrc($propid) . "\" alt=\"\" style=\"width:30px\">";
			$ret->allow = true;
			$ret->from = $info->uid;
			$ret->to = $to;
			$ret->propid = $propid;
			$ret->sendCount = $sendCount;
			$ret->ownCount = $ownCount - $sendCount;
			// 获取新分数
			$ret->toscore = $moderator->getScore();
			$ret->myscore = $user->getScore();
		}
		return $ret;
	}
	
	public function getPropImageSrc($id){
		return AppConfig::get('imgBase') . "propinfo/{$id}.gif";
	}
	
	public function getFaceImage($role, $logo){
		$ret = '';
		if($role == 0){
			if(empty($logo)){
				$logo = 1;
			}
			$ret = "images/face/" . $logo . ".jpg";
		}
		elseif($role == 1){
			$ret = "images/face/moderator.jpg";
		}
		else{
			$ret = "images/face/admin.jpg";
		}
		return $ret;
	}
	
	public function updateWorkTime($sid, $start, $total){
		// 验证用户
		$info = $this->getUserInfo($sid);
		if(!$info->valid){
			return;
		}
		if($info->role != 1) return;

		$moderator = new Moderator(intval($info->uid));
		$moderator->updateWorkTime($start, $total);
	}

	// 禁言
	public function ban($sid, $banid, $bannick){
		$ret = new StdClass;
		$ret->ret = false;
		// 验证用户
		$info = $this->getUserInfo($sid);
		if(!$info->valid){
			return $ret;
		}
		if($info->role == 0) return $ret;
		
		$user = new User($banid);
		$user->ban(time() + 60 * 30); // 禁言30分钟
		$ret->ret = true;
		return $ret;
	}
	
	// 获取伪装登录的用户
	public function getMockUsers($count=218){
		//return array();
		$db = $this->getDB();
		$start = 0; //rand(0, 50);
		$sql = "select * from user limit $start,$count";
		$arr = $db->query_rows($sql);
		$keys = array_rand($arr, count($arr));
		if($arr === false){
			$ret = array();
		}
		else{
			$ret = array();
			foreach($keys as $key){
				$ret[] = $arr[$key];
			}
		}
		return $ret;
	}
}
?>