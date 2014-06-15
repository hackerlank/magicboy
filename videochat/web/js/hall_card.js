var container = $("#card_input_container");
var cardInputContainer = $("#card_input_container");
var cardInputTips = cardInputContainer.find("#card_input_tips");
var cardNum = cardInputContainer.find("#card_input_num");
var confirmBt = cardInputContainer.find("#card_input_confirm");
var response = cardInputContainer.find("#card_input_response");

function showResponse(text) {
	response.text(text);
	response.show();
}

function hideResponse() {
	response.hide();
}

function showCardInputContainer() {
	cardInputContainer.show();
	response.text('');
	cardNum.val('');
	cardNum.focus();
	PageMask.show();
}

// 包夜卡
(function card_1() {
	if (_login == true){
		return;
	}
	
	showCardInputContainer();
	cardInputTips.text('请输入刷夜卡卡号');
	
	function doSubmit() {
		var seq = cardNum.val();
		if (!seq || isNaN(seq)) {
			showResponse('卡号错误');
			return;
		} else {
			hideResponse();
		}
		
		$.getJSON('card.php', {'seq' : seq, 'r' : Math.random(), 't':1}, function(json) {
			if (typeof (json) == 'undefined' || json == null) {
				showResponse('服务忙，请稍后再试');
				return;
			}

			showResponse(json.response);
			if (typeof (json.url) != 'undefined') {
				location.href = json.url;
				//window.open(json.url, '_self');
			}
		});
	};
	
	confirmBt.click(function(){
		doSubmit();
		return false;
	});
	
	$("form").submit(function(){
		doSubmit();
		return false;
	});
})();

// 激活道具
(function card_23() {
	if (!_login){
		return;
	}
	// 关闭按纽
	container.find(".close, #card_input_close").click(function() {
		container.hide(); 
		PageMask.hide();
	});
	 
	var activeCardBt = $("#active_card");
	
	function doSubmit() {
		var seq = cardNum.val();
		if (!seq || isNaN(seq)) {
			showResponse('卡号错误');
			return;
		} else {
			hideResponse();
		}
		
		var type = seq.substr(0, 1);
		if (type != 2 && type != 3){
			showResponse('卡号错误');
			return;
		}
		$.getJSON('card.php', {'seq':seq, 'r':Math.random(), 't':type}, function(json) {
			if (typeof (json) == 'undefined' || json == null) {
				showResponse('服务忙，请稍后再试');
				return;
			}
			if (json.err != 0){
				showResponse(json.response);
			}
			else{
				container.find(".close").click();
				alert(json.response);
				PageMask.hide();
			}
		});
	}
	
	activeCardBt.click(function() {
		showCardInputContainer();
		cardInputTips.text('请输入卡号');
		confirmBt.click(function(){
			doSubmit();
			return false;
		});
		
		return false;
	});
	
	$("form").submit(function(){
		doSubmit();
		return false;
	});
})();