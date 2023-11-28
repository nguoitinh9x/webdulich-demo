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

    $row_setting = $db->row("select * from #_setting limit 0,1");
    $stock = json_decode($row_setting['attributes'],true);

    // echo '<pre>'; print_r($stock); echo '</pre>';

    $pick_province = $stock['city'];
    $pick_district = $stock['dist'];
    $pick_address = $stock['addr'];
    $token = $stock['token'];

    $tinhthanh = $_POST['ship_tinhthanh'];
    $quanhuyen = $_POST['ship_quan'];
    $diachi = $_POST['ship_diachi'];


    $tinhthanh = $func->getvalue('name', 'place_city', "id='$tinhthanh'");
    $tinhthanh = $tinhthanh['name'];

    $quanhuyen = $func->getvalue('name', 'place_dist', "id='$quanhuyen'");
    $quanhuyen = $quanhuyen['name'];

    $khoiluong = 0;

    foreach ($_SESSION['cart'] as $key => $value): 
    	$pid= $value['productid'];
    	$q=$value['qty'];
    	$khoiluong += $cart->get_weight($pid) * $q;
    endforeach;

    if ($khoiluong==0) { 
        $khoiluong = 1000; 
    }



    $data = array(
        "pick_province" => "$pick_province",
        "pick_district" => "$pick_district",
        "pick_address" => "$pick_address",

        "province" => "$tinhthanh",
        "district" => "$quanhuyen",
        "address" => "$diachi",
        "weight" => $khoiluong,
        "value" => $cart->get_order_total(),
    );

    $curl = curl_init('https://services.giaohangtietkiem.vn/services/shipment/fee?'.http_build_query($data));
    curl_setopt_array($curl, array(
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            "Token: $token",
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;
    ?>