<?php
	$thongtin = json_decode($item['attributes'],true);
?>
<script>		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.html?com=setting&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<form name="supplier" id="validate" class="form" action="index.html?com=setting&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title chonngonngu">
			<ul>
				<?php foreach ($config['lang'] as $key => $value): ?>
					<li><a href="<?=$key?>" class="<?php if($config['activelang']==$key){ echo "active";}?> tipS" title="Chọn <?=$value?>"><img src="Assets/images/<?=$key?>.png" /><?=$value?></a></li>
				<?php endforeach ?>
			</ul>
		</div>

		<?php foreach ($config['lang'] as $key => $value): ?>
			<div class="formRow w50 lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
				<label>Tên Công Ty</label>
				<div class="formRight">
					<input type="text" name="shortname_<?=$key?>" title="Nhập tên công ty (<?=$value?>)" id="shortname_<?=$key?>" class="tipS validate[required]" value="<?=@$item['shortname_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach ?>

		<?php foreach ($config['lang'] as $key => $value): ?>
			<div class="formRow w50 lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
				<label>Tên đầy đủ</label>
				<div class="formRight">
					<input type="text" name="name_<?=$key?>" title="Nhập tên công ty (<?=$value?>)" id="name_<?=$key?>" class="tipS validate[required]" value="<?=@$item['name_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach ?>

	    <?php foreach ($config['lang'] as $key => $value): ?>
			<div class="formRow w50 lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
				<label>Slogan</label>
				<div class="formRight">
					<input type="text" name="slogan_<?=$key?>" title="Nhập slogan (<?=$value?>)" id="slogan_<?=$key?>" class="tipS" value="<?=@$item['slogan_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach ?>

		<div class="formRow w50">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ email" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>Hotline</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hotline']?>" name="hotline" title="Nhập hotline" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<!-- 
		<div class="formRow w50">
			<label>Tổng đài</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['calling']?>" name="calling" title="Nhập calling" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>Email 2</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['mailer']?>" name="mailer" title="Nhập địa chỉ email" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		-->
		<div class="formRow w50">
			<label>Zalo</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['zalo']?>" name="zalo" title="Nhập số zalo" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['phone']?>" name="phone" title="Nhập số điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<?php foreach ($config['lang'] as $key => $value): ?>
			<div class="formRow w50 lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
				<label>Địa chỉ</label>
				<div class="formRight">
					<input type="text" name="address_<?=$key?>" title="Nhập địa chỉ (<?=$value?>)" id="address_<?=$key?>" class="tipS validate[required]" value="<?=@$item['address_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach ?>	

		<div class="formRow w50">
			<label>Website</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['website']?>" name="website" title="Nhập địa chỉ website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow w50">
			<label>Giờ làm việc</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['timelive']?>" name="timelive" title="Nhập thời gian làm việc" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>Google Plus</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['googleplus']?>" name="googleplus" title="Nhập link google plus" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>Twitter</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['twitter']?>" name="twitter" title="Nhập link twitter" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<!-- 
		<div class="formRow w50">
			<label>Chi nhánh</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['chinhanh']?>" name="chinhanh" title="Nhập địa chỉ chi nhánh" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow w50">
			<label>Giờ mở cửa</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['opentime']?>" name="opentime" title="Nhập giờ mở cửa" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>Hổ trợ khách hàng</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['support_phone']?>" name="support_phone" title="Hổ trợ khách hàng" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>App ID Facebook</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['idfacebook']?>" name="idfacebook" title="ID facebook" class="tipS" />
			</div>
			<div class="clear"></div>
		</div> -->
		
		<div class="formRow w50">
			<label>Link google map</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['keymap']?>" name="keymap" title="Link google map" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow w50">
			<label>FanPage Facebook</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['facebook']?>" name="facebook" title="Nhập link fanpage facebook" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>


		<?php if($config['setup']['dongdau']['active']=='true'): ?>
			<div class="formRow w50">
				<label>Đóng dấu ảnh</label>
				<div class="formRight">
					<div class="mt10"><img src="../Upload/watermark.png"  alt="NO PHOTO" width="285" /></div><br>
					<input type="file" id="dongdau" name="dongdau" />
					<div class="note">Width : 285 px , Height : 100 px</div>
				</div>
				<div class="clear"></div>
			</div>
		<?php endif ?>
	</div>
	

<?php /*?> 	<div class="widget">
		<div class="title"><img src="Assets/images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Vận chuyển (GIAO HÀNG TIẾT KIỆM)</h6>
		</div>			
		<div class="formRow">
			<label>Token</label>
			<div class="formRight">
				<input type="text" value="<?=$thongtin['token']?>" name="thongtin[token]" title="Mã token nhà vận chuyển" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<h5 style="text-align: center; margin: 1em 0">THÔNG TIN KHO HÀNG LẤY</h5>

		<div class="formRow">
			<label>Tỉnh thành</label>
			<div class="formRight">
				<input type="text" value="<?=$thongtin['city']?>" name="thongtin[city]" title="Tỉnh thành" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Quận huyện</label>
			<div class="formRight">
				<input type="text" value="<?=$thongtin['dist']?>" name="thongtin[dist]" title="Quận huyện" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
				<input type="text" value="<?=$thongtin['addr']?>" name="thongtin[addr]" title="Địa chỉ" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
	</div> <?php */?>

	<div class="widget">
		<div class="title"><img src="Assets/images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Nội dung seo</h6>
		</div>
		<div class="formRow">
			<label>Title</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title']?>" name="title" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Từ khóa</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Description:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description"><?=@$item['description']?></textarea>
				<input readonly="readonly" type="text" style="width:30px; margin-top:10px; text-align:center;" name="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 160 ký tự)</b>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Code <xmp><head></xmp> : </label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Code trong thẻ head" class="tipS" name="codehead"><?=@$item['codehead']?></textarea>
				<div class="note">Ex : Analytics , Facebook ,google , meta  ...v... </div>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Code <xmp><Body></xmp> :</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Code trong thẻ body" class="tipS" name="codebody"><?=@$item['codebody']?></textarea>
				<div class="note">Ex : .... </div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Code <xmp><Bottom></xmp> :</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Code dưới Bottom" class="tipS" name="codebottom"><?=@$item['codebottom']?></textarea>
				<div class="note">Ex : chat , ad , visitor.... </div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Code <xmp><MAP></xmp> :</label>
			<div class="formRight">
				<textarea rows="6" cols="" title="Nhập iframe map" class="tipS" name="location_map"><?=@$item['location_map']?></textarea>
				<div class="note">Ex : Nhúng bản đồ , google map , iframe.... </div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<div class="formRight">
				<input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
				<input type="submit" class="blueB"  value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div> 			
	</div>
</form>   