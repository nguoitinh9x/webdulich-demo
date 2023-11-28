<script>
	$(document).ready(function() {
		$("#chonhet").click(function(){
			var status=this.checked;
			$("input[name='chon']").each(function(){this.checked=status;});
		});

		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.html?com=newsletter&act=man&keyword="+keyword;
		});

		$("#send").click(function(){
			var listid="";
			$("input[name='chon']").each(function(){
				if (this.checked) listid = listid+","+this.value;
			})
			listid=listid.substr(1);
			if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
			hoi= confirm("Xác nhận muốn gửi thư đi?");
			if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
		});
	});
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=newsletter&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main?></span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Quản lý email</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="frm" method="post"  action="index.html?com=newsletter&act=send" enctype="multipart/form-data" id="f">	
<input type="hidden" name="listid" id="listid">
<!-- <p>Chọn email mà bạn muốn gửi</p> -->
	<div class="widget">

	 <div class="title"><span class="titleIcon">
	    <input type="checkbox" id="titleCheck" name="titleCheck" />
	    </span>
	    <h6>Chọn tất cả</h6>
	    <div class="timkiem">
		    <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
		    <button type="button" class="blueB"  value="">Tìm kiếm</button>
	    </div>
	  </div>


	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<tr align="center">
	        <td></td>
	        <td>STT</td>
	        <td><div>Email<span></span></div></td>
	        <td>Thao tác</td>
	    </tr>
	    
		<?php for($i=0, $count=count($items); $i<$count; $i++){?>
		<tr align="center">
			<td align="center"><input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>	
			<td align="center"><?=$i+1?></td>		           
	        <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>><?=$items[$i]['email']?></td>
			<td>
				<a href="index.html?com=newsletter&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xem"><img src="Assets/images/icons/dark/pencil.png" alt=""></a>
				<a href="index.html?com=newsletter&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="Assets/images/icons/dark/close.png" alt=""></a></td>
			</tr>
		<?php } ?>
	</table>
	</div>
	<div class="widget">
		<div class="formRow">
			<label>File đính kèm:</label>
			<div class="formRight">
            	<input type="file" id="file" name="file" />
				<img src="Assets/images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải File (rar|zip|doc|docx|xls|xlsx|ppt|pptx|pdf|png|jpg|jpeg|gif)">
			</div>
			<div class="clear"></div>
		</div> 

        <div class="formRow form">
			<label>Tiêu đề</label>
			<div class="formRight">
                <input type="text" name="name" title="Nhập tiêu đề " id="name" class="tipS validate[required]" value="<?=@$item['name']?>" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Nội Dung</label>
			<div class="ck_editor">
                <textarea id="content" name="content"><?=@$item['content']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label></label>
			<div class="clear"></div>
			<input type="button" class="blueB" id="send" value="Gửi mail" />
		</div>
	</div>
</form> 




