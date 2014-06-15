PageMask = (function() {
	function addPageMask(maskStyle, maskClass) {
		var _view = (document.compatMode.toLowerCase() == "css1compat") ? document.documentElement
				: document.body, DefaultMaskStyle = {
			'height' : Math.max(parseInt(_view.scrollHeight, 10), parseInt(
					_view.clientHeight, 10)),
			'width' : Math.max(parseInt(_view.scrollWidth, 10), parseInt(
					_view.clientWidth, 10)),
			'position' : 'absolute',
			'z-index' : '90',
			'top' : 0,
			'left' : 0,
			'display' : 'block',
			'background-color' : '#000000',
			'opacity' : '0.3',
			'filter' : 'alpha(opacity = 50)'
		};
		maskStyle = maskStyle || {};
		var mask = $(
				"<div id='pageMask' "
						+ (maskClass ? " class='" + maskClass + "' " : '') + "/>")
				.appendTo(document.body);
		mask.css(DefaultMaskStyle).css(maskStyle)
	}

	function removePageMask() {
		$('#pageMask').remove();
	}
	
	return {
		'show' : function(maskStyle, maskClass) {
			addPageMask(maskStyle, maskClass);
		},
		'hide' : function() {
			removePageMask();
		}
	};
})();
