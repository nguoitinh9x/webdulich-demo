<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=video&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=video&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($config['lang'] as $key => $value) {?>
						<li><a href="<?=$key?>" class="<?php if($config['activelang']==$key){ echo "active";}?> tipS" title="Chọn <?=$value?>"><img src="Assets/images/<?=$key?>.png" /><?=$value?></a></li>
					<?php } ?>
				</ul>
			</div>	
			<?php if(in_array('image',$config_open)){ ?>
				<div class="formRow">
					<label>Tải hình ảnh:</label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="Assets/images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">
							<div class="mt10"><img src="<?=_upload_video.$item['thumb']?>"  alt="NO PHOTO" width="<?=_width_thumb/2?>" /></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } } ?>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Video Hiện Tại :</label>
						<div class="formRight">
							<object width="300" height="200"><param name="movie" value="//www.youtube.com/v/<?=$func->youtobi($item['link'])?>?version=3&amp;hl=vi_VN&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/<?=$func->youtobi($item['link'])?>?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="300" height="200" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" ></embed></object>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
				<?php foreach ($config['lang'] as $key => $value) {?>
					<div class="formRow lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
						<label>Tiêu đề (<?=$value?>)</label>
						<div class="formRight">
							<input type="text" name="name_<?=$key?>" title="Nhập tên (<?=$value?>)" id="name_<?=$key?>" class="tipS validate[required]" value="<?=@$item['name_'.$key]?>" />
						</div>
						<div class="clear"></div>
					</div>
				<?php }  ?>
				<div class="formRow">
					<label>Links ( Youtobe )</label>
					<div class="formRight">
						<input type="text" name="link" title="Nhập tên link youtobe" id="link" class="tipS validate[required]" value="<?=@$item['link']?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label>Hiển thị : <img src="Assets/images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
					<div class="formRight">
						<input type="checkbox" name="shows" id="check1" value="1" <?=(!isset($item['shows']) || $item['shows']==1)?'checked="checked"':''?> />
						<label>Số thứ tự : </label>
						<input type="text" class="tipS" value="<?=isset($item['number'])?$item['number']:1?>" name="number" style="width:35px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
					</div>
					<div class="clear"></div>
				</div>
			</div>  
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
						<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho danh mục" class="tipS" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label>Description:</label>
					<div class="formRight">
						<textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description"><?=@$item['description']?></textarea>
						<input readonly="readonly" type="text" style="width:30px; margin-top:10px; text-align:center;" name="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="formRight">
						<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
						<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
						<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
						<a href="index.php?com=video&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</form>
	</div>