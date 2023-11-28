$(document).ready(function() {
	$(".owl-videos").owlCarousel({
		loop: 1,
		margin: 0,
		nav: 0,
		dots: 0,
		lazyLoad: 0,
		autoplay: 1,
		setTimeout: 3e3,
		smartSpeed: 1500,
		fluidSpeed: 1500,
		items: 1
	});
	$(".videos .fancybox").fancybox();
});