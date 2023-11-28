<?php $attributes = json_decode($item['attributes'],true);?>
<script>		
	$(document).ready(function() {
		$('.themmoi').click(function(e) {
			$.ajax ({
				type: "POST",
				url: "Ajax/khuyenmai.php",
				success: function(result) { 
					$('.load_sp').append(result);
				}
			});
		});
		$('.delete').click(function(e) {
			$(this).parent().remove();
		});
		$("#states").select2();
        ///
        $("#states").change(function(){
        	$tags = $(this).val();
        	if($tags>0){
        		$("#tags_name").append("<p class='delete_tags'>"+$("#states option:selected").text()+"<input name='tags[]' value='"+$tags+"'  type='hidden' /> <span></span> </p>");
        	}
        	$(".delete_tags span").click(function(){
        		$(this).parent().remove();
        	});
        });
        //
        $(".delete_tags span").click(function(){
        	$(this).parent().remove();
        });
    });
</script>
<!-- style color, size -->
<style>
/*.select2-container{width:100%!important;}*/
.bl-lst{margin:0.5em 0;display:inline-flex;width:100%;align-items:center;}
.bl-left{width:20%;float:left}
.bl-right{width:80%;float:right}
input[disabled='disabled']{cursor:not-allowed;}
select.soflow,
select.soflow-color {
	-webkit-appearance: button;
	-webkit-border-radius: 2px;
	-webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
	-webkit-padding-end: 20px;
	-webkit-padding-start: 2px;
	-webkit-user-select: none;
	background-image: url('Assets/images/down.png'), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
	background-position: 97% center;
	background-repeat: no-repeat;
	border: 1px solid #AAA;
	color: #555;
	font-size: inherit;
	margin: 10px 0;
	overflow: hidden;
	padding: 5px 10px;
	text-overflow: ellipsis;
	white-space: nowrap;
	width: 100%
}
select.soflow-color {
	color: #fff;
	background-image: url('Assets/images/down.png'), -webkit-linear-gradient(#779126, #779126 40%, #779126);
	background-color: #779126;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
	padding-left: 15px
}
</style>

<?php
	//------------ tags-------------------------
	if($item['tags']!=''){
		$tags = explode(",", $item['tags']) ;
		$sql = "select id,name_vi from #_post where id<>'".$tags[0]."'  and type='tags'";
		for ($i=1,$count = count($tags); $i < $count ; $i++) { 
			$sql .=" and id<> '".$tags[$i]."' ";
		}
	} else {
		$sql = "select id,name_vi from #_post where type='tags'";
	}
	$tags_arr  =  $db->query($sql);

	$sizes  =  $db->query("select * from #_title where shows=1 and type='size' order by number asc");
	$mausacs  =  $db->query("select * from #_title where shows=1 and type='mausac' order by number asc");
	$id_items  =  $db->query("select * from #_cate_item where shows=1 and type='product' and id_cat='".$item['id_cat']."' order by number asc");
?>

<div class="wrapper">
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=product&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.html?com=product&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title chonngonngu">
		<ul>
		<?php 
		//$func->dump($config);
		foreach ($config['lang'] as $key => $value) {?>
			<li><a href="<?=$key?>" class="<?php if($config['activelang']==$key){ echo "active";}?> tipS" title="Chọn <?=$value?>"><img src="Assets/images/<?=$key?>.png" /><?=$value?></a></li>
		<?php } ?>
		</ul>
		</div>	
		<?php if(in_array('list',$config_open)){ ?>
		<div class="formRow">
			<label>Chọn danh mục 1</label>
			<div class="formRight">
			<?=$func->get_main_list()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if(in_array('cat',$config_open)){ ?>
		<div class="formRow">
			<label>Chọn danh mục 2</label>
			<div class="formRight">
			<?=$func->get_main_cat()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if(in_array('item',$config_open)){ ?>
        <div class="formRow">
			<label>Chọn danh mục 3</label>
			<div class="formRight">
			<?=$func->get_main_item($item)?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

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
			<div class="mt10"><img src="<?=_upload_product.$item['photo']?>"  alt="NO PHOTO" width="100" /></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php } } ?>
		
        <?php if(in_array('images',$config_open)){ ?>
         <div class="formRow">
	      <label>Hình ảnh kèm theo :</label>
	      <div class="formRight">
	        <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="Assets/images/image_add.png" alt="" width="100"></a>                
	    	<?php if($act=='edit'){?>
	        <?php if(count($ds_photo)!=0){?>       
	            <?php for($i=0;$i<count($ds_photo);$i++){?>
	              <div class="item_trich">
	                  <img class="img_trich" width="140px" height="110px" src="<?=_upload_cate.$ds_photo[$i]['photo']?>" />
	                  <input type="text" data-table="cate_photo" data-type="stt" data-id="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['number']?>" class="update_stt tipS" />
						<?php if(in_array('color',$config_open)){ ?>
	                	<select name="id_mausac[]" class="id_mausac update_color" rel="9" >
	                  		<option value="">Chọn màu sắc</option>
	                  	<?php
		                  	$mausac = $attributes['mausac'];
		                  	for($k=0;$k<count($mausacs);$k++){?>
	                  		<option value="<?=$k?>" <?php if(is_array($mausac)){if(in_array($mausacs[$k]['id'],$mausac)){ echo "selected='selected'";} }?>><?=$mausacs[$k]['name_vi']?></option>
	                  	<?php } ?>
	                	</select>
	                	<?php } ?>

	                  <a class="delete_images" data-table="cate_photo" data-url="<?=_upload_cate;?>" data-id="<?=$ds_photo[$i]['id']?>"><img src="Assets/images/delete.png"></a>
	              </div>
	            <?php } ?>
	        <?php }?>
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

		<div class="formRow">
			<label>Slug</label>
			<div class="formRight">
                <input type="text" name="slug" title="Nhập Link web" id="slug" class="tipS validate[required]" value="<?=@$item['slug']?>" />
                <p id="getnewslug"></p>
			</div>
			<div class="clear"></div>
		</div>

		<?php if(in_array('price',$config_open)){ ?>
		<div class="formRow">
			<label>Giá bán</label>
			<div class="formRight">
                <input type="text" name="price" title="Nhập giá bán" id="price" class="conso tipS validate[required]" value="<?=@$item['price']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if(in_array('oldprice',$config_open)){ ?>
		<div class="formRow">
			<label>Giá cũ</label>
			<div class="formRight">
                <input type="text" name="oldprice" title="Nhập giá cũ" id="oldprice" class="conso tipS validate[required]" value="<?=@$item['oldprice']?>" />
			</div>
			<div class="clear"></div>
		</div> 
		<?php } ?>

		<?php if(in_array('code',$config_open)){ ?>
		<div class="formRow">
			<label>Mã SP  </label>
			<div class="formRight">
                <input type="text" name="code" title="Nhập mã sản phẩm" id="code" class="tipS" value="<?=@$item['code']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if(in_array('mass',$config_open)){ ?>
		<div class="formRow">
			<label>Khối lượng (gram)  </label>
			<div class="formRight">
                <input type="text" name="mass" title="Nhập khối lượng sản phẩm" id="mass" class="tipS" value="<?=@$item['mass']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<?php if(in_array('tags',$config_open)){ ?>
		<div class="formRow">
			<label>Tags </label>
			<div class="formRight">
            	<select style="width:300px" id="states">
            		<option value="0">
            			Thêm Tags 
            		</option>
            		<?php for ($i=0,$countt = count($tags_arr); $i < $countt ; $i++) { ?>
            			<option value="<?=$tags_arr[$i]["id"]?>"><?=$tags_arr[$i]["name_vi"]?></option>
            		<?php }?>
            	</select>
            	<div class="clear"></div>
            	<div id="tags_name">
            	<?php  for ($i=0,$count = count($tags); $i < $count ; $i++) { 
        			$tags_name= $db->row("select id,name_vi from #_post where id='".$tags[$i]."' and type='tags' ");
        			?>
        				<p value="<?=$tags_name["id"]?>" class="delete_tags"><?=$tags_name["name_vi"]?> <span ></span> 
        					<input name="tags[]" value="<?=$tags_name["id"]?>"  type="hidden" />
        				</p>
        				
        		<?php }?>
        		</div>
            </div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<?php if(in_array('size',$config_open)){ ?>
		<div class="formRow">
			<label>Size</label>
			<div class="formRight">
			<?php
				$size = $attributes['size'];
				for($i=0;$i<count($sizes);$i++){?>
	            <label><input type="checkbox" name="attributes[size][]" id="size<?=$i?>" value="size_<?=$sizes[$i]['id']?>" <?php if(is_array($size)){if(in_array('size_'.$sizes[$i]['id'],$size)){ echo "checked='checked'";} }?> /> <?=$sizes[$i]['name_vi']?></label>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if(in_array('color',$config_open)){ ?>
		<div class="formRow">
			<label>Màu sắc</label>
			<div class="formRight">
			<?php
			 	$mausac = $attributes['mausac'];
				for($i=0;$i<count($mausacs);$i++){?>
	                <label><input type="checkbox" name="attributes[mausac][]" id="mausac<?=$i?>" value="mausac_<?=$mausacs[$i]['id']?>" <?php if(is_array($mausac)){if(in_array('mausac_'.$mausacs[$i]['id'], $mausac)){ echo "checked='checked'";}}?> /> <?=$mausacs[$i]['name_vi']?></label>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

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
             <label>Số thứ tự: </label>
              <input type="text" class="tipS" value="<?=isset($item['number'])?$item['number']:1?>" name="number" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
		
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
				<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho danh mục" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Description:</label>
			<div class="formRight">
				<textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description"><?=@$item['description']?></textarea>
                <input readonly="readonly" type="text" style="width:50px; margin-top:10px; text-align:center;" name="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<div class="formRow">
			<div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            	<a href="index.html?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
			</div>
			<div class="clear"></div>
		</div>

	</div>
</form>
</div>


<?php if(in_array('color',$config_open)){ ?>
<script>
  $(document).ready(function() {
  	$('.update_color').select2();
  	
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
                                    <select name="id_mausac[]" class="id_mausac soflow" >\
										<option value="">Chọn màu sắc</option>\
										<?php $mausac = $attributes['mausac']; for($i=0;$i<count($mausacs);$i++){?>
					                  		<option value="<?=$i?>"><?=$mausacs[$i]['name_vi']?></option>\
					                  	<?php } ?>
									</select>\
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
                                    <select name="id_mausac[]" class="id_mausac soflow" >\
										<option value="">Chọn màu sắc</option>\
										<?php $mausac = $attributes['mausac']; for($i=0;$i<count($mausacs);$i++){?>
					                  		<option value="<?=$i?>"><?=$mausacs[$i]['name_vi']?></option>\
					                  	<?php } ?>
									</select>\
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
<?php }else{?>
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
<?php }?>
