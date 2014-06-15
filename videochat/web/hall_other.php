<?php
require_once (__DIR__ . '/../app.inc');
define('VIEW_DIR', __DIR__ . '/../class/view/');
class HallOtherController {
	protected $_validateRole = array(1, 2);

	public function run() {
		if (!isset($_POST['login'])) {
			$this->render();
			return false;
		}

		$validParam = $this->validate($_POST['login']);
		if (!$validParam) {
			$this->render(array('error'=>'用户名/密码错误'));
			return false;
		}

		if (!$this->identity($validParam['name'], $validParam['passwd'], $validParam['role'])){
			$this->render(array('error'=>'用户名/密码错误'));
			return false;
		}

		App::jump('room.php?rid=1');
	}

	/*
	 * 验证用户输入
	 * return:array()/false
	 */
	protected function validate($input) {
		$data = array(
			'name' => trim($input['name']),
			'passwd' => trim($input['passwd']),
			'role' => intval(trim($input['role'])),
		);

		if (empty($data['name'])
			|| empty($data['passwd'])
			|| !in_array($data['role'], $this->_validateRole)){
			return false;
		}

		return $data;
	}

	protected function render(array $data = array()) {
		extract($data);
		require (VIEW_DIR . 'hall_other.php');
	}

	/**
	 * 根据角色返回表名
	 * @param num $role
	 */
	protected function getTable($role){
		if ($role == 1){
			return 'moderator';
		}
		else if ($role == 2){
			return 'admin';
		}

		return false;
	}

	protected function identity($name, $passwd, $role){
		$table = $this->getTable($role);
		if (!$table){
			return false;
		}

		$db = App::getDB();
		$sql = "select * from {$table} where name ='{$name}'";
		$row = $db->query_row($sql);
		if (!$row){
			return false;
		}

		if ($row['passwd'] != $passwd){
			return false;
		}

		App::sessionStart();
		//moderator
		if ($role == 1){
			$_SESSION['uid'] = $row['id'];
			$_SESSION['nick'] = $row['nick'];
			$_SESSION['logo'] = $row['url'];
			$_SESSION['score'] = $row['score'];
			$_SESSION['role'] = $role;
			$_SESSION['rid'] = 1;
			//以下四个空值是为了henry哥处理用户方便
			$_SESSION['level'] = '';
			$_SESSION['area'] = '';
			$_SESSION['occupation'] = '';
			$_SESSION['sex'] = '';
		}
		//admin
		else if ($role == 2){
			$_SESSION['uid'] = $row['id'] + 10000;
			$_SESSION['logo'] = '';
			$_SESSION['score'] = 0;
			$_SESSION['role'] = $role;
			$_SESSION['rid'] = 1;
			//以下五个空值是为了henry哥处理用户方便
			$_SESSION['nick'] = $name;
			$_SESSION['level'] = '';
			$_SESSION['area'] = '';
			$_SESSION['occupation'] = '';
			$_SESSION['sex'] = '';
		}

		return true;
	}
}

$controller = new HallOtherController();
$controller->run();