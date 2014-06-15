<?php
/*
 *处理用户输入卡号的请求
 *$_GET['seq'] ：卡号
 *$_GET['t'] : 卡类型
 */
require_once (__DIR__ . '/../app.inc');
class Card{
	const NO_ERROR = 0;
	const TYPE_ERROR = 1;
	const VALIDATE_ERROR = 2;
	const DB_ERROR = 3;
	const FAKE_ERROR = 4;//伪造卡号
	const COOKIE_ERROR = 5;
	const USED_ERROR = 6;//卡已使用过
	const USER_ERROR =7;//未建档却使用了卡片
	const SESSION_ERROR = 8;//session里省少相应值
	const CARDID_ERROR = 8;

	protected $_response = array('response'=>'请输入正确的生龙活虎或活色生香卡卡号');

	public function run(){
		$cardValidate = new CardNum();
		$seq = trim($_GET['seq']);
		$type = trim($_GET['t']);
		if ($seq[0] != $type){
			$this->_response['err'] = self::TYPE_ERROR;
			$this->render($this->_response);
			return false;
		}

		$res = $cardValidate->validate($seq);
		if (!$res){
			$this->_response['err'] = self::VALIDATE_ERROR;
			$this->render($this->_response);
			return;
		}

		if ($type == 1){
			$this->card1($seq, $type);
			return;
		}
		else if ($type == 2){
			$this->card2($seq);
			return;
		}
		else if ($type == 3){
			$this->card3($seq);
			return;
		}

		$this->render($this->_response);
	}

	/**
	 * 处理活色声香卡
	 */
	protected function card1($seq, $type){
		$db = App::getDB();
		if (!$db){
			$this->_response['err'] = self::DB_ERROR;
			$this->_response['response'] = '系统忙,请稍后再试';
			$this->render($this->_response);
			return false;
		}

		$sql = "select count(*) from card_1 where seq='{$seq}'";
		$num = $db->query_one($sql);
		if ($num == 0){
			$this->_response['err'] = self::FAKE_ERROR;
			$this->render($this->_response);
			return false;
		}

		//添加新用户
		$v = new HallValidate();
		if (!$v->validate()){
			$this->_response['err'] = self::COOKIE_ERROR;
			$this->render($this->_response);
			return false;
		}

		$userInfo = $v->getParam();
		unset($userInfo['time']);
		unset($userInfo['sum']);
		unset($userInfo['sex']);
		if (!$db->insert('user', $userInfo)){
			$this->_response['err'] = self::DB_ERROR;
			$this->_response['response'] = '系统忙,请稍后再试';
			$this->render($this->_response);
			return false;
		}

		$this->_response['err'] = self::NO_ERROR;
		$this->_response['url'] = '/hall.php';
		$this->_response['response'] = '成功';
		$this->render($this->_response);
		return true;
	}

	protected function card2($seq){
		App::sessionStart();
		$uid = $_SESSION['uid'];
		if (!$uid){
			$this->_response['err'] = self::SESSION_ERROR;
			$this->render($this->_response);
			return false;
		}

		$db = App::getDB();
		if (!$db){
			$this->_response['err'] = self::DB_ERROR;
			$this->_response['response'] = '系统忙,请稍后再试';
			$this->render($this->_response);
			return false;
		}

		$sql = "select * from card_2 where seq='{$seq}'";
		$data = $db->query_row($sql);
		if (!$data){
			$this->_response['err'] = self::FAKE_ERROR;
			$this->render($this->_response);
			return false;
		}

		if (intval($data['uid']) != 0){
			$this->_response['err'] = self::USED_ERROR;
			$this->_response['response'] = '该卡已使用过';
			$this->render($this->_response);
			return false;
		}

		$user = new User($uid);
		$res = $user->updatePrivilege();
		if (!$res){
			$this->_response['err'] = self::USER_ERROR;
			$this->render($this->_response);
			return false;
		}

		//给用户加道具
		$this->addProp(2, $uid);
		//标记卡为已用
		$db->update('card_2',
			array('uid'=>$uid, 'ip'=>App::getClientIP(), 'time'=>date('Y-m-d H:i:s')),
			array('seq'=>$seq));

		$this->_response['err'] = self::NO_ERROR;
		$this->_response['response'] = '恭喜您成功获得活色生香卡礼包';
		$this->render($this->_response);

		return true;
	}

	//其实和card2逻辑基本一样 有空合提成一个函数
	protected function card3($seq){
		App::sessionStart();
		$uid = $_SESSION['uid'];
		if (!$uid){
			$this->_response['err'] = self::SESSION_ERROR;
			$this->render($this->_response);
			return false;
		}

		$db = App::getDB();
		if (!$db){
			$this->_response['err'] = self::DB_ERROR;
			$this->_response['response'] = '系统忙,请稍后再试';
			$this->render($this->_response);
			return false;
		}

		$sql = "select * from card_3 where seq='{$seq}'";
		$data = $db->query_row($sql);
		if (!$data){
			$this->_response['err'] = self::FAKE_ERROR;
			$this->render($this->_response);
			return false;
		}

		if (intval($data['uid']) != 0){
			$this->_response['err'] = self::USED_ERROR;
			$this->_response['response'] = '该卡已使用过';
			$this->render($this->_response);
			return false;
		}

		$user = new User($uid);
		$res = $user->updatePrivilege();
		if (!$res){
			$this->_response['err'] = self::USER_ERROR;
			$this->render($this->_response);
			return false;
		}

		//给用户加道具
		$this->addProp(3, $uid);
		//标记卡为已用
		$db->update('card_3',
			array('uid'=>$uid, 'ip'=>App::getClientIP(), 'prop_time'=>date('Y-m-d H:i:s')),
			array('seq'=>$seq));

		$this->_response['err'] = self::NO_ERROR;
		$this->_response['response'] = '恭喜您成功获得生龙活虎卡礼包';
		$this->render($this->_response);

		return true;
	}

	/**
	 * 根据卡号给uid加道具
	 * @param num $cardNum
	 * @param  num $uid
	 * return true/false
	 */
	protected function addProp($cardId = 0, $uid = 0){
		$tb = 'card_info';
		$sql = "select prop_list from {$tb} where id = {$cardId}";
		$db = App::getDB();
		if (!$db){
			$this->_response['err'] = self::DB_ERROR;
			$this->_response['response'] = '系统忙,请稍后再试';
			$this->render($this->_response);
			return false;
		}

		//取卡片信息
		$propList = $db->query_row($sql);
		if (!$propList){
			$this->_response['err'] = self::CARDID_ERROR;
			$this->render($this->_response);
			return false;
		}

		$info = $this->propList2Array($propList['prop_list']);
		$tb = 'user_prop';
		//查已有道具
		$sql = "select prop_id, num from $tb where uid = {$uid}";
		$userProp = $db->query_rows($sql);
		//加已有道具
		foreach ($userProp as $item) {
			$propId = $item['prop_id'];
			if (!isset($info[$propId])){
				continue;
			}
			//这样加其实不是特别安全
			$data = array(
						'time'=>date('Y-m-d H:i:s'),
						'num'=>$item['num'] + $info[$propId]['num']
					);
			$where = array('uid'=>$uid, 'prop_id'=>$propId);
			$res = $db->update($tb, $data, $where);
			if (!$res){
				//TODO log
			}
			unset($info[$propId]);
		}

		//新增道具
		foreach ($info as $left) {
			$data = array(
				'uid' => $uid, 'prop_id' => $left['id'], 'num' => $left['num']
			);
			$res = $db->insert($tb, $data);
			if (!$res) {
				//TODO log
			}
		}

		return true;
	}

	/**
	 * 字串形式的道具列表转换为数据
	 * @param string $propList
	 * return array()/false
	 */
	protected function propList2Array($propList = ''){
		if (empty($propList)){
			return array();
		}

		$tmp = explode(";", $propList);
		if (empty($tmp)){
			return array();
		}

		$result = array();
		foreach ($tmp as $item){
			if (empty($item)){
				continue;
			}
			list($id, $num) = explode("-", $item);
			if (empty($id) || empty($num)){
				continue;
			}
			$result[$id] = array('id'=>$id, 'num'=>$num);
		}

		return $result;
	}

	protected function render($data){
		echo json_encode($data);
	}

}

$controller = new Card();
$controller->run();

/*
$response = array(
	'response' => '进入聊天室',
	'result' => false,
	'url' => 'room.php',
);
echo json_encode($response);
*/

