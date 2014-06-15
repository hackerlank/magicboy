<?php
require_once (__DIR__ . '/../app.inc');
$uid = $_GET['uid'];
$nick = Util::toUTF8($_GET['nick']);
$level = $_GET['level'];
$area = Util::toUTF8($_GET['area']);
$occupation = Util::toUTF8($_GET['occupation']);
$sex = Util::toUTF8($_GET['sex']);
$time = $_GET['time'];
$sum = $_GET['sum'];

setcookie('uid', $uid);
setcookie('nick', $nick);
setcookie('level', $level);
setcookie('area', $area);
setcookie('occupation', $occupation);
setcookie('sex', $sex);
setcookie('time', $time);
//$salt = substr(strval($time), -6, 6);
//$sum = md5($salt.$uid);
setcookie('sum', $sum);

var_dump($uid, $nick, $level, $area, $occupation, $time, $sum);
$time = time();
//ie下302居然会缓存 木有道理 头里的expire和cache-control都对...
header("Location: hall_new.php?$time");

