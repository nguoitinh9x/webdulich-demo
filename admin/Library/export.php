<?php
		/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package Simple Nina Framework
	 * @author  Hiếu Nguyễn <nguyenhieunina@gmail.com>
	 * @version 1.0.0
	 * @license http://nina.vn
	 */
	 
	defined( 'ROOT' ) ?:  define( 'ROOT', dirname(__DIR__));
	defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );
	require_once dirname(__DIR__). '/Library/autoload.php';
	
	$id_donhang=$_GET['id'];
	settype($id,'int');

	$db->bindMore(array("id"=>$id_donhang));
    $result_giohang = $db->row("select * from #_order where id=:id ");

	$db->bindMore(array("id"=>$id_donhang));
    $items = $db->query("select * from #_order_detail where id_order=:id ");
	
	/** PHPExcel */
	require_once 'Classes/PHPExcel.php';
	$madonhan = $result_giohang['order_code'];
	$hoten = $result_giohang['name'];
	$diachi = $result_giohang['address'];
	$ngaydat = date('d-m-Y H:i',strtotime($result_giohang['datecreate']));
	$dienthoai = $result_giohang['phone'];
	$phivc = number_format($result_giohang['shiping_price'],0,",",",");
	$tongthanhtoan = number_format($result_giohang['totalprice'],0,",",",");
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	// Set properties
	$objPHPExcel->getProperties()->setCreator("Thông Tin Đơn Hàng")
						 ->setLastModifiedBy("Thông Tin Đơn Hàng")
						 ->setTitle("Office 2007 XLSX Test Document")
						 ->setSubject("Office 2007 XLSX Test Document")
						 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
						 ->setKeywords("office 2007 openxml php")
						 ->setCategory("Test result file");
	// Add some data
	$objPHPExcel = PHPExcel_IOFactory::load("template/Don-dat-hang.xlsx");
	$center = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));

	$header = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow('A','1')->getFormattedValue();
	$footer = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow('A','3')->getFormattedValue();
	$header = str_replace('%madonhang%',$madonhan,$header);
	$header = str_replace('%hoten%',$hoten,$header);
	$header = str_replace('%diachi%',$diachi,$header);
	$header = str_replace('%ngaydat%',$ngaydat,$header);
	$header = str_replace('%dienthoai%',$dienthoai,$header);
	$footer = str_replace('%phivanchuyen%',$phivc,$footer);
	$footer = str_replace('%tongthanhtoan%',$tongthanhtoan,$footer);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $header)->getStyle('A1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	$vitri = 2;
	$dem_sanpham = count($items);
	$objPHPExcel->getActiveSheet()->insertNewRowBefore(3,$dem_sanpham);
	for($i=0;$i<$dem_sanpham;$i++) {

	$product_detail = $db->row("select * from #_product where id='".$items[$i]['id_product']."' ");

	$vitri++;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$vitri,$i)->getStyle('A'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));

	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('images');
	$objDrawing->setDescription('images');
	$objDrawing->setPath('../../Upload/product/'.$product_detail['thumb']);
	$objDrawing->setCoordinates('B'.$vitri);                      
	//setOffsetX works properly
	$objDrawing->setOffsetX(15);
	$objDrawing->setOffsetY(5);               
	//set width, height
	$objDrawing->setWidth(230);
	$objDrawing->setHeight(100);
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	$objPHPExcel->getActiveSheet()->getRowDimension($vitri)->setRowHeight(81);

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$vitri,$product_detail['name_vi'])->getStyle('C'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$vitri,$product_detail['code'])->getStyle('D'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$vitri,$items[$i]['amount'])->getStyle('E'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$vitri,number_format($items[$i]['price'],0,",",","))->getStyle('F'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$vitri,number_format($items[$i]['price']*$items[$i]['amount'],0,",",","))->getStyle('G'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	}
	$vitri++;
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$vitri, $footer)->getStyle('A'.$vitri)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Đơn Hàng');
	// Set active sheet indx to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	// Save Excel 2007 file
	$filename = "HDH-".time().".xlsx";
	$path = "../upload/".$filename;

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$filename.'"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	unlink($path);
?>