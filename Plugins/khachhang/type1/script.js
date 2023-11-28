$('.OwlCustomers').owlCarousel({
   loop: 1,
   nav: 1,
   dots: 0,
   lazyLoad: 0,
   autoplay: 0,
   setTimeout: 5e3,
   smartSpeed: 500,
   fluidSpeed: 500,
   center: 1,
   responsive: {
       0: {
           items: 1,
           margin: 0
       },
       576: {
           items: 3,
           margin: 10
       },
       768: {
           margin: 80
       },
       992: {
           margin: 100
       }
   }
});