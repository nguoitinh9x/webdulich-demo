<?php
/*
	include("../libraries/excelwriter.inc.php");	
	$excel=new ExcelWriter('dstour.xls','utf-8');	
	if($excel==false)	
		echo $excel->error;
	$myArr=array("<b>maso</b>","<b>tieude</b>","<b>giaban</b>");
	$excel->writeLine($myArr);
	$conn = mysql_connect("localhost","root","");
			mysql_select_db("thienminhphu",$conn);
			mysql_query("SET NAMES 'utf8'");
	$sql="SELECT * FROM table_product order by stt,maso desc";
	$sqlhs=mysql_query($sql) or die(mysql_error());
	while($rows=mysql_fetch_assoc($sqlhs)) {
		$myArr=array($rows['maso'],$rows['ten'],$rows['giaban']);
		$excel->writeLine($myArr);
	}

	$excel->close();
	echo "<a href='dstour.xls'>Download bang gia</a>";
*/
?>
<?php
function get_main_category()
	{
		$sql="select * from table_product_cat order by id desc ";
			$result=mysql_query($sql);		
			while ($row_huyen=@mysql_fetch_array($result)) 
			{			
				$str.='<option value='.$row_huyen["id"].'>'.$row_huyen["ten"].'</option>';			
			}			
		return $str;
	}
	
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=product&amp;act=man_cat"><span>Xuất file excel</span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<div class="widget" >
  <div class="title">
    <h6>Xuất danh sách sản phẩm</h6>
  </div>
  <div style="padding:10px;">
 <link href="../libraries/multiselect/css/multi-select.css" media="screen" rel="stylesheet" type="text/css"> 
 <script src="../libraries/multiselect/jquery-ui.js" type="text/javascript"></script>
 <form name="frm" method="post" action="index.php?com=excel&act=save_export" enctype="multipart/form-data" class="nhaplieu">

     <select multiple="multiple" id="my-select" name="my-select[]">
      <?=get_main_category()?>
    </select>
    <script src="../libraries/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>
     <script type="text/javascript">
	 	$('#my-select').multiSelect({
			selectableOptgroup: true,
			selectableHeader: "<div class='custom-header'>Chọn danh mục</div>",
			selectionHeader: "<div class='custom-header'>Danh mục đã chọn</div>"		 
	 });</script><br />
     <input type="submit" value="Xuất" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=export&act=man'" class="btn" />
</form>
    </div>
    </div>