<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.html?com=contact&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<?php if($item['name']) : ?>
				<div class="formRow">
					<label>Họ Tên : </label>
					<div class="formRight">
						<?=@$item['name']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['address']) : ?>
				<div class="formRow">
					<label>Địa chỉ : </label>
					<div class="formRight">
						<?=@$item['address']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['phone']) : ?>
				<div class="formRow">
					<label>Điện thoại : </label>
					<div class="formRight">
						<?=@$item['phone']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['email']) : ?>
				<div class="formRow">
					<label>Email : </label>
					<div class="formRight">
						<?=@$item['email']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['date']) : ?>
				<div class="formRow">
					<label>Ngày / giờ : </label>
					<div class="formRight">
						<?=@$item['date']?> - <?=@$item['time']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['title']) : ?>
				<div class="formRow">
					<label>Tour : </label>
					<div class="formRight">
						<?=@$item['title']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['content']) : ?>
				<div class="formRow">
					<label>Nội Dung : </label>
					<div class="formRight">
						<?=@$item['content']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<div class="formRow">
				<label>Ghi chú</label>
				<div class="formRight">
					<textarea rows="4" cols="" title="Nhập Ghi chú ." class="tipS" name="note"><?=@$item['note']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Hiển thị : <img src="Assets/images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
				<div class="formRight">

					<input type="checkbox" name="shows" id="check1" value="1" <?=(!isset($item['shows']) || $item['shows']==1)?'checked="checked"':''?> />
					<label>Số thứ tự: </label>
					<input type="text" class="tipS" value="<?=isset($item['number'])?$item['number']:1?>" name="number" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>

		</div>  
		<div class="widget">
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
					<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.html?com=contact&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>
</div>
