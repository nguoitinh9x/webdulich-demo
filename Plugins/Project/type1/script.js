function loadData(page, idl) {
    $.ajax({
        type: "POST",
        url: "Ajax/tab/index.php",
        data: {page: page,idl: idl},
        success: function(result) {
            $("#show_product").html(result);
        }
    });
}

$('.choose_idl').first().addClass('active');
var idl = $('.choose_idl').first().attr('data-idl');
loadData(1, idl);

$("#project").on("click", ".choose_idl", function() {
    var has = $('.choose_idl').hasClass('active');
    if (has == true) {
        $('.choose_idl').removeClass('active');
        $(this).addClass('active');
    }
    var page = 1;
    var idl = $(this).attr('data-idl');
    loadData(page, idl);
});

$("#show_product").on("click", ".ajax_pagination li", function() {
    var page = $(this).attr("p");
    var idl = $(this).parents("#show_product").find('.row').attr("data-idl");

    loadData(page, idl);
});
