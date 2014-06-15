<?php
require_once (__DIR__ . '/../app.inc');

define('VIEW_DIR', __DIR__ . '/../class/view/');

class HelpController {
	public function run() {
		App::sessionStart();
		$user = array('nick'=>$_SESSION['nick'],
					  'face_id'=>$_SESSION['logo'],
					  'uid'=>$_SESSION['uid'],
					  'area'=>$_SESSION['area']);

		$this->render(array('user'=>$user));
	}

	protected function render(array $data = array()) {
		extract($data);
		require (VIEW_DIR . 'help.php');
	}
}

$h = new HelpController();
$h->run();