<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>仙侠世界-视频聊天室</title>
<link href="css/style_new.css?v=<?php echo $version?>" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="header">
    	<div class="left_banner"><a href="http://act.xx.ztgame.com/mmanchor/index.html" target="_blank"><img src="img/03.jpg" alt="" /></a></div>
    	<div class="right_banner"><a href="<?php if ($login) echo '	room.php?rid=1';else echo 'javascript:void(0)'?>"><img src="img/02.jpg" alt="" /></a></div>
    </div>
    <div class="main">
    	<div class="block1">
        	<h1>个人信息</h1>
            <div class="user_info">
            	<div class="face"><img src="images/face/<?php echo $user['face_id'].'b.jpg'?>" alt="头像" /></div>
                <span class="user_title">游戏昵称：</span><span class="user_txt"><?php echo Util::htmlencode($user['nick'])?></span><br />
                <span class="user_title">大区：</span><span class="user_txt"><?php echo Util::htmlencode($user['area'])?></span><br />
                <span class="user_title">职业 ：</span><span class="user_txt"><?php echo Util::htmlencode($user['occupation'])?></span><br />
                <span class="user_title">等级：</span><span class="user_txt"><?php echo Util::htmlencode($user['level'])?></span><br />
            </div>
            <?php require(VIEW_DIR.'_paihang_new.php');?>
        </div>

    	<div class="block2">
        	<h1>美女主播&nbsp;&nbsp;|<span>今日主播人气王,快来围观吧~</span></h1>
			<?php require(VIEW_DIR.'_moderator.php');?>
            <div class="title"><span>精彩活动</span><a href="#">更多>></a></div>
            <div class="list_hd">
            <a href="http://act.xx.ztgame.com/mmshow/" target="_blank"><img src="http://img.xianxiashijie.com/ads/zmbb.jpg" /></a><a href="http://act.xx.ztgame.com/mmanchor/index.html" target='blank'><img src="http://img.xianxiashijie.com/ads/mndzb.jpg" /></a><a href="http://games.qq.com/gameact/xx.htm 	" target="_blank"><img src="http://img.xianxiashijie.com/ads/qqlh.jpg" /></a><a href="http://bbs.xx.ztgame.com/" target="_blank"><img src="http://img.xianxiashijie.com/ads/wjlt.jpg" /></a>
            </div>
        </div>

    	<div class="block3">
            <div class="title"><span>新闻公告</span><a href="http://xx.ztgame.com/html/news/index-1.shtml" target="_blank">更多>></a></div>
            <?php require(VIEW_DIR.'_news.php');?>
            <div class="title"><span>官方微博</span></div>
            <div class="weibo">
            	<a href="javascript:void(0);" class="now" id="sina_bt">新浪微博</a>
                <a href="javascript:void(0);" id="qq_bt">腾讯微博</a>
                <div class="clear"></div>
                <div class="iframe" id="sina_content">
					<iframe width="210" height="200" frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=210&height=220&fansRow=2&ptype=1&speed=0&skin=5&isTitle=0&noborder=0&isWeibo=1&isFans=0&uid=2704572055&verifier=9551ab13&colors=d6f3f7,f1f8fe,666666,0082cb,ecfbfd&dpc=1"></iframe>
                </div>
                <div class="iframe" id="qq_content" style="display:none;">
                	<iframe width="210" height="200" frameborder="0" scrolling="no" src="http://show.v.t.qq.com/index.php?c=show&a=index&n=xianxiashijie&w=210&h=150&fl=1&l=4&o=17&co=4&cs=0000FF_F1F8FE_1983D3_FFFFFF"></iframe>
                </div>
            </div>
            <div class="ad1"><a href="http://act.xx.ztgame.com/team/" target="_blank"><img src="http://img.xianxiashijie.com/ads/dbt.jpg" /></a></div>
            <div class="ad1"><a href="http://xx.ztgame.com/" target="_blank"><img src="http://img.xianxiashijie.com/ads/bxhfc.jpg"  /></a></div>
			<div class="title"><span>使用帮助</span><a href="#">更多>></a></div>
			<?php require(VIEW_DIR.'_help.php');?>
        </div>
    </div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/weibo.js?v=<?php echo $version?>"></script>
</body>
</html>
