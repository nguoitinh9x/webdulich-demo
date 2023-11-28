<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link id="favicon" rel="shortcut icon" href="Assets/images/setting.png" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="csrf-token" content="<?=  $_SESSION['crsf_inc'] ?>">
	<title>Administrator - Hệ thống quản trị nội dung</title>
	<link href="Assets/css/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Assets/js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="Assets/js/external.js"></script>
	<script src="Assets/js/jquery.price_format.2.0.js" type="text/javascript"></script>
	<script src="Assets/ckeditor/ckeditor.js"></script>
	<script>CKEDITOR.dtd.$removeEmpty['span'] = false; CKEDITOR.timestamp='ABCD';</script>
	<link href="Assets/js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="Assets/js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
	<!-- MultiUpload -->
	<script type="text/javascript" src="Assets/js/plugins/multiupload/jquery.filer.min.js"></script>
	<script src="Assets/js/jquery.minicolors.js"></script>
	<link rel="stylesheet" href="Assets/css/jquery.minicolors.css">
	<!--tags product-->
	<link href="Assets/js/select-box-searching-jquery/select2.css" rel="stylesheet"/>
	<script src="Assets/js/select-box-searching-jquery/select2.js"></script>
	<script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });</script>
</head>
<body>
	<!-- Left side content -->    
	<script type="text/javascript">
		$(function(){
			var num = $('#menu').children(this).length;
			for (var index=0; index<=num; index++)
			{
				var id = $('#menu').children().eq(index).attr('id');
				$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
				$('#'+id+' .sub li:last-child').addClass('last');
			}
			$('#menu .activemenu .sub').css('display', 'block');
			$('#menu .activemenu a').removeClass('inactive');
			$('.conso').priceFormat({
				limit: 13,
				prefix: '',
				centsLimit: 0
			});
			$('.color').each( function() {
				$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					format: $(this).attr('data-format') || 'hex',
					keywords: $(this).attr('data-keywords') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					change: function(value, opacity) {
						if( !value ) return;
						if( opacity ) value += ', ' + opacity;
						if( typeof console === 'object' ) {
							console.log(value);
						}
					},
					theme: 'bootstrap'
				});
			});
		})
	</script>
	<div id="leftSide">
		<?php include VIEW."left_tpl.php";?>
	</div>
	<div id="rightSide">
		<div class="topNav">
			<?php include VIEW."header_tpl.php";?>
		</div>
		<div class="wrapper">
			<?php include VIEW.$template."_tpl.php";?>
		</div></div>
		<div class="clear"></div>
		<div id="footer"><div class="wrapper">Powered by <a href="http://www.cipmedia.vn" title="Thiết kế web CIP Media">Thiết kế web CIP Media</a></div>
	</body>
	<script>
		$(document).ready(function($) {
			$('.ck_editor').each(function(index, el) {
				var id = $(this).find('textarea').attr('id');
				CKEDITOR.replace( id, {
					height : 500,
					filebrowserUploadMethod : 'form',
					filebrowserBrowseUrl : 'Assets/ckfinder/ckfinder.html',
					filebrowserImageBrowseUrl : 'Assets/ckfinder/ckfinder.html?type=Images',
					filebrowserFlashBrowseUrl : 'Assets/ckfinder/ckfinder.html?type=Flash',
					filebrowserUploadUrl : 'Assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					filebrowserImageUploadUrl : 'Assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : 'Assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
			});	
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			/* ajax hienthi*/
			$("a.diamondToggle").click(function(){
				if($(this).attr("rel")==0){
					$.ajax({
						type: "POST",
						url: "Ajax/update.php",
						data:{
							id: $(this).attr("data-val0"),
							table: $(this).attr("data-val2"),
							type: $(this).attr("data-val3"),
							value:1
						}
					});
					$(this).addClass("diamondToggleOff");
					$(this).attr("rel",1);
				}else{
					$.ajax({
						type: "POST",
						url: "Ajax/update.php",
						data:{
							id: $(this).attr("data-val0"),
							table: $(this).attr("data-val2"),
							type: $(this).attr("data-val3"),
							value:0
						}
					});
					$(this).removeClass("diamondToggleOff");
					$(this).attr("rel",0);
				}
			});
			/*end  ajax hienthi*/
			/*select danhmuc*/
			$(".select_danhmuc").change(function() {
				var child = $(this).data("child");
				var levell = $(this).data('level');
				var table = $(this).data('table');
				var type = $(this).data('type');
				$.ajax({
					url: 'Ajax/ajax_danhmuc.php',
					type: 'POST',
					data: {level: levell,id:$(this).val(),table:table,type:type},
					success:function(data){
						var op = "<option>Chọn Danh Mục</option>";
						if(levell=='0'){
							$("#id_cat").html(op);
							$("#id_item").html(op);
							$("#id_sub").html(op);
						}else if(levell=='1'){
							$("#id_sub").html(op);
							$("#id_item").html(op);
						}else if(levell=='2'){
							$("#id_sub").html(op);
						}
						$("#"+child).html(data);
					}
				});
			});
			$('.chonngonngu li a').click(function(event) {
				var lang = $(this).attr('href');
				$('.chonngonngu li a').removeClass('active');
				$(this).addClass('active');
				$('.lang_hidden').removeClass('active');
				$('.lang_'+lang).addClass('active');
				return false;
			});
			<?php if($arr_act[0]=='add'){?>
				$("#name_vi").keyup(function() {
					getSlug();
				});
			<?php } ?>
			function getSlug(){
				var name = $('#name_vi').val();
				$.ajax({
					url: 'Ajax/ajax.php',
					type: 'POST',
					data: {act:'slug',name:name},
					success:function(data){
						$('#slug').val(data);
					}
				});
			}
			
			<?php if($arr_act[0]=='edit'){?>
				$("#slug").focusout(function() {
					edit_getSlug();
				});
			
    			function edit_getSlug(){
    				var name = $('#slug').val();
    				$.ajax({
    					url: 'Ajax/ajax.php',
    					type: 'POST',
    					data: {act:'slug',name:name},
    					success:function(data){
    						$('#slug').val(data);
    					}
    				});
    			}
    		<?php } ?>
		// $(document).on('keyup', function(event) {
  //       	var key = event.keyCode;
  //       	switch(key){
  //       		case 13:
  //       		case 121:
  //       			$('form.form').submit();
  //       		break;
  //       	}
  //       	return false;
  //      	});
  $('.update_stt').keyup(function(event) {
  	var id = $(this).data('id');
  	var table = $(this).data('table');
  	var value = $(this).val();
  	var type = $(this).data('type');
  	$.ajax ({
  		type: "POST",
  		url: "Ajax/update.php",
  		data: {id:id,table:table,value:value,type:type},
  		success: function(result) {
  		}
  	});
  });
  $('.delete_images').click(function(){
  	if (confirm('Bạn có muốn xóa hình này ko ? ')) {
  		var id = $(this).data('id');
  		var table = $(this).data('table');
  		var links = $(this).data('url');
  		$.ajax ({
  			type: "POST",
  			url: "Ajax/delete_images.php",
  			data: {id:id,table:table,links:links},
  			success: function(result) { 
  			}
  		});
  		$(this).parent().slideUp();
  	}
  	return false;
  });
  $('.soluong_input').keyup(function(event) {
  	var id = $(this).data('id');
  	var table = $(this).data('table');
  	var value = $(this).val();
  	var type = 'soluong';
  	$.ajax ({
  		type: "POST",
  		url: "Ajax/update.php",
  		data: {id:id,table:table,value:value,type:type},
  		success: function(result) {
  		}
  	});
  });
  $("#xoahet").click(function(){
  	var listid="";
  	$("input[name='chon']").each(function(){
  		if (this.checked) listid = listid+","+this.value;
  	})
	      listid=listid.substr(1);   //alert(listid);
	      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	      hoi= confirm("Bạn có chắc chắn muốn xóa?");
	      if (hoi==true) document.location = "index.html?com=<?=$_GET['com']?>&act=delete<?php if($fact){ echo '_'.$fact;}?>&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
	  });
});
function timkiem(wrap){
	var id = wrap.attr('id');
	var url = 'index.html?com=<?=$_GET['com']?>&act=<?=$_GET['act']?>&type=<?=$_GET['type']?>';
	var keywords = $('#keywords').val();
	if(id=='id_list'){
		url +="&id_list="+wrap.val(); 
	} else if(id=='id_cat'){
		var id_list = $('#id_list').val();
		url +="&id_list="+id_list+"&id_cat="+wrap.val(); 
	} else if(id=='id_item'){
		var id_list = $('#id_list').val();
		var id_cat = $('#id_cat').val();
		url +="&id_list="+id_list+"&id_cat="+id_cat+"&id_item="+wrap.val(); 
	} else if(id=='id_sub'){
		var id_list = $('#id_list').val();
		var id_cat = $('#id_cat').val();
		var id_item = $('#id_item').val();
		url +="&id_list="+id_list+"&id_cat="+id_cat+"&id_item="+id_item+"&id_sub="+wrap.val(); 
	} else if(id=='keywords'){
		var id_list = $('#id_list').val();
		var id_cat = $('#id_cat').val();
		var id_item = $('#id_item').val();
		var id_sub = $('#id_sub').val();
		if(id_list) { url +="&id_list="+id_list;}
		if(id_cat) { url +="&id_cat="+id_cat; }
		if(id_item) { url +="&id_item="+id_item; }
		if(id_sub) { url +="&id_sub="+id_sub; }
	} 
	if(keywords){
		url +="&keyword="+keywords;
	}
	window.location =url; 
}
</script>
</html>