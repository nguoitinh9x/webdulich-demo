<h3>Hinh ảnh</h3>

<form name="frm" method="post" action="index.php?com=product&act=save_photo&idc=<?=$_REQUEST['idc']?>" enctype="multipart/form-data" class="nhaplieu">

<?php for($i=0; $i<5; $i++){?>
	
	<b>Hình ảnh <?=$i+1?></b> <input type="file" name="file<?=$i?>" /> <?=_hinhanh_type?><br />	       
<b>Số thứ tự </b> <input type="text" name="stt<?=$i?>" value="1" style="width:30px" />	<br />
	<b>Hiển thị</b> <input type="checkbox" name="hienthi<?=$i?>" checked="checked" /> <br /><br />
	
<? }?>
	
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=product&act=man_photo'" class="btn" />
</form>