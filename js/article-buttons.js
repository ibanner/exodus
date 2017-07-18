/**
 * File article-buttons.js.
 */

( function( $ ) {

    function toggleSharing() {
        $('#sharing-buttons').toggleClass('hide');
        $('#article-buttons').toggleClass('hide');
    }

    $('#sharing-main').click(toggleSharing);
    $('#sharing-cancel').click(toggleSharing);

} )( jQuery );