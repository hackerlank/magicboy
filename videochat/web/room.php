<?php
require_once(__DIR__.'/room.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>仙侠世界-视频聊天室</title>
<link href="css/style_new_chat1.css" rel="stylesheet" type="text/css" />
<style>
.bqpic{ width: 50px; height: 50px;}
.warning{ color: red; }
.warning2{ color: red; font-weight: bold;}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/room.js?v=1.01"></script>
<script type="text/javascript">
var app = {sid:'<?php echo $sid; ?>',rid:<?php echo $rid; ?>,uid:'',role:0,connected: false,biaoqing:0};
</script>
</head>

<body>
    <div class="tips" id="dlgMsg" style="display:none;">
    	<div class="center">
        	<div class="close"><a href="javascript:void(0)" id="dlgMsg_close1">×</a></div>
            <h4>温馨提示</h4>
            <div class="content">
                <form action="" method="post" class="form">
                	<h5 id="dlgMsg_content" style="text-align:left"></h5>
                    <span id="card_input_response"></span><br />
                    <a href="###" class="link" id="dlgMsg_close2">我知道了</a>
                </form>
            </div>
        </div>
    </div>
    <div class="mask" id="dlgMask" style="display:none;"></div>
	<div id="main">
    	<div class="top_nav"><a href="http://xx.ztgame.com/index.shtml" target="_blank" class="home">进入官网</a>|<a href="http://xx.ztgame.com/index.html" target="_blank">注册账号</a>|<a href="http://bbs.xx.ztgame.com/" target="_blank">官方论坛</a></div>
        <div style="height:88px;">1</div>
        <div class="clear"></div>
        <div class="block1">
        	<div class="video">
        		<div id="dj1" class="banner" style="display:none">
        			<a href="#">【主播】</a>
        			<span class="button">魅力值：</span>
        		</div>
        		<div class="flash" id="video1">载入中...</div>
        	</div>
        	<div class="video">
        		<div id="dj2" class="banner" style="display:none">
        			<a href="#">【主播】</a>
        			<span class="button">魅力值：</span>
        		</div>
        		<div class="flash" id="video2">载入中...</div>
        	</div>
        	<div class="video">
        		<div id="dj3" class="banner" style="display:none">
        			<a href="#">【主播】</a>
        			<span class="button">魅力值：</span>
        		</div>
        		<div class="flash" id="video3">载入中...</div>
        	</div>
        </div>
        <div class="block2">
        	<div class="liaotian_content">
            	<div class="welcome"><marquee id="loginArea" scrolldelay="500" scrollamount="50">欢迎您！</marquee></div>
            	<div class="liaotian">
	            	<ul id="chatArea" style="list-style-type:none"></ul>
                </div>
            	<div class="chose">
                	<div class="face_select" id="msgFace" style="display:none">
                        <a href="###" w="[/我来了]" title="我来了"><img src="images/biaoqing/phiz01.gif" alt="/我来了" /></a>
                        <a href="###" w="[/色色]" title="色色"><img src="images/biaoqing/phiz02.gif" alt="/色色" /></a>
                        <a href="###" w="[/大哭]" title="大哭"><img src="images/biaoqing/phiz03.gif" alt="/大哭" /></a>
                        <a href="###" w="[/我跑]" title="我跑"><img src="images/biaoqing/phiz04.gif" alt="/我跑" /></a>
                        <a href="###" w="[/狂晕]" title="狂晕"><img src="images/biaoqing/phiz05.gif" alt="/狂晕" /></a>
                        <a href="###" w="[/撞墙]" title="撞墙"><img src="images/biaoqing/phiz06.gif" alt="/撞墙" /></a>
                        <a href="###" w="[/恶魔]" title="恶魔"><img src="images/biaoqing/phiz07.gif" alt="/恶魔" /></a>
                        <a href="###" w="[/吐]" title="吐"><img src="images/biaoqing/phiz08.gif" alt="/吐" /></a>
                        <a href="###" w="[/可怜]" title="可怜"><img src="images/biaoqing/phiz09.gif" alt="/可怜" /></a>
                        <a href="###" w="[/亲亲]" title="亲亲"><img src="images/biaoqing/phiz10.gif" alt="/亲亲" /></a>
                        <a href="###" w="[/飞吻]" title="飞吻"><img src="images/biaoqing/phiz11.gif" alt="/飞吻" /></a>
                        <a href="###" w="[/欧耶]" title="欧耶"><img src="images/biaoqing/phiz12.gif" alt="/欧耶" /></a>
                    </div>
                	<form action="" method="post">
                    <select name="" class="select1" id="msgTo"><option value="">所有人</option></select>
                    字体：<select name="" class="select2" id="msgFont"><option value="宋体">宋体</option><option value="黑体">黑体</option><option value="微软雅黑">微软雅黑</option></select>
                    颜色：<select name="" class="select2" id="msgColor"><option value="#F3C" style="color:#fff; background-color:#F3C">粉红</option><option value="#000" style="color:#fff; background-color:#000">黑色</option><option value="#F30" style="color:#fff; background-color:#F30">红色</option><option value="#690" style="color:#fff; background-color:#690">绿色</option><option value="#00F" style="color:#fff; background-color:#00F">蓝色</option><option value="#E9AF25" style="color:#fff; background-color:#E9AF25">黄色</option></select>
                    字号：<select name="" class="select2" id="msgFontSize"><option value="12">12</option><option value="14">14</option><option value="16">16</option><option value="18" select="select">18</option><option value="20">20</option><option value="30">30</option></select>
                    <img src="img/07.jpg" class="face" alt="" id="faceSelect" />
                    </form>
                </div>
            	<div class="input">
                	<textarea id="msgArea" class="input1"></textarea><input id="msgBtn" type="button" class="button1" value="" />
                </div>
            </div>
        	<div class="message" id="msg_container">
        	<span id="msg_warp">
        	聊天室消息
            </span>
            </div>
        </div>
        <div class="block3">
        	<div class="user_list">
                <div class="tab">
                	<a href="###" id="adminLink" class="now">管理(<span id="adminCount">0</span>)</a>
                	<a href="###" id="userLink" class="other">用户(<span id="userCount">0</span>)</a>
                </div>
                <div class="content">
                	<ul class="list" id="adminList">
                		<!--
                    	<li><span class="face"><img src="http://piccache3.soso.com/face/_6693033057987775852" alt="" /></span><span class="name"><a href="#">爱你♂让我</a><a href="#" class="jin">禁</a><a href="#" class="jin">封</a></span><span class="jifen">129658577</span></li>
                		-->
                	</ul>
					<ul class="list" id="userList" style="display:none;">
					</ul>
                </div>
            </div>
        	<div class="liwu_list">
                <div class="tab"><a href="#" class="now">礼物</a></div>
                <div class="content" id="props">
	                <a href="###" title="鲜花"><img src="<?php echo $imgBase;?>propinfo/1.gif" alt="鲜花" /></a>
	                <a href="###" title="红玫瑰"><img src="<?php echo $imgBase;?>propinfo/2.gif" alt="红玫瑰" /></a>
	                <a href="###" title="蓝玫瑰"><img src="<?php echo $imgBase;?>propinfo/3.gif" alt="蓝玫瑰" /></a>
	                <a href="###" title="幸运花"><img src="<?php echo $imgBase;?>propinfo/4.gif" alt="幸运花" /></a>
	                <a href="###" title="幸运棒棒糖"><img src="<?php echo $imgBase;?>propinfo/5.gif" alt="幸运棒棒糖" /></a>
	                <a href="###" title="幸运丘比特"><img src="<?php echo $imgBase;?>propinfo/6.gif" alt="幸运丘比特" /></a>
	                <a href="###" title="鼓掌"><img src="<?php echo $imgBase;?>propinfo/7.gif" alt="鼓掌" /></a>
	                <a href="###" title="仙侠世界徽章"><img src="<?php echo $imgBase;?>propinfo/8.gif" alt="仙侠世界徽章" /></a>
	                <a href="###" title="玫瑰之约"><img src="<?php echo $imgBase;?>propinfo/9.gif" alt="玫瑰之约" /></a>
                </div>
                <form action="" method="post" class="zengsong">
                    赠给：<select id="propTo" class="select1"><option value="">请选择</option></select>
                    数量：<select id="propCount" class="select2"><option value="1">1份</option><option value="3">3份</option><option value="5">5份</option><option value="10">10份</option><option value="99">99份</option></select>
                    <input id="giftBtn" type="button" class="button1" value="" />
                    <span class="num" id="myScore" style="display:none">当前积分：0分</span>
                </form>
            </div>
        </div>
    </div>

<script src="js/hall_message.js?v=<?php echo $version?>"></script>
<script>
	var _msg = <?php echo $message; ?>;
	message($("#msg_container"), $("#msg_warp"), _msg);
</script>
</body>
</html>
