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

} );
