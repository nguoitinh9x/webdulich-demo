$(".owl-customer").owlCarousel({
    autoplayHoverPause:1,
    loop:1,
    nav:1,
    dots:1,
    margin:10,
    lazyLoad:1,
    autoplay:1,
    setTimeout:3000,
    smartSpeed:1500,
    fluidSpeed:1500,
    responsive:{
        0:{
            items:1
        },
        424:{
            items:2
        },
        992:{
            margin:50,
            items:3
        }
    }
});
