var $grid = jQuery('.grid').isotope({
        itemSelector: '.grid-item'
    });

// bind filter button click
jQuery('.filter-button-group').on( 'click', 'button', function() {
    var filterValue = jQuery(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
});

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