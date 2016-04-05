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

	$('table.shop_table').each(function(i, el) {
		quantityButtons(el);
	});
} );
