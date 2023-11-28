<?php
	$attributes = json_decode($item['attributes'],true);
	$tinhthanh = $db->query("select * from #_place_city where shows=1 order by name desc");
	//echo "select * from #_place_dist where shows=1 and id_city='".$item['tinhthanh']."' order by name desc";
	$quanhuyen = $db->query("select * from #_place_dist where shows=1 and id_city='".$item['tinhthanh']."' order by name desc");
	$donvitinh = $db->query("select * from #_title where shows=1 and type='donvibds' order by number,id desc");
?>
<script>		
	$(document).ready(function() {
	    $('.themmoi').click(function(e) {
			$.ajax ({
				type: "POST",
				url: "ajax/khuyenmai.php",
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

        $('.tab_noidung li a').click(function(event) {
			/* Act on the event */
			$('.tab_noidung li a').removeClass('active');
			$(this).addClass('active');
			var id = $(this).attr('href');
			$('.tab_hidden').removeClass('active');
			$(id).addClass('active');
			return false;
		});

		$("#tinhthanh").change(function() {
			var id = $(this).val();
			var act = 'selectlist';
			$.ajax({
				url: 'Ajax/ajax.php',
				type: 'POST',
				data: {id:id,act:act},
				success:function(data){
					$("#quanhuyen").html(data);
				}
			});
		});

	});
	
</script>
<?php
  //------------ tags-------------------------
  	if($item['tags']!=''){
		$tags = explode(",", $item['tags']) ;
		$sql = "select id,name_vi from #_tags where id<>'".$tags[0]."'";
		for ($i=1,$count = count($tags); $i < $count ; $i++) { 
			$sql .=" and id<> '".$tags[$i]."'";
		}
	} else {
		$sql = "select id,name_vi from #_tags";
	}
	    $tags_arr  =  $db->query($sql);

    $sizes  =  $db->query("select * from #_title where shows=1 and type='size' order by number asc");
    $mausacs  =  $db->query("select * from #_title where shows=1 and type='mausac' order by number asc");
?>

<div class="wrapper">
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=project&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.html?com=project&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
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
			<?=$func->get_main_item()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if(in_array('sub',$config_open)){ ?>
		<div class="formRow">
			<label>Chọn danh mục 4</label>
			<div class="formRight">
			<?=$func->get_main_sub()?>
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
			<div class="mt10"><img src="<?=_upload_project.$item['photo']?>"  alt="NO PHOTO" width="100" /></div>
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

		<!-- <div class="formRow">
			<label>Địa điểm</label>
			<div class="formRight">
				<div class="f_left">
					<select id="tinhthanh" name="tinhthanh"  class="main_select select_danhmuc">
	      				<option value="">Chọn tỉnh thành</option>
	      				<?php for ($i=0;$i<count($tinhthanh); $i++) { ?>
	      				<option value="<?=$tinhthanh[$i]['id']?>" <?php if($tinhthanh[$i]['id']==$item['tinhthanh']){ echo 'selected="selected"';}?> ><?=$tinhthanh[$i]['name']?></option>
	      				<?php } ?>
	      			</select>
				</div>
      			
				<div class="f_left">
      			<label class="p_left20">Quận huyện</label>
					<select id="quanhuyen" name="quanhuyen"  class="main_select select_danhmuc">
	      				<option value="">Chọn quận huyện</option>
	      				<?php for ($i=0;$i<count($quanhuyen); $i++) { ?>
	      				<option value="<?=$quanhuyen[$i]['id']?>" <?php if($quanhuyen[$i]['id']==$item['quanhuyen']){ echo 'selected="selected"';}?> ><?=$quanhuyen[$i]['name']?></option>
	      				<?php } ?>
	      			</select>
      			</div>

      			<div class="f_left">
      				<label class="p_left20">Đơn vị tính</label>
					<select id="donvitinh" name="donvitinh"  class="main_select select_danhmuc">
	      				<option value="">Chọn đơn vị </option>
	      				<?php for ($i=0;$i<count($donvitinh); $i++) { ?>
	      				<option value="<?=$donvitinh[$i]['id']?>" <?php if($donvitinh[$i]['id']==$item['donvitinh']){ echo 'selected="selected"';}?> ><?=$donvitinh[$i]['name_vi']?></option>
	      				<?php } ?>
	      			</select>
      			</div>
      		</div>
			<div class="clear"></div>
		</div> -->


		<!-- <div class="formRow">
			<label>Giá bán (VND)</label>
			<div class="formRight">
				<div class="loai">
					<label><input type="radio" name="loaigia" value="0" <?php if($item['giaban']!=0){ echo 'checked=""';} ?>> Cố Định</label>
					<label><input type="radio" name="loaigia" value="1" <?php if($item['giabantu']!=0){ echo 'checked=""';} ?>> Khoản giá</label>
				</div>
				<div class="clsdientich">
					<div class="clsloai <?php if($item['giaban']!=0){ echo 'active';} ?> clsloai0">
						<input type="text" placeholder="Nhập giá bán" name="giaban" title="Nhập giá bán" id="giaban" class="conso tipS validate[required]" value="<?=@$item['giaban']?>" />
					</div>
					<div class="clsloai <?php if($item['giabantu']!=0){ echo 'active';} ?> clsloai1">
						<div class="w50">
							<input type="text" placeholder="Nhập giá bán từ" name="giabantu" title="Nhập giá bán từ" id="giabantu" class="conso tipS validate[required]" value="<?=@$item['giabantu']?>" />
						</div>
						<div class="w50 p_left20">
							<input type="text" placeholder="Nhập giá bán đến" name="giabanden" title="Nhập giá bán đến" id="giabanden" class="conso tipS validate[required]" value="<?=@$item['giabanden']?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>  -->

		<!-- <div class="formRow">
			<label>Diện tích (m<sub>2</sub>)</label>
			<div class="formRight">
				<div class="loai">
					<label><input type="radio" name="loaidt" value="0" <?php if($item['dientich']!=0){ echo 'checked=""';} ?>> Cố Định</label>
					<label><input type="radio" name="loaidt" value="1" <?php if($item['dientichtu']!=0){ echo 'checked=""';} ?>> Khoản</label>
				</div>
				<div class="clsdientich">
					<div class="clsloai <?php if($item['dientich']!=0){ echo 'active';} ?> clsloai0">
						<input type="text" placeholder="Nhập diện tích" name="dientich" title="Nhập diện tích" id="dientichtu" class="conso tipS validate[required]" value="<?=@$item['dientich']?>" />
					</div>
					<div class="clsloai <?php if($item['dientichtu']!=0){ echo 'active';} ?> clsloai1">
						<div class="w50">
							<input type="text" placeholder="Nhập diện tích từ" name="dientichtu" title="Nhập diện tích từ" id="dientich" class="conso tipS validate[required]" value="<?=@$item['dientichtu']?>" />
						</div>
						<div class="w50 p_left20">
							<input type="text" placeholder="Nhập diện tích đến" name="dientichden" title="Nhập diện tích đến" id="dientichden" class="conso tipS validate[required]" value="<?=@$item['dientichden']?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>  -->

		<!-- <div class="formRow">
			<label>Phòng ngủ</label>
			<div class="formRight">
				<div class="loai">
					<label><input type="radio" name="loaiphong" value="0" <?php if($item['phongngu']!=0){ echo 'checked=""';} ?>> Cố Định</label>
					<label><input type="radio" name="loaiphong" value="1" <?php if($item['phongngutu']!=0){ echo 'checked=""';} ?>> Khoản</label>
				</div>
				<div class="clsdientich">
					<div class="clsloai <?php if($item['phongngu']!=0){ echo 'active';} ?> clsloai0">
						<input type="text" placeholder="Nhập phòng ngủ" name="phongngu" title="Nhập phòng ngủ" id="phongngu" class="conso tipS validate[required]" value="<?=@$item['phongngu']?>" />
					</div>
					<div class="clsloai <?php if($item['phongngutu']!=0){ echo 'active';} ?> clsloai1">
						<div class="w50">
							<input type="text" placeholder="Nhập phòng ngủ từ" name="phongngutu" title="Nhập phòng ngủ từ" id="phongngutu" class="conso tipS validate[required]" value="<?=@$item['phongngutu']?>" />
						</div>
						<div class="w50 p_left20">
							<input type="text" placeholder="Nhập phòng ngủ đến" name="phongnguden" title="Nhập phòng ngủ đến" id="phongnguden" class="conso tipS validate[required]" value="<?=@$item['phongnguden']?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>  -->
		
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
        			$d->query("select id,name_vi from #_tags where id='".$tags[$i]."'");
        			$tags_name = $d->fetch_array();
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

		<div class="formRow">
			<label>Vị trí</label>
			<div class="formRight">
				<textarea rows="5" cols="" title="Nhập iframe google map" class="tipS" name="toado"><?=@$item['toado']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
		<div class="tab_noidung">
		<ul>
				<li><a href="#tab_1" class="active">Tổng quan</a></li>
				<li><a href="#tab_2">Sản phẩm</a></li>
				<!-- <li><a href="#tab_5">Tiềm năng</a></li>
				<li><a href="#tab_6">Ưu đãi</a></li>
				<li><a href="#tab_7">Thiết kế</a></li>
				<li><a href="#tab_8">Thanh toán</a></li> -->
		</ul>
		</div>
		<div id="show_tabs">
			<div id="tab_1" class="tab_hidden active">
				<div class="formRow lang_hidden lang_vi active">
					<label>Tổng quan</label>
					<div class="ck_editor">
						<textarea id="tongquan_vi" name="tongquan_vi"><?=@$item['tongquan_vi']?></textarea>
					</div>
					<div class="clear"></div>
				</div>
			</div>

			<div id="tab_2" class="tab_hidden">
				<div class="formRow lang_hidden lang_vi active">
					<label>Sản phẩm</label>
					<div class="ck_editor">
						<textarea id="tienich_vi" name="tienich_vi"><?=@$item['tienich_vi']?></textarea>
					</div>
					<div class="clear"></div>
				</div>
			</div>

			<!-- <div id="tab_5" class="tab_hidden">
					<div class="formRow lang_hidden lang_vi active">
						<label>Tiềm năng</label>
						<div class="ck_editor">
			                <textarea id="tiemnang_vi" name="tiemnang_vi"><?=@$item['tiemnang_vi']?></textarea>
						</div>
						<div class="clear"></div>
					</div>
			</div>

			<div id="tab_6" class="tab_hidden">
					<div class="formRow lang_hidden lang_vi active">
						<label>Ưu Đãi</label>
						<div class="ck_editor">
			                <textarea id="uudai_vi" name="uudai_vi"><?=@$item['uudai_vi']?></textarea>
						</div>
						<div class="clear"></div>
					</div>
			</div>

			<div id="tab_7" class="tab_hidden">
					<div class="formRow lang_hidden lang_vi active">
						<label>Thiết kế</label>
						<div class="ck_editor">
			                <textarea id="thietke_vi" name="thietke_vi"><?=@$item['thietke_vi']?></textarea>
						</div>
						<div class="clear"></div>
					</div>
			</div>

			<div id="tab_8" class="tab_hidden">
					<div class="formRow lang_hidden lang_vi active">
						<label>Thanh toán</label>
						<div class="ck_editor">
			                <textarea id="thanhtoan_vi" name="thanhtoan_vi"><?=@$item['thanhtoan_vi']?></textarea>
						</div>
						<div class="clear"></div>
					</div>
			</div> -->

		</div>
		<div class="clear"></div>
		</div>

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
            	<a href="index.html?com=project&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
			</div>
			<div class="clear"></div>
		</div>

	</div>
</form>        </div>



<script>
  $(document).ready(function() {
  	$(document).ready(function() {
  		$('.loai input').change(function(event) {
  			/* Act on the event */
  			var id = $(this).val();
  			var swap =$(this).parents('.formRow');
  			swap.find('.clsloai').removeClass('active');
  			swap.find('.clsloai'+id).addClass('active');
  		});
  	});
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
