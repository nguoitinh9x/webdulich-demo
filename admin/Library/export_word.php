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

	//get id
	$id_order= intval($_GET['id']);
	if($id_order<=0){
		$func->transfer("Không có dữ liệu","index.html?com=order&act=man");
		exit();
	}

	$db->bindMore(array("id"=>$id_order));
    $row_detail = $db->row("select * from #_order where id=:id ");
	if(!$row_detail){
		transfer("Dữ liệu không có thực hoặc đã xóa","index.html?com=order&act=man");
		exit();
	}
    $Setting = $db->row("select * from #_setting limit 0,1");
	//get time
	$now = time();
	$ngay = "Ngày ".date("d",$now)." Tháng ".date("m",$now)." Năm ".date("Y",$now);
	//create
	require_once 'PHPWord.php';
	$PHPWord = new PHPWord();
	//load template
	$document = $PHPWord->loadTemplate('template/donhang.docx');
	//set value company
	$document->setValue('{tencty}', $Setting["name_vi"]);
	$document->setValue('{diachicty}', $Setting["address_vi"]);
	$document->setValue('{ngayht}', $ngay);
	//set value customer
	$document->setValue('{hotenkh}', $row_detail["name"]);
	$document->setValue('{dienthoaikh}', $row_detail["phone"]);
	$document->setValue('{emailkh}', $row_detail["email"]);
	$document->setValue('{diachikh}', $row_detail["address"]);
	$document->setValue('{noidungkh}', $row_detail["content"]);
	$db->bindMore(array("id_order"=>$id_order));
    $row_order = $db->query("select * from #_order_detail where id_order=:id_order");
	$data =  array();
	$total_price = 0;
	$total_count = 0;
	for ($i=0,$count=count($row_order); $i < $count; $i++) { 
		$data["stt"][$i] = $i+1;
		$data["name"][$i] = $row_order[$i]["name"];
		$total_count += $soluong = $row_order[$i]["amount"];
		$data["sl"][$i] = number_format($soluong);
		$gia = $row_order[$i]["price"];
		$data["dg"][$i] = number_format($gia);
		$total_price += $thanhtien = $gia*$soluong ;
		$data["tt"][$i] = number_format($thanhtien);
	}
	//set value row table
	$document->cloneRow('TB', $data);
	//set value total
	$document->setValue('{tongsolg}', number_format($total_count));
	$document->setValue('{congtien}', number_format($total_price));
	$document->setValue('{thanhtien}', number_format($total_price));
	$document->setValue('{tongtienchu}', $func->convert_number_to_words($total_price));
	//save file
	//$filename = "Don_Hang_".time().".docx";
	$filename = "Don_Hang_".time().".docx";
	$document->save($filename);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: '. filesize($filename));
	flush();
	readfile($filename);
	unlink($filename);

?>