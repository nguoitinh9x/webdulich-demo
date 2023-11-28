$(".owl-prod").owlCarousel({
    autoplayHoverPause: 1,
    loop: 0,
    margin: 10,
    dots: 0,
    nav: 1,
    lazyLoad: 1,
    autoplay: 1,
    setTimeout: 3000,
    smartSpeed: 1500,
    fluidSpeed: 1500,
    responsive: {
        0: {
            items: 3
        },
        576: {
            items: 4
        }
    }
});

$("#boxProd .items .img").hover(function() {
    var id = $(this).data('key');
    $("#boxProd .items .details").removeClass('active');
    $("#boxProd .items .this-" + id).addClass('active');
}, function() {
    $("#boxProd .items .details").removeClass('active');
});