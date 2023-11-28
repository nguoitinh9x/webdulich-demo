<?php
function get_main_cat()
	{
		$sql="select * from table_news_cat order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" class="main_font">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=backup&act=backup_file"><span>Backup</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Backup file</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Backup file</h6>
		</div>	
       
		<div class="formRow">
			<label>Tên file</label>
			<div class="formRight">
                <input type="text" name="filename" title="Nhập tên file" id="filename" class="tipS validate[required]" value="Backup-<?=date("d-m-Y")?>" />
			</div>
			<div class="clear"></div>
		</div>		               		            
		<div class="formRow">
			<div class="formRight">
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Backup File" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>   	
</form>  

<div class="widget">
  <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
    <h6>Danh sách các file hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
      
        <td>STT</td>
         <td>Tên file</td>
        <td  width="200" class="sortCol"><div>Thời gian<span></span></div></td>
        <td width="200">Dung lượng</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
  
    <tbody>
        <?=$list_file_bakup?>
      
          
                </tbody>
  </table>
</div> 