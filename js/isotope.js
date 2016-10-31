var $grid = jQuery('.grid').isotope({
        itemSelector: '.grid-item'
    });

// store filter for each group
var filters = {};

jQuery('.sub-cats').on( 'click', '.button', function() {
    var $this = jQuery(this);
    // get group key
    var $buttonGroup = $this.parents('.button-group');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[ filterGroup ] = $this.attr('data-filter');
    // combine filters
    var filterValue = concatValues( filters );
    // set filter for Isotope
    $grid.isotope({ filter: filterValue });
});


/* bind filter button click
jQuery('.filter-button-group').on( 'click', 'button', function() {
    var filterValue = jQuery(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
}); */

// change active class on buttons
jQuery('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = jQuery( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.active').removeClass('active');
        jQuery( this ).addClass('active');
        $buttonGroup.prop("aria-pressed", false);
        jQuery( this ).prop("aria-pressed", true);
        // TODO Fix the "aria-pressed" property change
    });
});

// flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
        value += obj[ prop ];
    }
    return value;
}