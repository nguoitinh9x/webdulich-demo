<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	defined( 'ROOT' ) ?:  define( 'ROOT', dirname(__DIR__));
	defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );
	require_once ROOT . '/Library/autoload.php';

	$Setting = $db->row("select * from #_setting limit 0,1");

	$id = $_POST["id"];
	$key = $_POST["version"];
	$bienso = $_POST["bienso"];
	$socho = $_POST["socho"];

	$row_detail = $db->row("select * from #_product where shows=1 and type='product' and id=$id");


	$phienban= json_decode($row_detail['phienban'],true);
	$gia_pb=json_decode($row_detail['gia_pb'],true);	
	$file_pb=json_decode($row_detail['file_pb'],true);

	$biendangkiem = number_format ($bienso,0,",",",")." VNĐ";
	$phidangkiem = number_format ($Setting['dangkiem'],0,",",",")." VNĐ";
	$phiduongbo = number_format ($Setting['phiduongbo'],0,",",",")." VNĐ";

    if($bienso==$Setting['biendangkyhcm']){
        $khuvuc = "Hồ Chí Minh";
    }elseif($bienso==$Setting['biendangkyhn']) {
        $khuvuc = "Hà Nội";
    }
    elseif($bienso==$Setting['biendangky2']) {
        $khuvuc = "Khu vực II";
    }
    else{
        $khuvuc = "Khu vực III";
    }

	$soChoNgoi = number_format ($socho,0,",",",")." VNĐ";


	$ptb = ($Setting['phitruocba'] / 100) * (preg_replace('/[^0-9]/','', $gia_pb[$key]));


    $t = (preg_replace('/[^0-9]/','', $gia_pb[$key])) + $ptb + $bienso + $Setting['dangkiem'] + $Setting['phiduongbo'] + $socho;
    $tong = number_format ($t,0,",",",")." VNĐ";


?>

<div class="col-md-12 list-version">
    <p class="m-0"><b><?=$row_detail['name_vi']?></b></p>
    <p class="m-0">Phiên bản: <?=$phienban[$key]?></p>
    <ul id="mModal">
        <label>
            <li class="choose_pb">
                <img src="<?=_upload_product_l.'200x80x2/'.$file_pb[$key]?>" alt="<?=$phienban[$key]?>">
            </li>
        </label>
    </ul>
</div>
<div class="estimate-calculator">
    <div class="estimate-detail">
        <div class="row esdetail-row">
            <div class="col-6">
                <div class="esdetail-info"><span>Giá xe</span></div>
            </div>
            <div class="col-6">
                <div class="esdetail-gia"><span id="d2-giaXe"><?=$gia_pb[$key]?> VNĐ</span>
                </div>
            </div>
        </div>
        <div class="row esdetail-row">
            <div class="col-7">
                <div class="esdetail-info"><span>Biển đăng ký ( <?=$khuvuc?> )</span></div>
            </div>
            <div class="col-5">
                <div class="esdetail-gia"><span id="d2-phiDangKy"><?=$biendangkiem?></span>
                </div>
            </div>
        </div>
    </div>
    <!--.estimate-detail-->
    <div class="estimate-total">
        <div class="row esdetail-row">
            <div class="col-6">
                <div class="esdetail-info"><span>Tổng cộng ( xe + phí )</span>
                </div>
            </div>
            <div class="col-6">
                <div class="esdetail-gia"><span id="d2-total"><?=$tong?></span></div>
            </div>
        </div>
    </div>
</div>