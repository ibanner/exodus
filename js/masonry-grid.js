( function( $ ) {

    $(document).ready(function () {

        var x = document.getElementsByTagName("html")[0].getAttribute("dir"),
            $grid = $('.alm-masonry'),
            $masonryInit = '{ "itemSelector": ".grid-item", "columnWidth": ".grid-item", "percentPosition": true,  "resizesContainer": true';

        // console.log(x);

        if ( x == 'rtl') {
            $masonryInit += ', "originLeft": false';
        }

        $masonryInit += ' }';

        // console.log($masonryInit);

        // $grid.attr("data-masonry", $masonryInit );

    });

    var $footer = $('footer.page-foot'),
        $f_pos = $footer.position(),
        $f_top = $f_pos.top,
        $win_h = $(window).height();

    $(window).scroll(function() {

        $footer.addClass('scroll-fix');

        /*if ($(this).scrollTop() >= $win_h) {
            $footer.addClass('scroll-fix');
        } else {
            $footer.removeClass('scroll-fix');
        }*/
    });
})(jQuery);