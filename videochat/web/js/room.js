//var cfg = {Max_Chat_Lines: 100, imgBase: 'http://img.xianxiashijie.com', sip: '180.96.15.122', vswf:'0.89'};
var cfg = {Max_Chat_Lines: 100, imgBase: 'http://118.192.41.231:8080/img', sip: '118.192.41.231', vswf:'1.01'};
//var cfg = {Max_Chat_Lines: 100, imgBase: 'http://118.192.41.231:8080/img', sip: 'localhost', vswf:'0.67'};

function onInitCompelete(vid){
	if(vid == 1){
		doAddMsg('正在连接视频服务器，请稍候...');
		swf('video1').doConnect();
	}
	else if(vid == 2){
	}
	else if(vid == 3){
	}
}
function onConnectSuccess(vid){
	doAddMsg('视频'+vid+'连接成功。');
	if(vid == 1){
		app.connected = true;
		swf('video2').doConnect();
	}
	else if(vid == 2){
		if(app.connected){
			swf('video3').doConnect();
		}
	}
	else if(vid == 3){
	}
}
function doConnectRejected(vid, msg){
	$('#loginArea').text(msg);
	doAddMsg('<span class="warning">连接服务器失败！</span>');
}
function onConnectFailed(vid){
	doAddMsg('<span class="warning">网络状况不佳，连接服务器失败！请稍后重新刷新页面(F5)</span>');
}
function onConnectClosed(vid){
	if(vid == 1){
		doAddMsg('<span class="warning2">已经从服务器断开，按F5即可刷新页面重新观看！！</span>');
		app.connected = false;
	}
	else{
		if(app.connected){
			doAddMsg('<span class="warning">视频'+vid+'断开，5秒后会自动重新连接...</span>');
			setTimeout(function(){
				if(app.connected){
					doAddMsg('正在重新连接视频'+vid);
					swf('video'+vid).doConnect();
				}
			}, 5000);
		}
		else{
			doAddMsg('<span class="warning">视频'+vid+'断开</span>');
		}
	}
}
function onInitRoom(info){
	app.uid = info.user.uid;
	app.role = info.user.role;
	for(var i = 0; i < info.userlist.length; i++){
		var curr = info.userlist[i];
		doAddUser(curr.uid, curr.nick, curr.role, curr.logo, curr.score);
	}
	doInitProps(info.props);
	doRefreshUserCount(0);
	doRefreshUserCount(1);
	doInitProfile(info.user);
	swf('video2').onInitRoom(info);
	swf('video3').onInitRoom(info);
}
function onLogin(msg, uid, nick, role, logo, score){
	if(app.uid == '') return; // 先于initRoom收到的login
	if(msg.length > 0){
		$('#loginArea').text(msg);
	}
	doAddUser(uid, nick, role, logo, score);
	doRefreshUserCount(role);
}
function onLogout(msg, uid, nick, role){
	doRemoveUser(uid, role);
	doRefreshUserCount(role);
}
function onVideoPublish(vid, uid, nick, score){
	var currScore = $('#user1_'+uid + ' .jifen').html();
	if(currScore != null){
		score = currScore;
	}
	$('#dj'+vid).html('<a href="###" onclick="selectUser(\''+uid+'\',1)">'+nick+'</a><span class="button" id="m_'+uid+'">魅力值：'+score+'</span>').show();
}
function onVideoUnpublish(vid){
	$('#dj'+vid).hide();
}
function doSendMsg(msg, to, font, color, size){
	msg = $.trim(msg);
	if(msg.length > 0){
		if(msg.length > 100){
			myAlert('超出最大发送字数限制了哦');
		}
		else{
			swf('video1').doSendMsg(msg, to, font, color, size);
			return true;
		}
	}
	else{
		myAlert('请输入您要发送的内容');
		$('#msgArea').focus();
	}
	return false;
}
function onChatMsg(msg){
	if(msg.length > 0){
		doAddMsg(msg);
	}
}
function doSendGift(propid, count, to, propName){
	// 验证
	if(count > 0){
		swf('video1').doSendGift(propid, count, to, propName);
	}
}
function onGiftMsg(msg){
	if(msg.content.length > 0){
		doAddMsg(msg.content.replace(/%sendCount%/, 1));
	}
	if(msg.sendCount > 1){
		for(var i = 2; i <= msg.sendCount; i++){
			doAddMsg(msg.content.replace(/%sendCount%/, i));
		}
	}
	if(app.uid == msg.from){
		var prop = $('#prop' + msg.propid);
		if(prop){
			prop.find('.l_num').text(msg.ownCount);
			prop.data('num', msg.ownCount);
		}
		$('#myScore').text('当前积分：' + msg.myscore + '分');
	}
	$('#user0_' + app.uid + ' .jifen').text(msg.myscore);
	$('#user1_' + msg.to + ' .jifen').text(msg.toscore);
	$('#m_'+msg.to).text('魅力值：' + msg.toscore);
}
function doAddMsg(msg){
	var chatArea = $('#chatArea');
	var lines = chatArea.children();
	if(lines.length >= cfg.Max_Chat_Lines){
		$(chatArea.children()[0]).remove();
	}
	$('<li></li>').css('line-height', '180%').html(msg).appendTo(chatArea);
	chatArea.parent().scrollTop(99999);
}

function createSWF(swf, placehoder, flashvars, attributes){
	var swfVersionStr = "11.1.0";
	var xiSwfUrlStr = "playerProductInstall.swf";
	var params = {};
	params.wmode = "transparent";
	params.quality = "high";
	params.allowscriptaccess = "sameDomain";
	attributes.id = placehoder;
	attributes.name = placehoder;
	attributes.align = "middle";
	swfobject.embedSWF(swf+".swf?v="+cfg.vswf, placehoder, "250", "200", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
}
function swf(id){
	return swfobject.getObjectById(id);
}

function getFaceImage(role, logo){
	ret = '';
	if(role == 0){
		ret = "images/face/" + logo + ".jpg";
	}
	else if(role == 1){
		ret = "images/face/moderator.jpg";
	}
	else{
		ret = "images/face/admin.jpg";
	}
	return ret;
}
function getPropImageSrc(id){
	return cfg.imgBase + '/propinfo/'+id+'.gif';
}
function doInitProfile(user){
	if(user.role == 0){
		$('#myScore').text('当前积分：' + user.score + '分').show();
	}
}

function doInitProps(props){
	var propEl = $('#props');
	propEl.children().remove();
	for(var i = 0; i < props.length; i++){
		var prop = props[i];
		var propid = parseInt(prop.id, 10);
		var item = $('<a href="###" title="'+prop.name+'"></a>').attr('id', 'prop'+propid).data('id', propid).data('num', parseInt(prop.num, 10)).data('name', prop.name);
		$('<div class="l_num">'+prop.num+'</div>').appendTo(item);
		$('<img src="'+getPropImageSrc(propid)+'" alt="" />').appendTo(item);
		item.click(function(){
			$('#props a').removeClass('select');
			$(this).addClass('select');
		}).appendTo(propEl);
	}
}

function doRefreshUserCount(role){
	if(role == 0){
		$('#userCount').text($('#userList li').length + 0);
	}
	else{
		$('#adminCount').text($('#adminList li').length);
	}
}
function doAddUser(uid, nick, role, logo, score){
	if(uid != app.uid){
		$('<option></option>').val(uid).text(nick).appendTo($('#msgTo'));
	}
	if(uid != app.uid && role == 1){
		var exists = false;
		$('#propTo option').each(function(){
			var opt = $(this);
			if(opt.val() == uid){
				exists = true;
				return false;
			}
		});
		if(!exists){
			$('<option></option>').val(uid).text(nick).appendTo($('#propTo'));
		}
	}
	var logoImg = getFaceImage(role, logo);
	var li = $('<li></li>').data('uid', uid).attr('id', 'user'+role+'_'+uid);
	li.append($('<span class="face"><img src="'+logoImg+'" alt="" /></span>'));
	if($('#user'+role+'_'+uid).length == 0){
		if(role == 0){
			var userSelectLink = getUserSelectLink(uid, nick, role);
			var banStr = app.role != 0 ? '<a href="###" onclick="ban(\''+uid+'\')" class="jin">禁言</a>' : '';
			li.append($('<span class="name">'+userSelectLink + banStr + '</span>'));
			li.append($('<span class="jifen">'+score+'</span>'));
			li.appendTo($('#userList'));
		}
		else{
			var userSelectLink = getUserSelectLink(uid, nick, role);
			li.append($('<span class="name">'+userSelectLink+'</span>'));
			li.append($('<span class="jifen">'+score+'</span>'));
			li.appendTo($('#adminList'));
		}
	}
}
function doRemoveUser(uid, role){
	$('#msgTo option').each(function(inx, el){
		var opt = $(el);
		if(opt.val() == uid){
			if(role != 0){
				opt.remove();
			}
			return false;
		}
	});
	if(role == 1){
		$('#propTo option').each(function(inx, el){
			var opt = $(el);
			if(opt.val() == uid){
				opt.remove();
				return false;
			}
		});
	}
	var el = role == 0 ? $('#userList') : $('#adminList');
	el.find('li').each(function(){
		var curr = $(this);
		if(curr.data('uid') == uid){
			if(role != 0){
				curr.remove();
			}
			return false;
		}
	});
}
function chatWith(uid, role){
	if(uid == app.uid) return;
	selectUser(uid, role);
	$('#msgArea').focus();
}
function selectUser(uid, role){
	if(uid == app.uid) return;
	$('#msgTo').val(uid);
	if(role == 1){
		$('#propTo').val(uid);
	}
}
function getUserSelectLink(uid, nick, role){
	if(role == 0){
		return '<a href="###" title="'+uid+'" onclick="selectUser(\''+uid+'\','+role+')">' + nick + '</a>';
	}
	else{
		return '<a href="###" onclick="selectUser(\''+uid+'\','+role+')">' + nick + '</a>';
	}
}
function doubleDigitFormat(num){
    if(num < 10) {
        return ("0" + num);
    }
    return num;
}
function updateCurrTime(){
	var now = new Date();
	var s = doubleDigitFormat(now.getHours()) + ':' + doubleDigitFormat(now.getMinutes());
	$('#currTime').text(s);
}
function ban(uid){
	if(confirm('您确实要将该用户【禁言】吗？')){
		swf('video1').doBan(uid);
	}
}
$(window).bind('beforeunload', function(){
	try{
		swf('video1').doDisconnect();
		swf('video2').doDisconnect();
		swf('video3').doDisconnect();
	}
	catch(err){};
});
$(function(){
	createSWF('roomVideo', 'video1', {rid: app.rid, vid: 1, sid: app.sid, sip: cfg.sip, appname: 'room_1', width: 287}, {});
	createSWF('roomVideo', 'video2', {rid: app.rid, vid: 2, sid: app.sid, sip: cfg.sip, appname: 'room_1v', width: 287}, {});
	createSWF('roomVideo', 'video3', {rid: app.rid, vid: 3, sid: app.sid, sip: cfg.sip, appname: 'room_t', width: 287}, {});
	$('#msgArea').keydown(function(evt){
		if(evt.keyCode == 13){
			$('#msgBtn').trigger('click');
			evt.keyCode = 0;
			evt.returnValue = false;
			return false;
		}
	});
	$('#msgBtn').click(function(){
		if(!app.connected){
			myAlert('尚未连接到服务器，请稍候...');
			return;
		}
		$(this).attr('disable', true);
		var ret = doSendMsg($('#msgArea').val(), $('#msgTo').val(), $('#msgFont').val(), $('#msgColor').val(), $('#msgFontSize').val());
		if(ret){
			$('#msgArea').val('');
			$(this).attr('disable', false);
		}
	});
	$('#giftBtn').click(function(){
		if(!app.connected){
			myAlert('尚未连接到服务器，请稍候...');
			return;
		}
		if($('#props a.select').length == 0){
			myAlert('请先在右下方选择您要送出的礼物');
			return;
		}
		if($('#propTo').val() == ''){
			myAlert('请在礼物下方选择您要送给哪位主持人');
			$('#propTo').focus();
			return;
		}
		currProp = $('#props a.select');
		var propName = currProp.data('name');
		var propid = currProp.data('id');
		var ownCount = currProp.data('num');
		var sendCount = parseInt($('#propCount').val(), 10);
		if(ownCount == 0){
			myAlert('您已经没有【'+propName+'】了，赠送失败');
		}
		else if(ownCount < sendCount){
			myAlert('您只有'+ownCount+'个【'+propName+'】，请重新选择赠送数量');
		}
		else{
			doSendGift(propid, sendCount, $('#propTo').val(), propName);
			currProp.data('num', currProp.data('num') - sendCount);
		}
	});
	$('#adminLink').add('#userLink').click(function(){
		if($(this).attr('id') == 'userLink'){
			$('#adminLink').removeClass('now').addClass('other');
			$('#adminList').hide();
			$('#userLink').removeClass('other').addClass('now');
			$('#userList').show();
		}
		else{
			$('#adminLink').removeClass('other').addClass('now');
			$('#adminList').show();
			$('#userLink').removeClass('now').addClass('other');
			$('#userList').hide();
		}
	});
	$('#msgArea').setCaret();
	$('#msgFace a').click(function(){
		var link = $(this);
		$('#msgArea').insertAtCaret(link.attr('w'));
	});
	$('#msgFace').mouseover(function(){
		app.biaoqing = 1;
	}).mouseout(function(){
		app.biaoqing = 0;
	});
	$('#faceSelect').click(function(){
		app.biaoqing = 1;
		$('#msgFace').show();
		return false;
	}).mouseout(function(){
		app.biaoqing = 0;
	});
	setInterval(function(){
		if(app.biaoqing == 0){
			$('#msgFace').hide();
		}
	}, 2000);
	$(document).click(function(){
		$('#msgFace').hide();
	});
	$('#dlgMsg_close1').add('#dlgMsg_close2').click(function(){
		$('#dlgMsg').hide();
		$('#dlgMask').hide();
	});
});
function myAlert(s){
	$('#dlgMsg_content').html(s);
	$('#dlgMask').show();
	$('#dlgMsg').show();
}

jQuery.fn.extend({   
    setCaret: function(){   
        if(!$.browser.msie) return;   
        var initSetCaret = function(){   
            var textObj = $(this).get(0);   
            textObj.caretPos = document.selection.createRange().duplicate();   
        };   
        $(this)   
        .click(initSetCaret)   
        .select(initSetCaret)   
        .keyup(initSetCaret);   
    },   
    insertAtCaret: function(textFeildValue){   
       var textObj = $(this).get(0);   
       if(document.all && textObj.createTextRange && textObj.caretPos){   
           var caretPos=textObj.caretPos;   
           caretPos.text = caretPos.text.charAt(caretPos.text.length-1) == '' ?   
                               textFeildValue+'' : textFeildValue;   
       }   
       else if(textObj.setSelectionRange){   
           var rangeStart=textObj.selectionStart;   
           var rangeEnd=textObj.selectionEnd;   
           var tempStr1=textObj.value.substring(0,rangeStart);   
           var tempStr2=textObj.value.substring(rangeEnd);   
           textObj.value=tempStr1+textFeildValue+tempStr2;   
           textObj.focus();   
           var len=textFeildValue.length;   
           textObj.setSelectionRange(rangeStart+len,rangeStart+len);   
           textObj.blur();   
       }   
       else {   
           textObj.value+=textFeildValue;   
       }   
    }   
});   
