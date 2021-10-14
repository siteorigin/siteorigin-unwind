/**
 * File unwind.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// no-js Body Class.
	$ ( 'body.no-js' ).removeClass( 'no-js' );

	// Check if an element is visible in the viewport.
	$.fn.unwindIsVisible = function() {
		return ( this[0].getBoundingClientRect().top >= 0 );
	};

	// Check if element is are overlapping the wp admin bar.
	$.fn.unwindAdminIsVisible = function() {
		// Admin bar is sticky on desktop, and not on mobile so we may need to run a different check.
		if ( $( 'body' ).innerWidth() > 600) {
			return ( $( '#wpadminbar' )[0].getBoundingClientRect().bottom < this[0].getBoundingClientRect().top );
		} else {
			return ( $( '#wpadminbar' )[0].getBoundingClientRect().bottom >= 0 );
		}
	};

	// Featured posts slider.
	$( document ).ready( function() {
		if ( typeof $.fn.flexslider == 'function' ) {
			$( '.featured-posts-slider' ).flexslider( {
				animation: "slide",
				controlNav: false
			} );
			$( '.gallery-format-slider' ).flexslider( {
				animation: "slide"
			} );
		}
	} );

	// Setup FitVids for entry content, video post formats, SiteOrigin panels and WooCommerce pages. Ignore Tableau.
	if ( typeof $.fn.fitVids !== 'undefined' ) {
		$( '.entry-content, .entry-content .panel, .entry-video, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
	}

	// Fullscreen search.
	$( '#search-button' ).on( 'click', function( e ) {
		e.preventDefault();
		var $$ = $( this );
		$$.toggleClass( 'close-search' );

		$( "input[type='search']" ).each( function () { $( this ).attr( 'size', $( this ).attr( 'placeholder' ).length ); } );

		var fullscreenSearch = function() {
			var vpw = $( window ).width(),
				vph = $( window ).height(),
				tb = $( '.top-bar' ),
				tbpos = tb.position().top + tb.outerHeight();
			$( '#fullscreen-search' ).css( { 'top': tbpos + 'px', 'height': vph - tbpos + 'px', 'width': vpw + 'px' } );
		};
		fullscreenSearch();
		$( window ).on( 'resize', fullscreenSearch );

		// Disable scrolling when fullscreen search is open.
		if ( $$.hasClass( 'close-search' ) ) {
			$( 'body' ).css( 'margin-right', ( window.innerWidth - $( 'body' ).width() ) + 'px' );
			$( 'body' ).css( 'overflow', 'hidden' );
		} else {
			$( 'body' ).css( 'overflow', '' );
			$( 'body' ).css( 'margin-right', '' );
		}

		$( '#fullscreen-search' ).slideToggle( 'fast' );

		$( '#fullscreen-search input' ).trigger( 'focus' );

	} );

	$( '#fullscreen-search-form' ).on( 'submit', function() {
		$(this).find( 'button svg' ).hide();
		$(this).find( 'button svg:last-child' ).show();
	} );

	// Close fullscreen search with escape key.
	$( document ).on( 'keyup', function( e ) {
		if ( e.keyCode == 27 ) { // Escape key maps to keycode `27`.
			$( '#search-button.close-search' ).trigger( 'click' );
		}
	} );

	// Mobile menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).on( 'click', function( e ) {
		e.preventDefault();

		$( '#search-button.close-search' ).trigger( 'click' );

		var $$ = $(this);
		$$.toggleClass( 'to-close' );
		var $mobileMenuDiv = $( '#mobile-navigation' );

		if ( $mobileMenu === false ) {
			$mobileMenu = $mobileMenuDiv
				.append( $( '.main-navigation ul' ).first().clone() )
				.appendTo( $mobileMenuDiv ).hide();
		}

		if ( $( '.main-navigation .shopping-cart' ).length && ! $mobileMenuDiv.find( '.shopping-cart-link' ).length ) {
			$mobileMenu.append( $( '.main-navigation .shopping-cart .shopping-cart-link' ).clone() );
		}

		$mobileMenu.slideToggle( 'fast' );

		$mobileMenu.find( '.menu-item-has-children > a:not(.has-dropdown-button)' ).addClass( 'has-dropdown-button' ).after( '<button class="dropdown-toggle" aria-expanded="false"><svg version="1.1" class="svg-icon-submenu" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg></button>' );

		$mobileMenu.find( '.menu-item-has-children a' ).width('100%');
	} );

	$( '#mobile-navigation' ).on( 'click', '.dropdown-toggle', function( e ) {
		e.preventDefault();
		$( this ).next( 'ul' ).slideToggle( '300ms' );
		
		if ( $( this ).attr( 'aria-expanded' ) == 'false' ) {
			$( this ).attr( 'aria-expanded', 'true' )
		} else {
			$( this ).attr( 'aria-expanded', 'false' )
		}
	} );

	$( '#mobile-navigation' ).on( 'click', '.has-dropdown-button', function( e ) {
		if ( typeof $( this ).attr( 'href' ) === "undefined" || $( this ).attr( 'href' ) == "#" ) {
			e.preventDefault();
			$( this ).siblings( 'ul' ).slideToggle( '300ms' );

			if ( $( this ).siblings( '.dropdown-toggle' ).attr( 'aria-expanded' ) == 'false' ) {
				$( this ).siblings( '.dropdown-toggle' ).attr( 'aria-expanded', 'true' )
			} else {
				$( this ).siblings( '.dropdown-toggle' ).attr( 'aria-expanded', 'false' )
			}
		}
	} );

	$( '#mobile-navigation' ).on( 'click', '.menu-item a[href*="#"]:not([href="#"])', function() {
		$mobileMenu.slideToggle( 'fast' );
	} );

	// Scroll to top.
	var sttWindowScroll = function () {
		var top = window.pageYOffset || document.documentElement.scrollTop;
		var scrollOffset = $( '#masthead' ).length ? $( '#masthead' ).outerHeight() : $( window ).outerHeight() / 2;

		if ( top > scrollOffset ) {
			if ( ! $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'auto' ).addClass( 'show' );
			}
		} else if ( $( '#scroll-to-top' ).hasClass( 'show' ) ) {
			$( '#scroll-to-top' ).css( 'pointer-events', 'none' ).removeClass( 'show' );
		}
	};
	sttWindowScroll();
	$( window ).on( 'scroll', sttWindowScroll );
	$( '#scroll-to-top' ).on( 'click', function() {
		$( 'html, body' ).animate( { scrollTop: 0 } );
	} );

	// Sticky menu.
	if ( $( '.sticky-bar' ).hasClass( 'sticky-menu' ) ) {
		var $sbs = false,
			tbTop = false,
			pageTop = $( '#page' ).offset().top,
			$sb = $( '.sticky-bar' ),
			$mh = $( '#masthead' ),
			$wpab = $( '#wpadminbar' );
			$sbh = $sb.outerHeight();

		var smSetup = function() {

			if ( $sbs === false ) {
				$sbs = $( '<div class="sticky-bar-sentinel"></div>' ).insertBefore( $sb );
			}
			// Toggle .topbar-out with visibility of top-bar in the viewport
			if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				if ( ! $sbs.unwindAdminIsVisible() ) {
					$( 'body' ).addClass( 'sticky-bar-out' );
				}
				if ( $( 'body' ).hasClass( 'sticky-bar-out' ) && $sbs.unwindAdminIsVisible() ) {
					$( 'body' ).removeClass( 'sticky-bar-out' );
				}
			} else {
				if ( ! $sbs.unwindIsVisible() ) {
					$( 'body' ).addClass( 'sticky-bar-out' );
				}
				if ( $( 'body' ).hasClass( 'sticky-bar-out' ) && $sbs.unwindIsVisible() ) {
					$( 'body' ).removeClass( 'sticky-bar-out' );
				}
			}

			if ( $( 'body' ).hasClass( 'sticky-bar-out' ) ) {
				$('.sticky-bar-sentinel').height( $sbh );
			} else {
				$('.sticky-bar-sentinel').height( 0 );
			}
		}
		smSetup();

		$( window ).on( 'resize scroll', smSetup );
	}

	// Detect if is a touch device. We detect this through ontouchstart, msMaxTouchPoints and MaxTouchPoints.
	if ( 'ontouchstart' in document.documentElement || window.navigator.msMaxTouchPoints || window.navigator.MaxTouchPoints ) {
		if ( /iPad|iPhone|iPod/.test( navigator.userAgent ) && ! window.MSStream ) {
			$( 'body' ).css( 'cursor', 'pointer' );
			$( 'body' ).addClass( 'ios' );
		}

		$( '.main-navigation #primary-menu' ).find( '.menu-item-has-children > a' ).each( function() {
			$( this ).on( 'click touchend', function( e ) {
				var link = $( this );
				e.stopPropagation();
				
				if ( e.type == 'click' ) {
					return;
				}

				if ( ! link.parent().hasClass( 'hover' ) ) {
					// Remove .hover from all other sub menus
					$( '.menu-item.hover' ).removeClass( 'hover' );
					link.parents('.menu-item').addClass( 'hover' );
					e.preventDefault();
				}

				// Remove .hover class when user clicks outside of sub menu
				$( document ).one( 'click', function() {
					link.parent().removeClass( 'hover' );
				} );

			} );
		} );
	}

	// Setup the load more button in portfolio widget loop if there's a portfolio loop present on the page.
	if ( $( '#portfolio-loop' ).length ) {
		$infinite_scroll = 0;
		$( document.body ).on( 'post-load', function() {
			var $container = $( '#portfolio-loop' );

			$infinite_scroll = $infinite_scroll + 1;
			var $container = $( '#projects-container' ),
				$selector = $( '#infinite-view-' + $infinite_scroll ),
				$elements = $selector.find( '.jetpack-portfolio.post' );

			$elements.hide();
			$container.append( $elements ).isotope( 'appended', $elements );
		} );
	}
  
} );

( function( $ ) {
	$( window ).on( 'load', function() {

		// Handle masonry blog layout.
		if ( $( '.blog-layout-masonry' ).length ) {
			$( '.blog-layout-masonry' ).masonry( {
				itemSelector: '.archive-entry',
				columnWidth: '.archive-entry',
				horizontalOrder: true
			} );
		}

		// Portfolio loop filter.
		var $container = $( '#projects-container' );
		if ( $( '.portfolio-filter-terms' ).length ) {
			$container.isotope( {
				itemSelector: '.post',
				filter: '*',
				layoutMode: 'fitRows',
				resizable: true,
			} );
		}

		$( '.portfolio-filter-terms button' ).on( 'click', function() {
			var selector = $( this ).attr( 'data-filter' );
			$container.isotope( {
				filter: selector,
			} );
			$( '.portfolio-filter-terms button' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
			return false;
		} );

	} );

} )( jQuery );
