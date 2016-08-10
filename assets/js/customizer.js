/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'wp_git_homepage_profile_name', function( value ) {
		value.bind( function( to ) {
			$( '.user-fullname' ).text( to );
		} );
	} );

	wp.customize( 'wp_git_homepage_username', function( value ) {
		value.bind( function( to ) {
			$( '.user-username' ).text( to );
		} );
	} );

	wp.customize( 'wp_git_homepage_bio', function( value ) {
		value.bind( function( to ) {
			$( '.user-bio' ).text( to );
		} );
	} );

	wp.customize( 'wp_git_homepage_bio', function( value ) {
		value.bind( function( to ) {
			$( '.user-bio' ).text( to );
		} );
	} );

	wp.customize('wp_git_homepage_company', function (value) {
		value.bind(function (to) {
			$('.wp_git_company').text(to);
		});
	});

	wp.customize('wp_git_homepage_location', function (value) {
		value.bind(function (to) {
			$('.wp_git_location').text(to);
		});
	});

	wp.customize('wp_git_homepage_email', function (value) {
		value.bind(function (to) {
			if(to == ''){
				$('.wp_git_email').parent('li').hide();
			}else{
				$('.wp_git_email').parent('li').show();
			}

			$('.wp_git_email').text(to);
			$('.wp_git_email').attr('href', 'mailto:' + to);
		});
	});

	wp.customize('wp_git_homepage_url', function (value) {
		value.bind(function (to) {
			if(to == ''){
				$('.wp_git_url').parent('li').hide();
			}else{
				$('.wp_git_url').parent('li').show();
			}

			$('.wp_git_url').text(to);
			$('.wp_git_url').attr('href', to);
		});
	});

	wp.customize('wp_git_homepage_date', function (value) {
		value.bind(function (to) {
			if(to == ''){
				$('.wp_git_date').parent('li').hide();
			}else{
				$('.wp_git_date').parent('li').show();
			}
			$('.wp_git_date').text(to);
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
