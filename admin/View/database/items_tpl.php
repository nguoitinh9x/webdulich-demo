<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=database&act=man"><span>Quản lý database</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php if($mess!=''){ ?><div class="nNote nSuccess"><p><?php echo $mess ?></p></div><?php } ?>


<script language="javascript">	
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
        <input type="button" class="blueB" value="Optimize table" onclick="ChangeAction('index.php?com=database&act=man&multi=optimize');return false;" />
        <input type="button" class="blueB" value="Repair table" onclick="ChangeAction('index.php?com=database&act=man&multi=repair');return false;" />
        <input type="button" class="blueB" value="Analyze table" onclick="ChangeAction('index.php?com=database&act=man&multi=analyze');return false;" />
    </div>  
    <div style="float:right;">
        <div class="selector">
			
        </div>  
    </div>  
</div>



<div class="widget">
  <div class="title">
  <span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các table</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="sortCol"><div>Table<span></span></div></td>
        <td class="tb_data_small">Rows</td>
         <td width="200"><div>Data size<span></span></div></td>        
        <td >Index Size</td>
         <td >Data free</td>
        <td width="200">Update Time</td>
      </tr>
    </thead>
   
    <tbody>
        <?php
		$i = 0;
	$result = $d->query("SHOW TABLE STATUS");
	while ($row = $d->fetch_array($result)) {
  	$total_data = format_size($row['Data_length']);
  $total_idx = format_size($row['Index_length']);
  $max_data = format_size($row['Max_data_length']);
  $data_free = format_size($row['Data_free']);
  $class = ($i % 2 == 0) ? "bgcolor=White" : "";
  $text .= "<tr {$class}><td><input type=\"checkbox\" name=\"idtable[]\" value=\"" . $row['Name'] . "\" id=\"check".$i."\" /></td><td style=\"text-align:left\" class=\"row1\">&nbsp;<strong>" . $row['Name'] . "</strong></td>";
  $text .= "<td style=\"text-align:center\" class=\"row\">" . $row['Rows'] . "</td>";
  $text .= "<td style=\"text-align:center\" class=\"row\">" . $total_data . "</td>";
  $text .= "<td style=\"text-align:center\" class=\"row\">" . $total_idx . "</td>";
   $text .= "<td style=\"text-align:center\" class=\"row\">" . $data_free . "</td>";
  $text .= "<td style=\"text-align:center\" class=\"row\">" . $row['Update_time'] . "</td></tr>";
  $i ++;
	}
echo $text;
		?>
                </tbody>
  </table>
</div>
</form>               