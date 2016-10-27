var x = document.getElementsByTagName("html")[0].getAttribute("dir");
console.log(x);
if ( x == 'rtl') {
    jQuery('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        originLeft: false

    });
    console.log('originLeft: false');
} else {
    jQuery('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });
    console.log('originLeft: true');
}