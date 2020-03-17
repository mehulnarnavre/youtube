/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.logo-text' ).html( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-logo, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				// Check if the text color has been removed and use default colors in theme stylesheet.				
				$( '.site-logo, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-branding, .site-branding a, .site-description, .site-description a' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});


    


	jQuery('.accordion-section-title').eq(0).after('<a style="position: relative;padding: 5px 44px;bottom: 0px;background: #e74c3c;color: #ffffff;text-decoration: none;font-size: 14px;line-height: 30px;width: 100%;font-weight: 700;letter-spacing: 2px;" href="https://themeforest.net/item/videostories-responsive-video-wordpress-theme-for-marketers/20828897?ref=jewel_theme" target="_blank">Upgrade to PRO Version</a>');
	// jQuery('.accordion-section-title').eq(0).css('padding-bottom','35px');
	
} )( jQuery );
