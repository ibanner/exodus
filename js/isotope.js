var $grid = jQuery('.grid').isotope({
        itemSelector: '.grid-item'
    });

// store filter for each group
var filters = {};
var filterLabel = '';
var currentFilter ='';

    jQuery('.filter-group').on( 'click', 'a', function() {
    var $this = jQuery(this);
    // get group key
    var $buttonGroup = $this.parents('.filter-group');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[ filterGroup ] = $this.attr('data-filter');
    // combine filters
    var filterValue = concatValues( filters );
    // Retrieve filter label text
    filterLabel = $this.attr('title');
    // construct selector for current filter label element
    currentFilter = '.current-filter-' + filterGroup;
    // change current filter label text
    $buttonGroup.find(currentFilter).html(filterLabel);
    // set filter for Isotope
    $grid.isotope({ filter: filterValue });
    console.log('filterGroup', filterGroup);
});


// bind filter button click
jQuery('.filter-group').on( 'click', 'a', function() {
    var filterValue = jQuery(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
    console.log('currentFilter', currentFilter);
});

// change active class on buttons
jQuery('.filter-group').each( function( i, buttonGroup ) {
    var $buttonGroup = jQuery( buttonGroup );
    $buttonGroup.on( 'click', 'a', function() {
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