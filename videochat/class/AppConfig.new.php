<?php
define('DB_DSN', 'mysql:host=172.27.1.123;dbname=chat');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mysql8*');
define('LOG_PATH', dirname(dirname(__FILE__)).'/log/');

define('FMS_MAX_USER_COUNT', 500);

class AppConfig
{
	private static $data = array(
		'db' => array(
			'class' => 'PDODB',
			'dsn' => DB_DSN,
			'user' => DB_USER,
			'password' => DB_PASSWORD,
		),

		'mcache' => array(
			'type' => 'memcache',
			'memcache' => array(
				'host' => '172.27.1.121',
				'port' => 11211,
			),
		),
		//聊天室开启时间配置
		'start' => array(
			//几点到几点，不配置表示何时都行
			'hour'=>array('begin'=>0, 'end'=>8),
			//周几 不配置表示无限制
			'day'=>array(0,6),
			//有该标记时不进行时间校验
			'allowAll' => true,
		),

		'imgBase'=>'http://img.xianxiashijie.com/',
		'log' => array('path'=>LOG_PATH, 'level'=>1),
		// 表情图片
		'biaoqing' => array(
			'[/我来了]'	=> '<img src="images/biaoqing/phiz01.gif" class="bqpic" />',
			'[/色色]'	=> '<img src="images/biaoqing/phiz02.gif" class="bqpic" />',
			'[/大哭]'	=> '<img src="images/biaoqing/phiz03.gif" class="bqpic" />',
			'[/我跑]'	=> '<img src="images/biaoqing/phiz04.gif" class="bqpic" />',
			'[/狂晕]'	=> '<img src="images/biaoqing/phiz05.gif" class="bqpic" />',
			'[/撞墙]'	=> '<img src="images/biaoqing/phiz06.gif" class="bqpic" />',
			'[/恶魔]'	=> '<img src="images/biaoqing/phiz07.gif" class="bqpic" />',
			'[/吐]'		=> '<img src="images/biaoqing/phiz08.gif" class="bqpic" />',
			'[/可怜]'	=> '<img src="images/biaoqing/phiz09.gif" class="bqpic" />',
			'[/亲亲]'	=> '<img src="images/biaoqing/phiz10.gif" class="bqpic" />',
			'[/飞吻]'	=> '<img src="images/biaoqing/phiz11.gif" class="bqpic" />',
			'[/欧耶]'	=> '<img src="images/biaoqing/phiz12.gif" class="bqpic" />',
		),
		'version' => 2,
	);

	public static function get($key){
		return isset(self::$data[$key]) ? self::$data[$key] : false;
	}
}
?>
