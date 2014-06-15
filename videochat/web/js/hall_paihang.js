(function paihang() {
	var tab_user = $("#paihang_tab_user");
	var tab_moderator = $("#paihang_tab_moderator");
	var user = $("#paihang_user");
	var moderator = $("#paihang_moderator");

	var user = {
		'tab' : $("#paihang_tab_user"),
		'list' : $("#paihang_user")
	};
	var moderator = {
		'tab' : $("#paihang_tab_moderator"),
		'list' : $("#paihang_moderator")
	};

	var show = function(obj) {
		obj.tab.attr('class', 'week');
		obj.list.show();
	};

	var hide = function(obj) {
		obj.tab.attr('class', 'day');
		obj.list.hide();
	};

	tab_user.click(function() {
		show(user);
		hide(moderator);
		return false;
	});

	tab_moderator.click(function() {
		show(moderator);
		hide(user);
		return false;
	});
})();