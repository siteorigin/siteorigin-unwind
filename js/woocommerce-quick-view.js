jQuery( function( $ ) {

	// Quick View Modal.
	$( '.product-quick-view-button' ).click( function( e ) {
		e.preventDefault();

		var $container = '#quick-view-container';
		var $content = '#product-quick-view';

		var id = $( this ).attr( 'data-product-id' );

		$.post(
			so_unwind_data.ajaxurl,
			{ action: 'so_product_quick_view', product_id: id },
			function( data ) {
				$( document ).find( $container ).find( $content ).html(data);
				$( document ).find( '#product-quick-view .cart' ).triggerQuantityButtons();
				$( document ).find( '#product-quick-view .variations_form' ).wc_variation_form();
				$( document ).find( '#product-quick-view .variations_form' ).trigger( 'check_variations' );
				$( so_unwind_data.chevron_down ).insertAfter( '#product-quick-view .variations_form select' );
			}
		);

		$( document ).ajaxComplete( function () {
			if ( $.isFunction( $.fn.flexslider ) ) {
				$( '.product-images-slider' ).flexslider( {
					animation: "slide",
					animationLoop: true,
					slideshow: false,
					controlNav: true,
					directionNav: true,
				} );
			}
		} );

		if ( $( document ).find( $container ).is( ':hidden' ) ) {
			$( document ).find( $container ).find( $content ).empty();
		}

		$( document ).find( $container ).fadeIn( 300 );

		// Disable scrolling when quick view is open.
		$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
		$( 'body' ).css( 'overflow', 'hidden' );

		$( window ).mouseup( function( e ) {
			var container = $( $content );
			if ( ( ! container.is( e.target ) && container.has( e.target ).length === 0 ) || $( '.quickview-close-icon' ).is( e.target ) ) {
				$( $container ).fadeOut( 300 );
				// Enable scrolling.
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );

		$( document ).keyup( function( e ) {
			var container = $($content);
			if ( e.keyCode == 27 ) { // Escape key maps to keycode `27`.
				$( $container ).fadeOut( 300 );
				// Enable scrolling.
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );

	} );

} );