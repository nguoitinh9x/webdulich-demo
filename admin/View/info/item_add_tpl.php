<form name="supplier" id="validate" class="form" action="index.html?com=info&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

	<div class="control_frm" style="margin-top:25px;">
	    <div class="bc">
	        <ul id="breadcrumbs" class="breadcrumbs">
	        	<li><a href="index.html?com=info&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Cập nhật <?=$title_main?></span></a></li>
	        </ul>
	        <div class="clear"></div>
	    </div>
	</div>

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
		<div class="formRow">
			<label>Hình Hiện Tại :</label>
			<div class="formRight">
			
			<div class="mt10"><img src="<?=_upload_hinhanh.$item['thumb']?>"  alt="NO PHOTO" width="100" /></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if(in_array('images',$config_open)){ ?>
	        <div class="formRow">
		      <label>Hình ảnh kèm theo: </label>
		      <div class="formRight">
		        <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="Assets/images/image_add.png" alt="" width="100"></a>                
		        <?php if(count($ds_photo)!=0){?>       
		            <?php for($i=0;$i<count($ds_photo);$i++){?>
		              <div class="item_trich">
	                  <img class="img_trich" width="140px" height="110px" src="<?=_upload_cate.$ds_photo[$i]['photo']?>" />
	                  <input type="text" data-table="cate_photo" data-type="stt" data-id="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['number']?>" class="update_stt tipS" />
	                  <a class="delete_images" data-table="cate_photo" data-url="<?=_upload_cate;?>" data-id="<?=$ds_photo[$i]['id']?>"><img src="Assets/images/delete.png"></a>
	              </div>
		            <?php } ?>
		        <?php }?>
		    </div>
	          <div class="clear"></div>
	        </div> 
        <?php } ?>

		<?php if(in_array('name',$config_open)){
		foreach ($config['lang'] as $key => $value) {?>
        <div class="formRow lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
			<label>Tiêu đề (<?=$value?>)</label>
			<div class="formRight">
                <input type="text" name="name_<?=$key?>" title="Nhập tên (<?=$value?>)" id="name_<?=$key?>" class="tipS validate[required]" value="<?=@$item['name_'.$key]?>" />
			</div>
			<div class="clear"></div>
		</div>
		<?php } } ?>

		<?php if(in_array('description',$config_open)){ ?>
		<?php foreach ($config['lang'] as $key => $value) {?>
		<div class="formRow lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
			<label>Mô tả (<?=$value?>)</label>
			<div class="formRight">
                <textarea rows="10" cols="" title="Nhập mô tả (<?=$value?>) . " class="tipS" name="description_<?=$key?>"><?=@$item['description_'.$key]?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		<?php } } ?>

		<?php if(in_array('attributes',$config_open)){ $thongtin = json_decode($item['attributes'],true);?>
			<div class="formRow">
				<label>Link youtube</label>
				<div class="formRight">
					<input type="text" name="attributes[youtube]" title="Nhập năm kinh nghiệm" class="tipS validate[required]" value="<?=$thongtin['youtube']?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>

        <?php if(in_array('content',$config_open)){ ?>
		<?php foreach ($config['lang'] as $key => $value) {?>
		<div class="formRow lang_hidden lang_<?=$key?> <?php if($config['activelang']==$key){ echo "active";}?>">
			<label>Nội Dung (<?=$value?>)</label>
			<div class="ck_editor">
                <textarea id="content_<?=$key?>" name="content_<?=$key?>"><?=@$item['content_'.$key]?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		<?php } } ?>


		<div class="formRow">
          <label>Hiển thị : <img src="Assets/images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
            <input type="checkbox" name="shows" id="check1" value="1" <?=(!isset($item['shows']) || $item['shows']==1)?'checked="checked"':''?> />
              <input type="text" class="tipS" value="<?=isset($item['number'])?$item['number']:1?>" name="number" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>


	<div class="widget">
		<?php if(in_array('seo',$config_open)){ ?>
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
				<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho sản phẩm" class="tipS" />
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
		<?php } ?>
		
		<div class="formRow">
			<div class="formRight">
                <input type="hidden" name="id_cat" id="id_this_product" value="<?=@$item['id_cat']?>" />
            	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>   

<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>