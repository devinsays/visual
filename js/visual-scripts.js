jQuery( document ).ready( function( $ ) {

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