<?php
	$quyenhang = $db->query("select name,id,color from #_permission order by number,id desc");
?>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=user&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm thành viên</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="frm"  class="form"  method="post" action="index.html?com=user&act=save" enctype="multipart/form-data" class="nhaplieu">
<div class="widget">
	<div class="formRow">
		<label>Loại</label>
		<div class="formRight">
	      <select id="role" name="role" class="main_select">
	      	<option value="">Chọn loại </option>
	      	<option value="1" <?php if($item['role']==1) { echo 'selected="selected"';}?>> User</option>
	      	<option value="3" <?php if($item['role']==3) { echo 'selected="selected"';}?>>Admin</option>
	      </select>
      	</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tên đăng nhập :</label>
		<div class="formRight">
        	<input type="text" name="username" id="username" value="<?=$item['username']?>" class="input" <?php if($_GET['act']=='edit'){?> readonly="readonly"<?php } ?>  />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Mật khẩu :</label>
		<div class="formRight">
        	<input type="password" name="oldpassword" id="oldpassword" value="" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Email :</label>
		<div class="formRight">
        	<input type="text" name="email" id="email" value="<?=$item['email']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Họ tên :</label>
		<div class="formRight">
        	<input type="text" name="name" id="name" value="<?=$item['name']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Điện thoại :</label>
		<div class="formRight">
        	<input type="text" name="phone" value="<?=$item['phone']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Địa chỉ :</label>
		<div class="formRight">
        	<input type="text" name="address" id="address" value="<?=$item['address']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Quyền Đăng Nhập :</label>
		<div class="formRight">
        	<?php for($i=0;$i<count($quyenhang);$i++){?>
		    <p><label><input type="radio" name="permission" value="<?=$quyenhang[$i]['id']?>" <?php if($item['permission'] == $quyenhang[$i]['id']){?> checked="checked"<?php } ?> /> <span style="color:<?=$quyenhang[$i]['color']?>"><?=$quyenhang[$i]['name']?></span></label></p><div class="clear"></div>
		    <?php } ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Số thứ tự :</label>
		<div class="formRight">
        	<input type="text" name="number" value="<?=isset($item['number'])?$item['number']:1?>" style="width:30px">
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Hiển thị :</label>
		<div class="formRight">
        	<input type="checkbox" name="shows" <?=(!isset($item['shows']) || $item['shows']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div>
       	
	<div class="formRow">
	<label></label>
	<div class="formRight">
		<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
		<input type="submit" value="Lưu"  class="button blueB" />
		<input type="button" value="Thoát" onclick="javascript:window.location='index.html?com=user&act=man'" class="button blueB" />
	</div>
	<div class="clear"></div>
	</div>
</div>
</form>