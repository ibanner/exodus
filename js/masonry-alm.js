jQuery(function() {
    var masonryInit = true; // set Masonry init flag
    jQuery.fn.almComplete = function(alm){ // Ajax Load More callback function
        if(jQuery('#masonry-grid').length){
            var $container = jQuery('#masonry-grid ul'); // our container
            if(masonryInit){
                // initialize Masonry only once
                masonryInit = false;
                $container.masonry({
                    itemSelector: '.grid-item',
                    columnWidth: '.grid-item',
                    percentPosition: true,
                    resizesContainer: true
                });
            }else{
                $container.masonry('reloadItems'); // Reload masonry items after callback
            }
            $container.imagesLoaded( function() { // When images are loaded, fire masonry again.
                $container.masonry();
            });
        }
    };
});