$('#ser_onl .label_serv_onl').click(function(){
	$('#ser_onl .cont_serv_onl').slideToggle();
	if($(this).hasClass("active")){
		$(this).removeClass("active");
	}
	else {
		$(this).addClass("active");
	}
});