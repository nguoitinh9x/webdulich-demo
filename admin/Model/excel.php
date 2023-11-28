<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){	
	case "export":		
		$template = "excel/item_export";
		break;
	case "import":		
		$template = "excel/item_import";
		break;
	case "save_export":
		save_export();
		break;
	case "save_import":
		save_import();
		$template = "excel/item_import";
		break;
	default:
		$template = "index";
}
#====================================
function save_export(){
	global $d;	
	
	$id_cat = $_POST['my-select'];
	if($id_cat!=''){
		$array_idcat=implode(",",$id_cat);	
		$dk_idcat = "where id_cat IN ($array_idcat)";
	}
	
	// Bat dau export excel
	/** PHPExcel */
include 'PHPExcel.php';
/** PHPExcel_Writer_Excel */
include 'PHPExcel/Writer/Excel5.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A1:E1' );
$objPHPExcel->getActiveSheet()->getRowDimension( '1' )->setRowHeight( 42 );
$objPHPExcel->getActiveSheet()->getStyle( 'A1' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'e97d13' ),'name' => 'Tahoma', 'bold' => true, 'italic' => false, 'size' => 14 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getColumnDimension( 'A' )->setWidth( 20 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'B' )->setWidth( 30 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'C' )->setWidth( 50 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'D' )->setWidth( 25 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'E' )->setWidth( 25 );
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);
   
$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A1', 'DANH SÁCH SẢN PHẨM' );
$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A2', 'ID' )->setCellValue( 'B2', 'Mã sản phẩm' )->setCellValue( 'C2', 'Tên sản phẩm' )->setCellValue( 'D2', 'Giá' )->setCellValue( 'E2', 'ID Danh Mục' );


 $objPHPExcel->getActiveSheet()->getStyle( 'A2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '0033b7' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'c2def0'))));
 
   $objPHPExcel->getActiveSheet()->getStyle( 'B2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '0033b7' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'c2def0'))));
   
   $objPHPExcel->getActiveSheet()->getStyle( 'C2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '0033b7' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'c2def0'))));
   
   $objPHPExcel->getActiveSheet()->getStyle( 'D2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '0033b7' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'c2def0'))));
   
   $objPHPExcel->getActiveSheet()->getStyle( 'E2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '0033b7' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'c2def0'))));
	//End
	
	$sql="SELECT * FROM table_product $dk_idcat order by stt,id asc";
	$d->query($sql);
	$result_array=$d->result_array();
	$vitri=3;
	for($i=0,$count_dmsp=count($result_array);$i<$count_dmsp;$i++) { 
	
	$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A'.$vitri, $result_array[$i]['id'] )->setCellValue( 'B'.$vitri,$result_array[$i]['masp'] )->setCellValue( 'C'.$vitri, $result_array[$i]['ten'])->setCellValue( 'D'.$vitri, $result_array[$i]['gia'] )->setCellValue( 'E'.$vitri, $result_array[$i]['id_cat'] );
		
	$objPHPExcel->getActiveSheet()->getStyle( 'D'.$vitri )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '990000' )), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );
	$objPHPExcel->getActiveSheet()->getStyle('D'.$vitri)->getNumberFormat()->setFormatCode("#,##0 _€");
	$vitri++;	
	}

	
	
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Danh Sách Sản Phẩm');

		
// Save Excel 2007 file
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

//Redirect output to a client’s web browser (Excel5)
      header( 'Content-Type: application/vnd.ms-excel' );
      header( 'Content-Disposition: attachment;filename="danhsachsanpham-'.date('d-m-Y').'.xls"' );
      header( 'Cache-Control: max-age=0' );

      $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
      $objWriter->save( 'php://output' );	
	
	
}

function save_import(){
	global $d;
		
	$file_type=$_FILES['linkfile']['type'];
		if($file_type=="application/vnd.ms-excel" || $file_type=="application/x-ms-excel")
		{	
				$filename=changeTitle($_FILES["linkfile"]["name"]);
				move_uploaded_file($_FILES["linkfile"]["tmp_name"],$filename);
					
		
		//include the following 2 files
		require 'PHPExcel.php';
		require_once 'PHPExcel/IOFactory.php';
		
		$objPHPExcel = PHPExcel_IOFactory::load($filename);
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle = $worksheet->getTitle();
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		$nrColumns = ord($highestColumn) - 64;
		
		for ($row = 3; $row <= $highestRow; ++ $row) {
			
				$cell = $worksheet->getCellByColumnAndRow(0, $row);
				$ID = $cell->getValue();	
				
				$cell = $worksheet->getCellByColumnAndRow(1, $row);
				$masp = $cell->getValue();		
				
				$cell = $worksheet->getCellByColumnAndRow(2, $row);
				$ten = $cell->getValue();	
				
				$cell = $worksheet->getCellByColumnAndRow(3, $row);
				$gia = $cell->getValue();
				
				$cell = $worksheet->getCellByColumnAndRow(4, $row);
				$id_dm = $cell->getValue();
				
				$id_cat = (int)$id_dm;
				$ngaytao =  time();
								
				 if($ID>0){
					$sqlUpdate = "update table_product set masp='".$masp."', ten='".$ten."', gia='".$gia."' , id_cat='".$id_cat."'  where id='".$ID."'";
					if(!mysql_query($sqlUpdate)){ echo "Update lỗi sản phẩm : ".$ID.'<br/>';}
				 } else {
					$sql = "INSERT INTO  table_product (masp,ten,gia,id_cat,ngaytao,hienthi,stt)  VALUES ('$masp','$ten','$gia','$id_cat','$ngaytao','1','1')";
					mysql_query($sql); 
				 }
					
			}	
		}
		transfer("Nhập File Thành Công", "index.php?com=excel&act=import");
		
		unlink($filename) or DIE("couldn't delete $dir$file<br />");
		}
		else{ transfer("Không hổ trợ kiểu file này", "index.php?com=excel&act=import");
		}
	
}

?>