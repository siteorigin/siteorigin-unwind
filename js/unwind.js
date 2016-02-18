/* globals jQuery */

jQuery( function($){

	// Remove the no-js body class
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

	// Handle displaying the mobile menu
	var $mobileMenu = false;
	$('#mobile-menu-button').click( function(e){
		e.preventDefault();
		var $$ = $(this);
		$$.toggleClass('to-close');
		var $mobileMenuDiv = $('#mobile-navigation');

		if( $mobileMenu === false ) {
			$mobileMenu = $mobileMenuDiv
				.append($('.main-navigation ul').first().clone())
				.appendTo($mobileMenuDiv).hide();
		}

		$mobileMenu.slideToggle('fast');

		$mobileMenuDiv.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );
		$mobileMenuDiv.find( '.menu-item-has-children a' ).width('100%');
		$mobileMenuDiv.find( '.dropdown-toggle' ).click( function( e ) {
			e.preventDefault();
			$( this ).next( '.children, .sub-menu' ).slideToggle('fast');
		} );
	} );

} );
