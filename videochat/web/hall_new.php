<?php
require_once (__DIR__ . '/../app.inc');
define('VIEW_DIR', __DIR__ . '/../class/view/');

class HallController {
	protected $_error;
	protected $_validateParam;
	protected $_validate;

	public function __construct() {
		$this->_validate = new HallValidate();
	}

	public function run() {
		if (!$this->_validate->validate()) {
			$this->_error = $this->_validate->getError();
			$this->renderError();
			return;
		}

		$this->_validateParam = $this->_validate->getParam();

		$paihang = array(
			'user' => $this->getRank('user'),
			'moderator' => $this->getRank('moderator')
		);

		$user = new User($this->_validateParam['uid']);
		$userData = $user->getUser($this->_validateParam);
		$pageData = array(
			'user' => $userData ? $userData : $this->_validateParam,
			'paihang' => $paihang,
			'news' => Util::memGet('news'),
			//'message' => Msg::get($type=0),
			'login' => true,
			'version' => AppConfig::get('version'),
		);

		$this->assignSession($userData);
		$this->render($pageData);
	}

	protected function getRank($type = '') {
		if (!$type) {
			return false;
		}

		$key = "{$type}_rank";
		$mem = App::getMCache();
		$data = $mem->get($key);
		if (!$data) {
			return array();
		}

		return json_decode($data, true);
	}

	protected function renderError() {
		$error = $this->_error;
		require (VIEW_DIR . 'error.php');
	}

	protected function render(array $data = array()) {
		extract($data);
		require (VIEW_DIR . 'hall_new.php');
	}

	protected function assignSession($userData) {
		App::sessionStart();
		$_SESSION['uid'] = $userData['uid'];
		$_SESSION['nick'] = $userData['nick'];
		//目前只有一个房间
		$_SESSION['rid'] = 1;
		$_SESSION['role'] = 0;
		$_SESSION['score'] = $userData['score'];
		$_SESSION['logo'] = $userData['face_id'];
		$_SESSION['area'] = $userData['area'];
		$_SESSION['level'] = $userData['level'];
		$_SESSION['occupation'] = $userData['occupation'];
		//也许用不到
		$_SESSION['sex'] = $_COOKIE['sex'];
	}
}

$h = new HallController();
$h->run();
/* 主持人和admin用另一个url登录
 *
 * 从cookie中读信息验正确啥的（细化下）
 * 查数据库是否有该用户信息，没有插入，有就更新
 * 种session(整理下henry的需要)
 * 如果不在合理时间弹提示
 *
*/
