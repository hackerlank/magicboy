<?php
/*模拟巨人种的cookie*/

/*
用户id（uid）
用户昵称（nick）
用户等级（level）
用户大区（area）
用户职业（occupation）--方便咱们自己配头像时用
用记性别（sex）
启动时的时间戳（time）
检验值（sum）
Sum算法：时间戳后6位+用户id做md5
比如时间戳为1349939898，用户id为abcabc，则
Sum = md5(939898abcabc);
Cookie直接种到根域下。
*/
require_once(__DIR__.'/../app.inc');
if (!AppConfig::get('debug')){
	return;
}
$uid = 7788;
setcookie('uid', $uid);
setcookie('nick', '吉祥天');
setcookie('level', 9);
setcookie('area', '天宫');
setcookie('occupation', '尊者');
setcookie('sex', '女');
$time = time();
setcookie('time', $time);
$salt = substr(strval($time), -6, 6);
$sum = md5($salt.$uid);
setcookie('sum', $sum);

$r = time();
header("Location: hall_new.php?r=$r");

