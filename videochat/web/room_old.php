<?php
require_once(__DIR__.'/room.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>仙侠世界-视频聊天室</title>
<link href="css/style.css?v=<?php echo $version;?>" rel="stylesheet" type="text/css" />
<style>
.bqpic{ width: 50px; height: 50px;}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/room.js?v=<?php echo $version;?>"></script>
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
                    <a href="javascript:void(0)" class="link" id="dlgMsg_close2">我知道了</a>
                </form>
            </div>
        </div>
    </div>
    <div class="mask" id="dlgMask" style="display:none;"></div>
	<!--div class="header">
		<div class="h_left" id="userProfile">
			<div class="user_face"><img src="images/face/1.jpg" alt="" /></div>
			<div class="user_info"><span class="user_name"><?php psc($uid);?><em></em></span><br /><span class="user_game"></span></div>
		</div>
		<div class="h_right"><a href="http://xx.ztgame.com" target="_blank" title="进入仙侠世界官网"><img src="images/03.jpg"></a></div>
	</div-->
	<?php require(VIEW_DIR.'_header.php');?>
	<div class="z_video">
		<div class="time" id="currTime">00:00</div>
		<div class="video">
			<div class="banner" id="dj1" style="display:none"><a href="#">〆粉嘟嘟【主播】</a><span class="button">魅力值：214</span></div>
			<div class="flash" id="video1">这里插入flash</div>
		</div>
		<div class="video">
			<div class="banner" id="dj2" style="display:none"><a href="#">150013白狼招聘主播</a><span class="button">魅力值：88888</span></div>
			<div class="flash" id="video2"></div>
		</div>
		<div class="video">
			<div class="banner" id="dj3" style="display:none"><a href="#">150013白狼招聘主播</a><span class="button">魅力值：88888</span></div>
			<div class="flash" id="video3"></div>
		</div>
	</div>
	<div class="main">
		<div class="main_left">
			<div class="liaotian">
				<div class="jinru" id="loginArea">欢迎您！</div>
				<div class="neirong"><ul id="chatArea"></ul></div>
				<div class="xuanze">
                	<form action="" method="post" class="form">
                	<select name="" class="selcet1" id="msgTo"><option value="">所有人</option></select>
                    <span class="title">字体</span><select class="selcet2" id="msgFont"><option value="宋体">宋体</option><option value="黑体">黑体</option></select>
                    <span class="title">颜色</span><select class="selcet2" id="msgColor"><option value="#000" style="color:#000;">黑</option><option value="#F30" style="color:#F30;">红</option><option value="#690" style="color:#690;">绿</option></select>
                    <span class="title">大小</span><select class="selcet2" id="msgFontSize"><option value="20">20</option><option value="18">18</option><option value="16">16</option><option value="14">14</option><option value="12">12</option></select>
                    <span class="title">表情</span><span class="face" id="faceSelect">
                    <img src="images/12.jpg" alt="" />
                    <div class="face_select" id="msgFace">
                        <a href="###" w="[/我来了]" title="我来了"><img src="images/biaoqing/phiz01.gif" alt="" /></a>
                        <a href="###" w="[/色色]" title="色色"><img src="images/biaoqing/phiz02.gif" alt="" /></a>
                        <a href="###" w="[/大哭]" title="大哭"><img src="images/biaoqing/phiz03.gif" alt="" /></a>
                        <a href="###" w="[/我跑]" title="我跑"><img src="images/biaoqing/phiz04.gif" alt="" /></a>
                        <a href="###" w="[/狂晕]" title="狂晕"><img src="images/biaoqing/phiz05.gif" alt="" /></a>
                        <a href="###" w="[/撞墙]" title="撞墙"><img src="images/biaoqing/phiz06.gif" alt="" /></a>
                        <a href="###" w="[/恶魔]" title="恶魔"><img src="images/biaoqing/phiz07.gif" alt="" /></a>
                        <a href="###" w="[/吐]" title="吐"><img src="images/biaoqing/phiz08.gif" alt="" /></a>
                        <a href="###" w="[/可怜]" title="可怜"><img src="images/biaoqing/phiz09.gif" alt="" /></a>
                        <a href="###" w="[/亲亲]" title="亲亲"><img src="images/biaoqing/phiz10.gif" alt="" /></a>
                        <a href="###" w="[/飞吻]" title="飞吻"><img src="images/biaoqing/phiz11.gif" alt="" /></a>
                        <a href="###" w="[/欧耶]" title="欧耶"><img src="images/biaoqing/phiz12.gif" alt="" /></a>
                    </div>
                    </span>
                    </form>
                </div>
                <div class="shuru">
					<form method="post" class="form">
						<textarea id="msgArea" name="" cols="" rows="" class="textarea"></textarea>
						<input id="msgBtn" name="" type="button" class="button" />
					</form>
				</div>
				<div class="gonggao" id="sysmsg_container">系统公告：<br><span id="sysmsg_wrap">hello</span></div>
			</div>
			<div class="post" id="msg_container"><img src="images/01.gif" alt="公告" /><span id="msg_wrap">公告消息</span></div>
			<div class="ad_banner1"><img src="http://adsfile.qq.com/201209/28/Es_NW_201209284849.jpg" alt="" /></div>
		</div>
		<div class="main_right">
			<div class="paihang">
				<div class="top_tab">
					<a href="###" id="adminLink">管理<em>(<span id="adminCount">0</span>)</em></a>
					<a href="###" id="userLink" class="other">用户<em>(<span id="userCount">0</span>)</em></a>
				</div>
				<ul class="list" id="adminList">
					<!--<li><span class="span1"></span><span class="span2"><img src="http://piccache3.soso.com/face/_6693033057987775852" alt="" /></span><span class="span3"><a href="#">admin</a></span><span class="span4">129658577</span></li>-->
				</ul>
				<ul class="list" id="userList" style="display:none;">
					<!--<li><span class="span1"></span><span class="span2"><img src="http://piccache3.soso.com/face/_6693033057987775852" alt="" /></span><span class="span3"><a href="#">user</a><a href="#" class="admin_link">禁</a><a href="#" class="admin_link">封</a></span><span class="span4">129658577</span></li>-->
				</ul>
			</div>
			<div class="liwu">
				<div class="top_tab">
					<a href="#">礼物</a>
				</div>
				<ul class="list" id="props">
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/1.jpg" alt="" /></a>
						<a href="###" class="liwu_name">鲜花</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/2.jpg" alt="" /></a>
						<a href="###" class="liwu_name">红玫瑰</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/3.jpg" alt="" /></a>
						<a href="###" class="liwu_name">蓝玫瑰</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/4.jpg" alt="" /></a>
						<a href="###" class="liwu_name">幸运花</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/5.jpg" alt="" /></a>
						<a href="###" class="liwu_name">幸运棒棒糖</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/6.jpg" alt="" /></a>
						<a href="###" class="liwu_name">幸运丘比特</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/7.jpg" alt="" /></a>
						<a href="###" class="liwu_name">鼓掌</a>
					</li>
					<li>
                    	<span class="num">0</span>
						<a href="###" class="liwu_pic"><img src="<?php echo $imgBase;?>propinfo/8.jpg" alt="" /></a>
						<a href="###" class="liwu_name">仙侠世界徽章</a>
					</li>
				</ul>
                <div class="clear"></div>
				<div class="zengsong">
					<form action="" method="post" class="form">
						送给：<select id="propTo" name="" class="select"><option value="">请选择</option></select>
						数量：<select id="propCount" class="select"><option value="1">1份</option><option value="3">3份</option><option value="5">5份</option><option value="10">10份</option><option value="99">99份</option></select>
						<input id="giftBtn" type="button" class="button" value="送出" /><span id="myScore">当前积分：0</span>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php require(VIEW_DIR.'_footer.php');?>
	<script type="text/javascript" src="js/hall_message.js?v=<?php echo $version;?>"></script>
	<script>
	var _message = <?php echo $message;?>;
	var _sysmsg = <?php echo $sysmsg;?>;
	if (typeof(message) == 'function'){
		message($("#msg_wrap"), $("#msg_container"), _message);
		message($("#sysmsg_wrap"), $("#sysmsg_container"), _sysmsg);
	}
	</script>
</body>
</html>
