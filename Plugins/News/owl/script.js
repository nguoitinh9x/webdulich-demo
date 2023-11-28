$(".owl-news").owlCarousel({
    autoplayHoverPause: 1,
    loop: 0,
    margin: 20,
    dots: 0,
    nav: 0,
    lazyLoad: 1,
    autoplay: 1,
    setTimeout: 3000,
    smartSpeed: 1500,
    fluidSpeed: 1500,
    responsive: {
        0: {
            items: 1
        },
        425: {
            items: 2
        },
        768: {
            items: 3
        },
        922: {
            items: 2
        },
        1024: {
            items: 2
        }
    }
});