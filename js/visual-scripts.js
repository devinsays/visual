jQuery( document ).ready( function( $ ) {

	// jQuery Plugin for post loading images
	
	$.fn.postLoadImages = function(callback) {
		var imgLen = this.length,
			count = 0;
		return this.each(function(count) {
			count++;
			if ($(this).attr('data-src')) {
				var imgTag = this, imgSrc = $(this).attr('data-src');
				i = new Image();
				i.onload = function() {
					$(imgTag).fadeTo(0,0).attr('src',imgSrc).fadeTo(400,1,function() {
						if (imgLen == count) {
							if (typeof callback == 'function') {
								callback.call(this);
							}
						}
					});
				};
				i.src = imgSrc;
			}
		});
	};

	// jQuery Plugin for doing a fade/toggle
	
	$.fn.slideFadeToggle = function( speed, easing, callback ) {
	return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};

	// Shows/Hides the menu when viewing theme on small screens
	
	$('.menu-toggle a').on( 'click', function(e) {
		e.preventDefault();
		$('.menu-main-container').slideToggle('slow', function() {
			if ( $(this).is(":hidden") ) {
				$(this).attr('style','');
			}
		});
	});
	
});