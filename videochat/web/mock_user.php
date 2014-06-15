<?php
require_once(__DIR__.'/../app.inc');
require_once(__DIR__.'/../app.inc');
if (!AppConfig::get('debug')){
	return;
}
$uid = $_GET['uid'];
session_start();
$user = new User($uid);
$info = $user->getInfo();
$_SESSION['uid'] = $info['uid'];
$_SESSION['nick'] = $info['nick'];
$_SESSION['role'] = 0;
$_SESSION['logo'] = $info['face_id'];
$_SESSION['score'] = $info['score'];
$_SESSION['area'] = $info['area'];
$_SESSION['level'] = $info['level'];
$_SESSION['sex'] = '男';
$_SESSION['occupation'] = $info['occupation'];

$items = array('uid', 'nick', 'role', 'logo', 'score');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>玩家</title>
<style>
.user{
	margin-bottom: 15px;
}
</style>
</head>
<body>
	<div>
		<?php foreach($items as $item):?>
		<div><?php echo $item;?>: <?php echo $_SESSION[$item];?></div>
		<?php endforeach;?>
	</div>
	<a href="room.php?rid=1">Enter Room1</a>
</body>
</html>