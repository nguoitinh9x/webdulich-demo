<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'com';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});

		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=com&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
		});

    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=com&act=delete&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});
</script>


<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=com&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý Thành viên</span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=com&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

    </div>  
</div>

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
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>           
        <td class="tb_data_small">Tên</td>
        <td class="tb_data_small">com</td>
        <td class="tb_data_small">Act</td>
        <td class="tb_data_small">Type</td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>

    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>

       
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 


        <td class="title_name_data"><a href="index.php?com=com&act=edit&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?></a></td>
        <td class="title_name_data"><a href="index.php?com=com&act=edit&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten_com']?></a></td>
        <td class="title_name_data"><a href="index.php?com=com&act=edit&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['act']?></a></td>
        <td class="title_name_data"><a href="index.php?com=com&act=edit&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['type']?></a></td>



        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=com&act=man&id_list=<?=$_REQUEST['id_list']?>&id_cat=<?=$_REQUEST['id_cat']?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=com&act=man&id_list=<?=$_REQUEST['id_list']?>&id_cat=<?=$_REQUEST['id_cat']?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
       
        <td class="actBtns">
            <a href="index.php?com=com&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=com&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>  

