( function( $ ) {
	wp.customize( 'hero_heading', function( value ) {
		value.bind( function( to ) {
			$( '#hero-heading' ).text( to );
		} );
	} );

	wp.customize( 'hero_text', function( value ) {
		value.bind( function( to ) {
			$( '#hero-text' ).text( to );
		} );
	} );

	wp.customize( 'hero_button_primary', function( value ) {
		value.bind( function( to ) {
			$( '#hero-button-primary' ).text( to );
		} );
	} );

	wp.customize( 'hero_button_secondary', function( value ) {
		value.bind( function( to ) {
			$( '#hero-button-secondary' ).text( to );
		} );
	} );

	wp.customize( 'about_heading', function( value ) {
		value.bind( function( to ) {
			$( '#about-heading, #menu-item-about a' ).text( to );
		} );
	} );

	wp.customize( 'about_text', function( value ) {
		value.bind( function( to ) {
			$( '#about-text' ).text( to );
		} );
	} );

	wp.customize( 'testimonials_heading', function( value ) {
		value.bind( function( to ) {
			$( '#testimonials-heading, #menu-item-testimonials a' ).text( to );
		} );
	} );

	wp.customize( 'recognitions_heading', function( value ) {
		value.bind( function( to ) {
			$( '#recognitions-heading, #menu-item-recognitions a' ).text( to );
		} );
	} );

	wp.customize( 'services_heading', function( value ) {
		value.bind( function( to ) {
			$( '#services-heading, #menu-item-services a' ).text( to );
		} );
	} );

	wp.customize( 'gallery_heading', function( value ) {
		value.bind( function( to ) {
			$( '#gallery-heading, #menu-item-gallery a' ).text( to );
		} );
	} );

	wp.customize( 'contact_heading', function( value ) {
		value.bind( function( to ) {
			$( '#contact-heading, #menu-item-contact a' ).text( to );
		} );
	} );

	wp.customize( 'contact_text', function( value ) {
		value.bind( function( to ) {
			$( '#contact-text' ).text( to );
		} );
	} );

	wp.customize( 'address', function( value ) {
		value.bind( function( to ) {
			$( '#address-text' ).text( to );
		} );
	} );

	wp.customize( 'phone', function( value ) {
		value.bind( function( to ) {
			$( '#phone-text' ).text( to );
		} );
	} );

	wp.customize( 'email', function( value ) {
		value.bind( function( to ) {
			$( '#email-text' ).text( to );
		} );
	} );

	wp.customize( 'social_heading', function( value ) {
		value.bind( function( to ) {
			$( '#social-heading' ).text( to );
		} );
	} );
} )( jQuery );