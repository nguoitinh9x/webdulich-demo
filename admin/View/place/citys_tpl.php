<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	  <li><a href="index.html?com=place&act=man_city"><span>Tỉnh thành</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}						
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.html?com=place&act=add_city'" />
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />
    </div>      
</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các tỉnh thành hiện tại</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
        <td class="sortCol"><div>Tên<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>       
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="paging"><?=$paging?></div></td>
      </tr>
    </tfoot>
    <tbody>
      <?php for($i=0, $count=count($items); $i<$count; $i++){?>
      <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
         <input type="text" value="<?=$items[$i]['number']?>" class="tipS smallText update_stt" original-title="Nhập số thứ tự " data-id="<?=$items[$i]['id']?>" data-table="<?=$com?>_city" data-type="stt" />
        </td> 
            
        <td class="title_name_data">
            <a href="index.html?com=place&act=edit_city&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['name']?></a>
        </td>
       
        <td align="center">
         <a data-val2="<?=$_GET['com']?>_city" rel="<?=$items[$i]['shows']?>" data-val3="shows" class="diamondToggle <?=($items[$i]['shows']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
       
        <td class="actBtns">
            <a href="index.html?com=place&act=edit_city&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="Assets/images/icons/dark/pencil.png" alt=""></a>
            <a href="" onclick="CheckDelete('index.html?com=place&act=delete_city&listid=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="Assets/images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>               