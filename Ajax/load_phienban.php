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
	$key = $_POST["key"];
	$bienso = $_POST["bienso"];
	$socho = $_POST["socho"];

	$row_detail = $db->row("select * from #_product where shows=1 and type='product' and id=$id");


	$phienban= json_decode($row_detail['phienban'],true);
	$gia_pb=json_decode($row_detail['gia_pb'],true);	
	$file_pb=json_decode($row_detail['file_pb'],true);

	$biendangkiem = number_format ($bienso,0,",",",")." VNĐ";
	$phidangkiem = number_format ($Setting['dangkiem'],0,",",",")." VNĐ";
	$phiduongbo = number_format ($Setting['phiduongbo'],0,",",",")." VNĐ";

	$soChoNgoi = number_format ($socho,0,",",",")." VNĐ";

    $ptb = ($Setting['phitruocba'] / 100) * (preg_replace('/[^0-9]/','', $gia_pb[$key]));
    $phitruocba = number_format ($ptb,0,",",",")." VNĐ";
	

	$t = (preg_replace('/[^0-9]/','', $gia_pb[$key])) + $ptb + $bienso + $Setting['dangkiem'] + $Setting['phiduongbo'] + $socho;
	$tong = number_format ($t,0,",",",")." VNĐ";

?>


<div class="estimate-detail">
    <div class="row esdetail-row">
        <div class="col-xs-6 col-sm-8">
            <div class="esdetail-info"><span>Giá xe</span></div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="esdetail-gia"><span id="d2-giaXe"><?=$gia_pb[$key]?> VNĐ</span>
            </div>
        </div>
    </div>
    <div class="row esdetail-row">
        <div class="col-xs-6 col-sm-8">
            <div class="esdetail-info">
                <span>Phí trước bạ</span> <sup>(*)</sup> <span id="d2-phiTruocBa-text">(<?=$Setting['phitruocba']?> %)</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="esdetail-gia">
                <span id="d2-phiTruocBa"><?=$phitruocba?></span>
            </div>
        </div>
    </div>
    <div class="row esdetail-row">
        <div class="col-xs-6 col-sm-8">
            <div class="esdetail-info"><span>Biển đăng ký theo nơi mua</span>
                <sup>(*)</sup>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="esdetail-gia"><span id="d2-phiDangKy"><?=$biendangkiem?></span>
            </div>
        </div>
    </div>
    <div class="row esdetail-row">
        <div class="col-xs-6 col-sm-8">
            <div class="esdetail-info"><span>Đăng kiểm</span>
                <sup>(*)</sup>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="esdetail-gia"><span id="d2-phiDangKiem"><?=$phidangkiem?></span></div>
        </div>
    </div>
    <div class="row esdetail-row">
        <div class="col-xs-6 col-sm-8">
            <div class="esdetail-info"><span>Phí đường bộ (1 năm)</span>
                <sup>(*)</sup>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="esdetail-gia"><span id="d2-phiDangKiem"><?=$phiduongbo?></span></div>
        </div>
    </div>
    <div class="row esdetail-row">
        <div class="col-xs-6 col-sm-8">
            <div class="esdetail-info">
                <span>Bảo hiểm trách nhiệm dân sự </span>
                <sup>(*)</sup>
                <span id="d2-soChoNgoi">
                    <select id="soChoNgoi" name="soChoNgoi">
                        <option value="<?=$Setting['xe5cho']?>" <?=  $socho==$Setting['xe5cho'] ? 'selected' : '' ?>>4 chỗ</option>
                        <option value="<?=$Setting['xe7cho']?>" <?=  $socho==$Setting['xe7cho'] ? 'selected' : '' ?>>7 chỗ</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="esdetail-gia">
                <span id="d2-baoHiem"><?=$soChoNgoi?></span>
            </div>
        </div>
    </div>
</div>
<!--.estimate-detail-->
<div class="estimate-total">
    <div class="row esdetail-row">
        <div class="col-sm-7">
            <div class="esdetail-info"><span>Tổng cộng ( xe + phí )</span>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="esdetail-gia"><span id="d2-total"><?=$tong?></span></div>
        </div>
    </div>
</div>
    <!--.estimate-total-->
<div class="estimate-listbtn">
    <span class="btn btn-danger form_contact" data-toggle="modal" data-target="#myModal_contact">Báo giá</span>
</div>
<div class="estimate-note">
    <br/>
    <p><i><small><?=$Setting['des']?></small></i></p>
</div>
