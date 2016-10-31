var x = document.getElementsByTagName("html")[0].getAttribute("dir");
console.log(x);
if ( x == 'rtl') {
    jQuery('.grid').isotope({
        // options
        itemSelector: '.grid-item',
        layoutMode: 'masonry',
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: '.grid-sizer',
            percentPosition: true,
            originLeft: false
        }
    });

// bind filter button click
    jQuery('.filters-button-group').on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        $grid.isotope({ filter: filterValue });
    });
// change is-checked class on buttons
    jQuery('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
        });
    });
    console.log('originLeft: false');
} else {
    console.log('originLeft: true');
    jQuery('.grid').isotope({
        // options
        itemSelector: '.grid-item',
        layoutMode: 'masonry',
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: '.grid-sizer',
            percentPosition: true
        }
    });

// bind filter button click
    jQuery('.filters-button-group').on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        $grid.isotope({ filter: filterValue });
    });
// change is-checked class on buttons
    jQuery('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
        });
    });
    console.log('originLeft: true');
}

/*
var $grid = jQuery('.grid').isotope({
    // options
    itemSelector: '.grid-item',
    layoutMode: 'masonry'
});

// bind filter button click
jQuery('.filters-button-group').on( 'click', 'button', function() {
    var filterValue = $( this ).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[ filterValue ] || filterValue;
    $grid.isotope({ filter: filterValue });
});
// change is-checked class on buttons
jQuery('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
    });
});
    */