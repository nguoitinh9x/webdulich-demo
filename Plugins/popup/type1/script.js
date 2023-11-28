setTimeout(function() {
	$("#popup").fadeIn();
	$heightP = $(".popup").height();
	$heightW = $(window).height();
	console.log($heightW);
	console.log($heightP);
	if ($heightW > $heightP) {
		if ($heightW - $heightP > 120) {
			$(".popup").css({
				"height": $heightP,
				"top": ($heightW - $heightP) / 2
			});
		} else {
			$(".popup").css({
				"height": $heightW - 120,
				"top": "60px"
			});
		}
	} else {
		$(".popup").css({
			"height": $heightW - 120,
			"top": "60px"
		});
	}
}, 500);
$("#popup .close_popup").click(function() {
	$("#popup").remove();
});