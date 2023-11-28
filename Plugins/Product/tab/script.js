$(".owl-prod").owlCarousel({
	autoplayHoverPause:1,
	loop:1,
	margin:30,
	dots:1,
	lazyLoad:1,
	autoplay:1,
	setTimeout:3000,
	smartSpeed:1500,
	fluidSpeed:1500,
	responsive:{
		0:{
			items:1,
			nav:0
		},
		424:{
			items:2,
			nav:0
		},
		576:{
			nav:1
		},
		992:{
			items:3,
			nav:1
		},
		1200:{
			items:4,
			nav:1
		}
	}
});