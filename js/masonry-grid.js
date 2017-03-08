var x = document.getElementsByTagName("html")[0].getAttribute("dir");
// console.log(x);
if ( x == 'rtl') {
    jQuery('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-item',
        percentPosition: true,
        originLeft: false,
        resizesContainer: true


    });
    // console.log('originLeft: false');
} else {
    jQuery('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-item',
        percentPosition: true,
        resizesContainer: true
    });
    // console.log('originLeft: true');
}