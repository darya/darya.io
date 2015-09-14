(function(hljs, jQuery) {
	hljs.initHighlightingOnLoad();
	
	jQuery(function($) {
		var body = $('body');
		var height = $(document).height();
		
		$(document).scroll(function(event){
			if ($(document).scrollTop() >= 50 && height + 200 > $(window).height()) {
				body.addClass('collapse-header');
			} else {
				body.removeClass('collapse-header');
			}
		});
	});
})(hljs, jQuery);
