$(".owl-prod").owlCarousel({
	autoplayHoverPause: 1,
	loop: 0,
	margin: 0,
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
		425: {
			items: 2
		},
		768: {
			items: 3
		},
		992: {
			items: 4
		},
		1200: {
			items: 5
		}
	}
});