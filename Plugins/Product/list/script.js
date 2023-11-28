function loadData(page, idl) {
    $.ajax({
        type: 'POST',
        url: 'Ajax/list/index.php',
        data: {page: page,idl: idl},
        success: function(data) {
            $('#danhmuc' + idl).html(data);
        }
    });
}


$('#boxProd .boxProd').each(function(index, el) {
    var idl = $(this).data('idl');
    var page = 1;
    loadData(page, idl);
});

$('.boxProd').on('click', '.ajax_pagination li', function() {
    var page = $(this).attr('p');
    var idl = $(this).parents('.boxProd').attr('data-idl');
    loadData(page, idl);
});