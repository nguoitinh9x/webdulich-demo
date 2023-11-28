$(document).ready(function() {
	$(".owlvideos").owlCarousel({
		loop: !0,
		margin: 10,
		nav: !0,
		dots: !1,
		lazyLoad: 0,
		autoplay: !0,
		setTimeout: 3e3,
		smartSpeed: 1500,
		fluidSpeed: 1500,
		responsive: {
			0: {
				items: 3
			},
			576: {
				items: 4
			},
			992: {
				items: 3
			}
		}
	});

	$('.ivideos a').click(function(event) {
		var dat = $(this).data();
		$('.mastervideo img').attr('src', dat.src);
		$('.mastervideo a').attr('href', dat.href);
	});
	$(".videos .fancybox").fancybox();
});