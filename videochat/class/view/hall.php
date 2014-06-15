<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>仙侠世界-视频大厅</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="body_index">
    <div class="tips" id="card_input_container" style="display:none;">
    	<div class="center">
        	<div class="close"><a href="javascript:void(0)">×</a></div>
            <h4>激活道具卡</h4>
            <div class="content">
            	<span class="card1" title="刷夜卡"><img src="http://soso5.gtimg.cn/sosopic/0/2562055148412261852/150" alt="" />刷夜卡<a href="#">?</a></span>
                <span class="card1" title="生龙活虎卡"><img src="http://soso3.gtimg.cn/sosopic/0/12728324663532990971/150" alt="" />生龙活虎卡<a href="#">?</a></span>
                <span class="card1" title="活色生香卡"><img src="http://soso7.gtimg.cn/sosopic/0/6106635982176685593/150" alt="" />活色生香卡<a href="#">?</a></span>
                <form action="" method="post" class="form">
                	<h5 id="card_input_tips">输入你获得的卡片序列号，激活相应的卡片功能和礼物</h5>
                    <span class="title">卡号：</span><input id="card_input_num" type="text" class="input1" /><br />
                    <span id="card_input_response"></span><br />
                    <a href="javascript:void(0)" class="link" id="card_input_confirm">激活</a><a href="javascript:void(0)" class="link" id="card_input_close">关闭</a>
                </form>
            </div>
        </div>
    </div>

	<?php require(VIEW_DIR.'_header.php');?>
	<div class="z_banner">
    	<div class="black"><img src="http://adsfile.qq.com/201209/28/Es_NW_201209284849.jpg" alt="" /></div>
    </div>

    <div class="main">
    	<div class="main_left">
            <div class="post" id="msg_container"><img src="images/01.gif" alt="公告" /><span id="msg_wrap">公告消息</span></div>
            <div class="main_banner">
            	<a id="active_card" href="javascript:void(0)" class="card">&nbsp;</a><a id="room_in" href="<?php if ($login) echo '	room.php?rid=1';else echo 'javascript:void(0)'?>" class="room">&nbsp;</a>
            </div>
            <div class="main_select">如果没有那么多聊天室，可以插一个广告</div>
            <div class="ad_banner2"><img src="http://adsfile.qq.com/201209/28/Es_NW_201209284849.jpg" alt="" /></div>
        </div>
    	<div class="main_right">
        	<?php require(VIEW_DIR.'_paihang.php');?>
            <div class="ad_banner3"><img src="http://adsfile.qq.com/201209/28/Es_NW_201209284849.jpg" alt="" /></div>
            <div class="paihang"><img src="images/11.jpg" alt="" /></div>
        </div>
    </div>

	<?php require(VIEW_DIR.'_footer.php');?>

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/util.js"></script>
	<script type="text/javascript" src="js/hall_paihang.js?ver=1"></script>
	<script type="text/javascript" src="js/hall_message.js?ver=1"></script>
	<script>
	var _message = <?php echo $message?>;
	var _login = <?php var_export($login);?>

	if (typeof(message) == 'function'){
		message($("#msg_wrap"), $("#msg_container"), _message);
	}
	</script>
	<script type="text/javascript" src="js/hall_card.js?ver=1"></script>
</body>
</html>
