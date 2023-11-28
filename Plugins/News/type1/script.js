$(".owl-sell").owlCarousel({
    autoplayHoverPause: 1,
    loop: 0,
    margin: 20,
    dots: 0,
    nav: 1,
    lazyLoad: 1,
    autoplay: 1,
    setTimeout: 3000,
    smartSpeed: 1500,
    fluidSpeed: 1500,
    responsive: {
        0: {
            items: 1
        },
        576: {
            items: 2
        },
        992: {
            items: 3
        },
        1200: {
            items: 4
        }
    }
});