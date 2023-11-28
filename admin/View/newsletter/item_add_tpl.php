<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="#" onclick="return false;">Nội dung</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.html?com=newsletter&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<?php if($item['name']) : ?>
				<div class="formRow">
					<label>Họ Tên :</label>
					<div class="formRight">
						<?=@$item['name']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['email']) : ?>
				<div class="formRow">
					<label>Email :</label>
					<div class="formRight">
						<?=@$item['email']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['phone']) : ?>
				<div class="formRow">
					<label>Điện thoại :</label>
					<div class="formRight">
						<?=@$item['phone']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['address']) : ?>
				<div class="formRow">
					<label>Địa chỉ :</label>
					<div class="formRight">
						<?=@$item['address']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['content']) : ?>
				<div class="formRow">
					<label>Nội dung :</label>
					<div class="formRight">
						<?=@$item['content']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<?php if($item['date']) : ?>
				<div class="formRow">
					<label>Khung giờ :</label>
					<div class="formRight">
						<?=@$item['date']?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<div class="formRow">
				<label>Ghi chú :</label>
				<div class="formRight">
					<textarea rows="4" cols="" title="Nhập Ghi chú ." class="tipS" name="note"><?=@$item['note']?></textarea>
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
					<a href="index.html?com=newsletter&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>
</div>
