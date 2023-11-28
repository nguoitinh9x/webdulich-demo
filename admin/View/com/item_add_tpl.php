<div class="wrapper">

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=com&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm com</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>



<form name="frm"  class="form"  method="post" action="index.php?com=com&act=save" enctype="multipart/form-data" class="nhaplieu">
<div class="widget">
	<div class="formRow">
		<label>Tên :</label>
		<div class="formRight">
        	<input type="text" name="ten" value="<?=$item['ten']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Com :</label>
		<div class="formRight">
        	<input type="text" name="ten_com" value="<?=$item['ten_com']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Act :</label>
		<div class="formRight">
        	<input type="text" name="act" value="<?=$item['act']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Type :</label>
		<div class="formRight">
        	<input type="text" name="type" value="<?=$item['type']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Danh mục :</label>
		<div class="formRight">
        	<input type="checkbox" name="danhmuc" <?=(!isset($item['danhmuc']) || $item['danhmuc']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div class="formRow">
		<label>Số thứ tự :</label>
		<div class="formRight">
        	<input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px">
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Hiển thị :</label>
		<div class="formRight">
        	<input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div>
       	
	<div class="formRow">
	<label></label>
	<div class="formRight">
		<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
		<input type="submit" value="Lưu"  class="button blueB" />
		<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=com&act=man'" class="button blueB" />
	</div>
	<div class="clear"></div>
	</div>
</div>
</form>