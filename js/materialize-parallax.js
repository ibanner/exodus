/**
 * File materialize-parallax.js.
 *
 */

( function( $ ) {

    $(document).ready(function(){
        $('.parallax').parallax();
        $('.filter-group.type button').click(function(){
            var header = $( 'header.parallax-container' );
            if ( ! header.hasClass('init-state') ) {
                // console.log("Header already fixed.");
            } else {
                $('body, html').animate({scrollTop:2},{scrollTop:-2});
                header.removeClass('init-state');
                // console.log("Class 'init-state' removed.");
            }
        });
    });

} )( jQuery );
