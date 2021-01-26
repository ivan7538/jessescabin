/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    var style = $( '#aquentro-color-scheme-css' ),
        api = wp.customize;
    if ( ! style.length ) {
        style = $( 'head' ).append( '<style type="text/css" id="aquentro-color-scheme-css" />' )
            .find( '#aquentro-color-scheme-css' );
    }
	// Site title and description.
    api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
    api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

    // Color Scheme CSS.
    api.bind( 'preview-ready', function() {
        api.preview.bind( 'update-color-scheme-css', function( css ) {
            style.html( css );
        } );
    } );
    api( 'aquentro_footer_text', function (value) {
       value.bind(function (to) {
           $('.site-info .wrapper').html(to);
       });
    });

    api( 'aquentro_footer_image', function (value) {
       value.bind(function (to) {
       	    var image = $('.site-info .footer-bg');

			if(!to.trim()){
			   image.remove();
			}

       	    if (image.length !== 0){
       	    	image.attr('src', to);
            } else {
       	    	$('.site-info').prepend('<img src="'+to+'" class="footer-bg" alt="footer-background">')
            }
       });
    });

	api( 'aquentro_footer_padding_top', function (value) {
		value.bind(function (to) {
			$('.site-footer').css('paddingTop', to + 'px');
			$(window).trigger('resize');
		});
	});

	api( 'aquentro_footer_padding_bottom', function (value) {
		value.bind(function (to) {
			$('.site-footer').css('paddingBottom', to + 'px');
			$(window).trigger('resize');
		});
	});

} )( jQuery );
