<script type="text/javascript">
$(document).ready(function() {
  $('.SearchTable select').change(function(event) {
      var wrap = $(this);
      timkiem(wrap);
  });
  $('.timkiem button').click(function(event) {
     var wrap = $('.timkiem input');
     timkiem(wrap);
  });
});
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=title&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main ?></span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				  <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			    <?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
          <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="title">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	  <input type="button" class="blueB" value="Thêm" onclick="location.href='index.html?com=title&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />
    </div>  
</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Chọn tất cả</h6>
    <div class="timkiem">
	    <input type="text" id="keywords" value="<?=$_GET['keyword']?>" placeholder="Nhập từ khóa tìm kiếm ">
	    <button type="button" class="blueB"  value="">Tìm kiếm</button>
    </div>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable SearchTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>     
        <?php if(in_array('image',$config_open)){ ?>
        <td class="tb_data_small">Hình ảnh</td>
        <?php } ?>
        <td class="sortCol"><div>Tên <?=$title_main?><span></span></div></td>
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
            <input type="text" value="<?=$items[$i]['number']?>" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" data-id="<?=$items[$i]['id']?>" data-table="<?=$com?>" data-type="stt" />
        </td> 
        
        <?php if(in_array('image',$config_open)){ ?>
          <td align="center"><img src="<?=_upload_hinhanh.$items[$i]['thumb']?>" width="60" /></td>
        <?php } ?>
        
        <td class="title_name_data">
            <a href="index.html?com=title&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['name_vi']?></a>
        </td>
 
        <td align="center">
          <a data-val2="<?=$_GET['com']?>" rel="<?=$items[$i]['shows']?>" data-val3="shows" class="diamondToggle <?=($items[$i]['shows']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
       
        <td class="actBtns">
            <a href="index.html?com=title&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="Assets/images/icons/dark/pencil.png" alt=""></a>
            <a href="index.html?com=title&act=delete&listid=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="Assets/images/icons/dark/close.png" alt=""></a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>  

<div class="paging"><?=$paging?></div>