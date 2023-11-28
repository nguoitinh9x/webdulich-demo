function submitsearch(frm){
	var keywords = $(frm).parents('form').find('input[name="keywords"]').val();
	var listid = $(frm).parents('form').find('#listid').val();

	if (!keywords && listid=='') {
		alert('Bạn chưa nhập từ khóa tìm kiếm !');
		$('#inputSearch').focus();
	} else {
		window.location.href = "tim-kiem/&idl=" + listid + "&keywords=" + keywords;
	}
	return false;
}