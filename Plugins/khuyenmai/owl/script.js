$(".owl-sale").owlCarousel({
    autoplayHoverPause:1,
    loop:0,
    margin:0,
    lazyLoad:1,
    autoplay:1,
    setTimeout:3000,
    smartSpeed:1500,
    fluidSpeed:1500,
    items:1,
    responsive:{
        0:{
            nav:0,
            dots:1
        },
        992:{
            nav:1,
            navText: ["<img src='images/left.png'>","<img src='images/right.png'>"],
            dots:0
        }
    }
});