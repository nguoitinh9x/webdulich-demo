$(document).ready(function() {
    $(".owl-cs").owlCarousel({
        autoplayHoverPause: 1,
        loop: 0,
        margin: 20,
        nav: 0,
        dots: 0,
        lazyLoad: 1,
        autoplay: 1,
        setTimeout: 5000,
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
          992: {
              items: 4
          }
      }
  });
});