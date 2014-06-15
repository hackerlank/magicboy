<?php
require_once(__DIR__.'/../app.inc');

$db = App::getDB();

$sql = "select id,name from moderator";
$moderators = $db->query_rows($sql);

$sql = "select id,name from admin limit 10";
$admins = $db->query_rows($sql);

$sql = "select uid,nick from user limit 10";
$users = $db->query_rows($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>
<style>
.user{
	margin-bottom: 15px;
}	
</style>
</head>
<body>
	<h3>主持人</h3>
	<?php foreach($moderators as $item):?>
	<div class="user">
		<a href="mock_moderator.php?uid=<?php echo $item['id'];?>" target="_blank"><?php echo $item['name'];?></a>
	</div>
	<?php endforeach;?>

	<h3>管理员</h3>
	<?php foreach($admins as $item):?>
	<div class="user">
		<a href="mock_admin.php?uid=<?php echo $item['id'];?>" target="_blank"><?php echo $item['name'];?></a>
	</div>
	<?php endforeach;?>

	<h3>玩家</h3>
	<?php foreach($users as $item):?>
	<div class="user">
		<a href="mock_user.php?uid=<?php echo $item['uid'];?>" target="_blank"><?php echo $item['nick'];?></a>
	</div>
	<?php endforeach;?>

</body>
</html>