/**
 * 消息展现
 */
function message(msgWrap, msgContainer, message, intval){
	//消息播放的时间间隔
	var SHOW_INTERVAL = intval ? intval : 3000;
	//var msgWrap = $("#msg_wrap");
	//var msgContainer = $("#msg_container");
	var index = 0;
	var num = message.length;
	if (typeof(message) == 'undefined' || num == 0){
		msgContainer.hide();
		return;
	}
	
	setInterval(function(){
		msgWrap.text(message[index].msg);
		index++;
		index = index % num;
	}, SHOW_INTERVAL);	
};