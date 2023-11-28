function loadData(page, idl) {
    $.ajax({
        type: "POST",
        url: "Ajax/ajax_paging/index.php",
        data: {
            page: page,
            idl: idl
        },
        success: function(data) {
            $("#danhmuc_" + idl).html(data);
        }
    });
}
$(".showproduct").each(function(index, el) {
    var idl = $(this).data("idl");
    var page = 1;
    loadData(page, idl);
});

$(".showproduct").on("click", ".ajax_pagination li.active", function() {
    var page = $(this).attr("p");
    var idl = $(this).parents(".showproduct").attr("data-idl");
    loadData(page, idl);
});