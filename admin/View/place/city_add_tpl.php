<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=place&act=man_country"><span>Tỉnh thành</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<form name="supplier" id="validate" class="form" action="index.html?com=place&act=save_city&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="Assets/images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>
		
		<div class="formRow">
			<label>Tên</label>
			<div class="formRight">
                <input type="text" name="name" title="Nhập tên tỉnh thành" id="name" class="tipS validate[required]" value="<?=@$item['name']?>" />
			</div>
			<div class="clear"></div>
		</div>		        
             
        <div class="formRow">
          <label>Tùy chọn: <img src="Assets/images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">          
            <input type="checkbox" name="shows" id="check1" value="1" <?=(!isset($item['shows']) || $item['shows']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['number'])?$item['number']:1?>" name="number" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
			
        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="id" id="id_this_place" value="<?=@$item['id']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>		
		
	</div>
</form>   