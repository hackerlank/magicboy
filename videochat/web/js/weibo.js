(function weibo(){
	var tabs = [
	            {'bt':$("#sina_bt"), 'content':$("#sina_content")},
	            {'bt':$("#qq_bt"), 'content':$("#qq_content")}
	            ];
	
	function hiddenAll(){
		var num = tabs.length;
		for (var i=0; i<num; i++){
			tabs[i].bt.removeClass();
			tabs[i].content.css('display', 'none');
		}
	}
	
	function findIndex(clickElem){
		
	}
	
	function init(){
		var num = tabs.length;
		for (var i=0; i<num; i++){
			tabs[i].bt.data('seq', i);
			tabs[i].bt.click(function(){
				hiddenAll();
				var seq = $(this).data('seq');
				var self = tabs[seq];
				self.bt.addClass('now');
				self.content.css('display', 'block');
				return false;
			});
		}
	}
	
	init();
})();