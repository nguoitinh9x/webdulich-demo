<script>
	$(document).ready(function(e) {
		$('#ok').click(function(){
			$('#load').css({visibility: "visible"});
		});    
    });
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=product&amp;act=man_cat"><span>Nhập file excel</span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<div class="widget">
  <div class="title">
    <h6>Nhập danh sách sản phẩm từ excel</h6>
  </div>
  <div style="padding:10px;">
<form name="form1" id="from1" action="index.php?com=excel&act=save_import" method="post" enctype="multipart/form-data" class="nhaplieu">
    <input type="file" name="linkfile"  size="25" maxlength="255"  /> <strong style="margin-left:20px;">Loại : .xls (Ms.Excel 2003)</strong><br /><br />
     <input type="submit" name="ok" id="ok" value="Upload" />
</form>
<div id="load"></div>
<h3><?=$thongbao?></h3>
    </div>
    </div>
