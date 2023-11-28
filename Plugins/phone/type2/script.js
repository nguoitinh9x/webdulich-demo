$('.support-content').hide();
$('a.btn-support').click(function(e){
  e.stopPropagation();
  $('.support-content').slideToggle();
});
$('.support-content').click(function(e){
  e.stopPropagation();
});
$(document).click(function(){
  $('.support-content').slideUp();
});