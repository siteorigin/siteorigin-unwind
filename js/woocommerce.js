jQuery( function($){

	function quantityButtons( element ) {

		// Add the Add and Subtract buttons
		$(element)
		.find('.quantity:not(.button-controls)')
		.addClass('button-controls')
		.prepend('<input type="button" value="-" class="subtract" />')
		.append('<input type="button" value="+" class="add" />');

		$(element).on('click', '.add, .subtract', function() {

			// Get values from the number input field
			var $quantity = $(this).closest('.quantity').find('.qty'),
				value = parseFloat($quantity.val()),
				max = parseFloat($quantity.attr('max')),
				min = parseFloat($quantity.attr('min')),
				step = $quantity.attr('step');

			// Change the value
			if ($(this).is('.add')) {
				if ( value >= max ) {
					$quantity.val(max);
				} else {
					$quantity.val(value + parseFloat(step));
				}
			} else if ($(this).is('.subtract')) {
				if ( value <= min ) {
					$quantity.val(min);
				} else if (value > 0) {
					$quantity.val(value - parseFloat(step));
				}
			}

			// Trigger change event
			$quantity.trigger('change');
		});

	}

	$.fn.triggerQuantityButtons = function() {
		return this.each( function(i, el) {
			quantityButtons(el);
		});
	}

	$('table.shop_table, .product form.cart').triggerQuantityButtons();

	$( document ).on( 'updated_cart_totals', function(){
		$('table.shop_table, .product form.cart').triggerQuantityButtons();
	});

	$('table.shop_table').removeClass('shop_table_responsive');

	// Convert the dropdown
	$('.woocommerce-ordering select').each( function(){
		var $$ = $(this);

		var c = $('<div></div>')
			.html( '<span class="current">' + $$.find(':selected').html() + '</span>' + so_unwind_data.chevron_down )
			.addClass('ordering-selector-wrapper')
			.insertAfter( $$ );

		var dropdownContainer = $('<div/>')
			.addClass('ordering-dropdown-container')
			.appendTo(c);

		var dropdown = $('<ul></ul>')
			.addClass('ordering-dropdown')
			.appendTo(dropdownContainer);

		var widest = 0;
		$$.find( 'option' ).each( function(){
			var $o = $(this);
			dropdown.append(
				$("<li></li>")
					.html( $o.html() )
					.data( 'val', $o.attr('value') )
					.click( function(){
						$$.val( $(this).data('val') );
						$$.closest('form').submit();
					} )
			);

			widest = Math.max( c.find('.current').html( $o.html() ).width(), widest);

		} );

		c.find('.current').html( $$.find(':selected').html()).width( widest );

		$$.hide();
	} );

	// Open dropdown on click
	$( '.ordering-selector-wrapper' ).click( function() {
		$(this).toggleClass( 'open-dropdown' );
	} );

	// Closing dropdown on click outside dropdown wrapper
	$( window ).click( function(e) {
		if ( !$(e.target).closest('.ordering-selector-wrapper.open-dropdown').length ) {
			$( '.ordering-selector-wrapper.open-dropdown' ).removeClass( 'open-dropdown' );
		}
	})

	// Display variation images
	$( '.variations' ).on( 'change', 'select', function() {
		$( '.product-images-carousel' ).find( '.product-featured-image' ).click();
	} );

	//Quick View Modal
	$( '.product-quick-view-button' ).click( function(e) {
		e.preventDefault();

		var $container = '#quick-view-container';
		var $content = '#product-quick-view';

		var id = $(this).attr( 'data-product-id' );

		$.post(
			so_unwind_data.ajaxurl,
			{ action: 'so_product_quick_view', product_id: id },
			function( data ) {
				$(document).find( $container ).find( $content ).html(data);
				$(document).find( '#product-quick-view .cart' ).triggerQuantityButtons();
				$(document).find( '#product-quick-view .variations_form' ).wc_variation_form();
				$(document).find( '#product-quick-view .variations_form' ).trigger( 'check_variations' );
				$( so_unwind_data.chevron_down ).insertAfter( '#product-quick-view .variations_form select' );
			}
		);

		if( $(document).find( $container ).is(':hidden') ) {
			$(document).find( $container ).find( $content ).empty();
		}

		$(document).find($container).fadeIn(300);

		// Disable scrolling when quick view is open
		$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
		$( 'body' ).css( 'overflow', 'hidden' );

		$(window).mouseup( function (e) {
			var container = $($content);
			if ( ( !container.is(e.target) && container.has(e.target).length === 0 ) || $( '.quickview-close-icon' ).is(e.target) ) {
				$($container).fadeOut(300);
				// Enable scrolling
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		});

		$( document ).keyup( function(e) {
			var container = $($content);
			if ( e.keyCode == 27 ) { // escape key maps to keycode `27`
				$($container).fadeOut(300);
				// Enable scrolling
				$( 'body' ).css( 'overflow', '' );
				$( 'body' ).css( 'margin-right', '' );
			}
		} );

	} );

	$( so_unwind_data.chevron_down ).insertAfter( '.variations select' );

} );
