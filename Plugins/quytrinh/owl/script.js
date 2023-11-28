$(".owl-quytrinh").owlCarousel({
	autoplayHoverPause:1,
	loop:0,
	margin:80,
	nav:0,
	dots:0,
	lazyLoad:1,
	autoplay:1,
	setTimeout:3000,
	smartSpeed:1500,
	fluidSpeed:1500,
	responsive:{
		0:{
			items:1
		},
		375:{
			items:2
		},
		576:{
			items:3
		},
		992:{
			items:4,
			margin:130
		}
	}
});