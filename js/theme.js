/*!
 * Script for initializing globally-used functions and libs.
 *
 * @since 1.0.0
 */
 (function($) {

 	var visual = {

 		// Cache selectors
	 	cache: {
			$document: $(document),
			$window: $(window),
			$main: $('#posts-wrap'),
			masonry : false,
			masonryLoaded: false,
			windowWidth : $(window).width(),
			$colophon : $('#colophon')
		},

		// Init functions
		init: function() {

			this.bindEvents();

		},

		// Bind Elements
		bindEvents: function() {

			var self = this;

			// jQuery Plugin for doing a fade/toggle
			$.fn.slideFadeToggle = function( speed, easing, callback ) {
				return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
			};

			self.navigationInit();

			this.cache.$document.on( 'ready', function() {

				if ( $('body').hasClass('masonry') ) {
					self.cache.masonry = true;
					self.masonryInit();
				}

				// Stick footer to bottom of page
				var cheight = self.cache.$colophon.outerHeight();
				$('#push').css({ 'height':cheight });
				$('#page').css({'margin-bottom': ( cheight *-1 )});

			} );

			// Handle Masonry on Resize
			this.cache.$window.on( 'resize', self.debounce(
				function() {

					if ( self.cache.masonry ) {
						self.masonryInit();
					}

				}, 200 )
			);

			// Infinite Scroll
			$( document.body ).on( 'post-load', function ( postload ) {

				var $newItems = $('.infinite-wrap').not('.is--replaced');
				var $elements = $newItems.find('.hentry');
				$elements.hide();
				self.cache.$main.append($elements);
				$elements.imagesLoaded( function() {
					console.log( 'reloaded' );
					self.cache.$main.masonry( "appended", $elements, true ).masonry( "reloadItems" ).masonry( "layout" );
					$elements.fadeIn();
				});

			});

		},

		/**
		 * Initialize the mobile menu functionality.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		navigationInit: function() {

			// Shows/Hides the menu when viewing theme on small screens
			$('.menu-toggle a').on( 'click', function(e) {
				e.preventDefault();
				$('.main-navigation .menu').slideToggle('slow', function() {
					if ( $(this).is(":hidden") ) {
						$(this).attr('style','');
					}
				});
			});

		},

		// Initialize Masonry
		masonryInit: function() {

			var width = document.body.clientWidth;

			// So cached selectors can be used in functions
			var self = this;

			// If body width is less than 510px we'll display as a single column
			if ( width <= 510 ) {

				// If screen has been resized to below 510, remove masonry.
				// This ensures "Load More" button loads properly.
				if ( self.cache.masonryLoaded ) {
					self.cache.$main.masonry().masonry('destroy');
				}

				return;
			}

			var gutter = 30;

			// If body width is between 510px and 880px, we'll have a smaller gutter
			if ( document.body.clientWidth <= 790 ) {
				gutter = 20;
			}

			// Initialize
			this.cache.$main.imagesLoaded( function() {
				self.cache.$main.find('.hentry').css({ 'margin-right' : 0 });
				self.cache.$main.masonry({
					itemSelector: '.hentry',
					gutter : gutter
				});
				self.cache.masonryLoaded = true;
			});

		},

		/**
		 * Debounce function.
		 *
		 * @since  1.0.0
		 * @link http://remysharp.com/2010/07/21/throttling-function-calls
		 *
		 * @return void
		 */
		debounce: function(fn, delay) {
			var timer = null;
			return function () {
				var context = this, args = arguments;
				clearTimeout(timer);
				timer = setTimeout(function () {
					fn.apply(context, args);
				}, delay);
			};
		}

 	};

 	visual.init();

 })(jQuery);