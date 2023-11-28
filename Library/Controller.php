<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	$_SESSION['ONWEB'] = true;
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;

	$Setting = $db->row("select * from #_setting limit 1");

	$db->bindMore(array("type"=>"bgweb"));
	$row_background = $db->row("select * from #_bgweb where type=:type limit 1");

	$db->bindMore(array("type"=>"favicon"));
	$Favicon = $db->row("select photo_vi as photo from #_photo where type=:type limit 1 ");

	$db->bindMore(array("type"=>"logo"));
	$Logosite = $db->row("select photo_vi as photo from #_photo where type=:type");

	$Logosite = $Logosite['photo'];
	$db->bindMore(array("type"=>"banner"));
	$Bannersite = $db->row("select photo_vi as photo,link from #_photo where type=:type");
	$Bannersite = $Bannersite['photo'];

	if($row_background['shows']==1){
		$plugin_css .="body{";
		$plugin_css .="background:url("._upload_hinhanh_l.$row_background['photo'].") ".$row_background['re_peat']." ".$row_background['waytop']." ".$row_background['wayleft'].";";
		$plugin_css .="background-color:".$row_background['bgcolor'].";";
		$plugin_css .="background-attachment:".$row_background['fix_bg']."; ";
		$plugin_css .="}";
	}
	
	$bgfooter = $db->row("select * from #_bgweb where type='bgfooter' ");
    $plugin_css .="footer{background-image: url("._upload_hinhanh_l.'1366x480x1/'.$bgfooter['photo'].")}";
    
    $mangxh = new \Library\plugins('mangxh','mangxh');
    $plugin_css .= $mangxh->css();

	$toolbar = new \Library\plugins('toolbar','type2');
    $plugin_css .= $toolbar->css();
    $plugin_js .= $toolbar->js();

    $Search = new \Library\plugins('Search','coban');
    $plugin_css .= $Search->css();
    $plugin_js .= $Search->js();

    $facebook = new \Library\plugins('facebook','type1'); 
	$thongtin_ft = new \Library\plugins('thongtin','listul');
    $plugin_css .= $thongtin_ft->css();

	$thongke = new \Library\plugins('thongke','2truong');
    $plugin_css .= $thongke->css();

    $nhantin = new \Library\plugins('nhantin','type3');
    $plugin_css .= $nhantin->css();
    //$plugin_js .= $nhantin->js();

    /* 
    if(!empty($_POST['email2'])){
        $mail = $_POST['email2'];
        $checkemail = $db->query("select * from #_newsletter where email='$mail'");
        if(count($checkemail) > 0){
            $func->transfer("Email đăng ký đã tồn tại !<br>Xin quý khách thử lại với email khác .", "./",false);
        }
        else{
            $data['email'] = $mail;
            $data['name'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['content'] = $_POST['content'];
            $data['view'] = 0;
            $data['datecreate'] = date('Y-m-d H:i:s');
            $db->setTable('newsletter');
            if($db->insert($data)){
                $func->transfer("Đăng ký thành công !<br/>Xin cảm ơn .", "./");
            }
            else{
                $func->transfer("Xin lỗi quý khách.<br>Lưu dữ liệu bị lỗi, xin quý khách thử lại !", "./",false);
            }
        }
    }
    $Translate = new \Library\plugins('Translate','flag');
	$plugin_css .= $Translate->css();
	$plugin_jsfile .= $Translate->addjs('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit','');
	$plugin_js .= $Translate->js();
    $chatfb = new \Library\plugins('chatfb','type1');
    $plugin_css .= $chatfb->css();
    $plugin_js .= $chatfb->js();
    $bocongthuong = new \Library\plugins('bocongthuong','type1');
    $plugin_css .= $bocongthuong->css();
    $nhantin = new \Library\plugins('nhantin','type1');
    $plugin_css .= $nhantin->css();  
    */
	switch($com){
		case 'gioi-thieu':
			$source = "about";
			$template = "about";
			$title_com = _gioithieu;
			$type_bar = 'gioi-thieu';
			break;
		case 'tuyen-dung':
			$source = "about";
			$template = "about";
			$title_com = 'Tuyển dụng';
			$type_bar = 'tuyen-dung';
			break;
		case 'hop-tac':
			$source = "about";
			$template = "about";
			$title_com = 'Hợp tác';
			$type_bar = 'hop-tac';
			break;
		case 'tin-tuc':
			$source = "post";
			$template = isset($_GET['id']) ? "post_detail" : "post";
			$type_bar = 'tin-tuc';
			$title_com = _tintuc;
			break;
		case 've-may-bay':
			$source = "post";
			$template = isset($_GET['id']) ? "post_detail" : "post";
			$type_bar = 've-may-bay';
			$title_com = 'Vé máy bay';
			break;
		case 'khach-san':
			$source = "post";
			$template = isset($_GET['id']) ? "post_detail" : "post";
			$type_bar = 'khach-san';
			$title_com = 'Khách sạn';
			break;
		case 'cam-nang-du-lich':
			$source = "post";
			$template = isset($_GET['id']) ? "post_detail" : "post";
			$type_bar = 'cam-nang-du-lich';
			$title_com = 'Cẩm nang du lịch';
			break;
		case 'tour':
			$source = "service";
			$template = isset($_GET['id']) ? "service_detail" : "service";
			$type_bar = 'tour';
			$title_com = 'Tour';
			break;
		case 'tim-kiem':
			$source = "search";
			$template = "service";
			$title_com = 'Tìm kiếm';
			break; 
		/*
		case 'san-pham':
			$source = "product";
			$template =isset($_GET['id']) ? "product_detail" : "product";
			$title_com = _sanpham;
			$type_bar = 'product';	
			break;
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			$title_com = _giohang;
			break;	
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			$title_com = _thanhtoan;
			break;
		case 'tags':
			$source = "tags";
			$template = "product";
			$title_com = "Tags";
			$type_bar = 'tags';
			break;
		case 'download':
			$source = "service";
			$template = "download";
			$title_com = 'Files';
			$type_bar = 'download';
			break;
		case 'album':
			$source = "album";
			$template = "album_detail";
			$type_bar = 'album';
			break;
		*/
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			$title_com = _lienhe;
			break;
		case 'site-map':
			$source = "sitemap";
			$template ="sitemap";
			break;
		case '404':
			$source = "404";
			$template ="404";
			break;
		default:
			// if($com!=''){
			// 	header("HTTP/1.1 301 Moved Permanently"); 
			// 	header("Location: /"); 
			// 	exit();
			// }
			$source = "index";
			$template = "index";
			break;
	}
	if($source!="") include MODEL.$source.".php";
	if(isset($_REQUEST['com']) && $_REQUEST['com']=='logout'){
		session_unregister($login_name);
		header("Location:./");
	}		
	if(isset($_REQUEST['com']) && $_REQUEST['com']=='thoat'){
		unset($_SESSION['login']);
		header("location:./");
	}	
	if( isset($_REQUEST['command']) && $_REQUEST['command']=='add' && isset($_REQUEST['productid']) && $_REQUEST['productid']>0){
		$pid=$_REQUEST['productid'];
		$soluong=1;
		addtocart($pid,$soluong);
		redirect("thanh-toan/");
	}
?>