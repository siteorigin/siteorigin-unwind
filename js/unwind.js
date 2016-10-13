/**
 * File unwind.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function($){

	// no-js Body Class.
	$('body.no-js').removeClass('no-js');
	if( $('body').hasClass('css3-animations') ) {

		var resetMenu = function(){
			$('.main-navigation ul ul').each( function(){
				var $$ = $(this);
				var width = Math.max.apply(Math, $$.find('> li > a').map( function(){ return $(this).width(); } ).get());
				$$.find('> li > a').width( width );
			} );
		};
		resetMenu();
		$(window).resize( resetMenu );

	}

	// Featured posts slider.
	$( window ).load( function() {
		$( '.featured-posts-slider' ).flexslider( {
			animation: "slide",
			controlNav: false
		} );
	} );	

	// Fullscreen search.
	$( '#search-button' ).click( function(e) {
		e.preventDefault();
		var $$ = $(this);
		$$.toggleClass( 'close-search' );

		$( "input[type='search']" ).each( function () { $(this).attr( 'size', $(this).attr( 'placeholder' ).length ); } );

		var fullscreenSearch = function() {
			vpw = $( window ).width();
			vph = $( window ).height();
			$( '#fullscreen-search' ).css( { 'height': vph - 60 + 'px', 'width': vpw + 'px' } );
		};
		fullscreenSearch();
		$( window ).resize( fullscreenSearch );

		$( '#fullscreen-search' ).slideToggle( 'fast' );

		$( '#fullscreen-search input' ).focus();

	} );

	// Close fullscreen search with escape key.
	$( document ).keyup( function(e) {
		if ( e.keyCode == 27 ) { // escape key maps to keycode `27`
			$( '#search-button.close-search' ).trigger( 'click' );
		}
	} );

	// Mobile menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function(e){
		e.preventDefault();
		var $$ = $(this);
		$$.toggleClass( 'to-close' );
		var $mobileMenuDiv = $( '#mobile-navigation' );

		if( $mobileMenu === false ) {
			$mobileMenu = $mobileMenuDiv
				.append( $( '.main-navigation ul' ).first().clone())
				.appendTo( $mobileMenuDiv ).hide();
		}

		$mobileMenu.slideToggle( 'fast' );

		$mobileMenuDiv.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );
		$mobileMenuDiv.find( '.menu-item-has-children a' ).width('100%');
		$mobileMenuDiv.find( '.dropdown-toggle' ).click( function( e ) {
			e.preventDefault();
			$( this ).next( '.children, .sub-menu' ).slideToggle( 'fast' );
		} );
	} );

	// Sticky menu.
	if( $('.top-bar').hasClass('sticky-menu') && !$('body').hasClass('is-mobile') ) {
		var $tbs = false,
			pageTop = $('#page').offset().top,
			$tb = $('.top-bar');

		var smSetup = function () {
			pageTop = $('#page').offset().top;

			if ($tbs === false) {
				$tbs = $('<div class="top-bar-sentinel"></div>').insertAfter($tb);
			}


			var top  = window.pageYOffset || document.documentElement.scrollTop;
			$tb.css({
				'position': 'relative',
				'top': 0,
				'left': 0,
				'width': null,
			});

			var adminBarOffset = $('#wpadminbar').css('position') === 'fixed' ? $('#wpadminbar').outerHeight() : 0;

			if( top + adminBarOffset > $tb.offset().top ) {

				$tbs.show().css({
					'height': $tb.outerHeight(),
					'margin-bottom' : $tb.css('margin-bottom')
				});
				$tb.css({
					'position': 'fixed',
					'top': adminBarOffset,
					'left': 0 - self.pageXOffset+'px',
					'width': '100%',
				});
			}
			else {
				$tbs.hide();
			}
		};
		smSetup();
		$(window).resize( smSetup ).scroll( smSetup );

	}

} );
