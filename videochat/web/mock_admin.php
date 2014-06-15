<?php
require_once(__DIR__.'/../app.inc');
require_once(__DIR__.'/../app.inc');
if (!AppConfig::get('debug')){
	return;
}
$uid = $_GET['uid'];
session_start();
$db = App::getDB();
$sql = "select * from admin where id=".intval($uid);
$info = $db->query_row($sql);
$_SESSION['uid'] = (string)$info['id'];
$_SESSION['nick'] = $info['name'];
$_SESSION['role'] = 2;
$_SESSION['logo'] = '';
$_SESSION['score'] = 0;
$_SESSION['area'] = '';
$_SESSION['level'] = '';
$_SESSION['sex'] = '';
$_SESSION['occupation'] = '';

$items = array('uid', 'nick', 'role', 'logo', 'score');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员</title>
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