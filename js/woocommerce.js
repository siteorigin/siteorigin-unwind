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

	function triggerQuantityButtons() {
		$('table.shop_table, .product form.cart').each(function(i, el) {
			quantityButtons(el);
		});
	}

	triggerQuantityButtons();

	$('table.shop_table').removeClass('shop_table_responsive');

	// Product images slider.
	$( window ).load( function() {
		$( '.product-images-carousel' ).flexslider( {
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 100,
			itemMargin: 20,
			maxItems: 4,
			asNavFor: '.product-images-slider'
		} );
		$( '.product-images-slider' ).flexslider( {
			animation: "slide",
			animationLoop: false,
			slideshow: false,
			controlNav: false,
			directionNav: false
		} );
	} );

} );
