$("a.btn-support").click(function(t) {
	t.stopPropagation(), $(".support-content").slideToggle()
}), $(".support-content").click(function(t) {
	t.stopPropagation()
}), $(document).click(function() {
	$(".support-content").slideUp()
});
