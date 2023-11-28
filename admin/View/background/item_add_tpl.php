<form name="supplier" id="validate" class="form" action="index.php?com=background&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">

		<div class="control_frm" style="margin-top:25px;">
			<div class="bc">
				<ul id="breadcrumbs" class="breadcrumbs">
					<li><a href="index.php?com=bgweb&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Cập nhật <?=$title_main?></span></a></li>
				</ul>
				<div class="clear"></div>
			</div>
		</div> 
		
		<?php if(in_array('image',$config_open)){ ?>
		<div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
				<input type="file" id="file" name="file" />
				<img src="Assets/images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<span class="note">width : <?php echo _width_thumb*$ratio_;?>px  - Height : <?php echo _height_thumb*$ratio_;?>px</span>
			</div>

			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Hình Hiện Tại :</label>
			<div class="formRight">
				<div class="mt10"><img src="<?=_upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" width="100" /></div>
				<a href="index.php?com=background&act=capnhat&xoaanh=xoaanh<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="Assets/images/icons/dark/close.png" /></a><br />
			</div>

			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<?php if(in_array('color',$config_open)){ ?>
		<div class="formRow">
			<label>Backgrourd-color:</label>
			<div class="formRight">
				<input type="text" class="color" name="bgcolor" title="Nhập màu nền" class="tipS validate[required]" value="<?=@$item['bgcolor']?>" size="15" />
			</div>

			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if(in_array('colors',$config_open)){ ?>
		<div class="formRow">
			<label>Repeat:</label>
			<div class="formRight">
				<label><input type="radio" name="re_peat" title="no-repeat" value="no-repeat" <?php if($item['re_peat']=="no-repeat"){?> checked="checked"<?php } ?>/> No-repeat</label>
				<label><input type="radio" name="re_peat" title="repeat-x" value="repeat-x" <?php if($item['re_peat']=="repeat-x"){?> checked="checked"<?php } ?>/> repeat-x</label>
				<label><input type="radio" name="re_peat" title="repeat-y" value="repeat-y" <?php if($item['re_peat']=="repeat-y"){?> checked="checked"<?php } ?>/>repeat-y</label>
				<label><input type="radio" name="re_peat" title="repeat" value="repeat" <?php if($item['re_peat']=="repeat"){?> checked="checked"<?php } ?>/>repeat</label>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Fixed:</label>
			<div class="formRight">
				<label><input type="checkbox" title="fixed" name="fix_bg" value="fixed" <?php if($item['fix_bg']=="fixed"){?> checked="checked"<?php } ?> /> fixed</label>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Position:</label>
			<div class="formRight">
				Cách Top : <input type="text" placeholder="Ex : 10px" name="waytop" title="Nhập vị trí" value="<?=@$item['waytop']?>" size="3" style="width:100px;" /> 
				Cách Left : <input type="text" placeholder="Ex : 10px" name="wayleft" title="Nhập vị trí" value="<?=@$item['wayleft']?>" size="3" style="width:100px;" />
				Cách Right : <input type="text" placeholder="Ex : 10px" name="wayright" title="Nhập vị trí" value="<?=@$item['wayright']?>" size="3" style="width:100px;" />
				Cách Bottom : <input type="text" placeholder="Ex : 10px" name="waybottom" title="Nhập vị trí" value="<?=@$item['waybottom']?>" size="3" style="width:100px;" />
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<div class="formRow">
			<label>Hiển thị : <img src="Assets/images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
			<div class="formRight">
				<input type="checkbox" name="shows" id="check1" value="1" <?=(!isset($item['shows']) || $item['shows']==1)?'checked="checked"':''?> />
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="widget">
		
		<div class="formRow">
			<div class="formRight">
				<input type="hidden" name="id_cat" id="id_this_product" value="<?=@$item['id_cat']?>" />
				<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>   