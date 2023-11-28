function submitsearch(frm) {
	var timkiem = $(frm).parents('form').find('input[name="keywords"]').val();
	if (!timkiem) {
		alert('Bạn chưa nhập từ khóa tìm kiếm !');
		$('#inputSearch').focus();
	} else {
		window.location.href = "tim-kiem/&keywords=" + timkiem;
	}
	return false;
}