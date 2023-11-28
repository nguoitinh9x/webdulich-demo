<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";	
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$act = explode('_',$act);
	//print_r(count($act));
	if(count($act)>1){
		$act = $act[1];
	} else {
		$act = $act[0];
	}
	$config_open = array();
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	@define ( _download_type , 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|xlsx|txt' );
	switch($type){
		//-------------product------------------
		case 'product':
			switch($act){
				case 'list':
					$title_main = "Danh mục cấp 1";
					$config_open = array('name','seo','highlight','image');
					@define ( _width_thumb , 570 );
					@define ( _height_thumb , 440 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				case 'cat':
					$title_main = "Danh mục cấp 2";
					$config_open = array('name','seo');
					break;
				case 'item':
					$title_main = "Danh mục cấp 3";
					$config_open = array('name','seo');
					break;
				default:
					$title_main = "sản phẩm";
					$config_open = array('name','content','description','image','images','seo','view','list','cat','highlight','price');
					@define ( _width_thumb , 270 );
					@define ( _height_thumb , 360 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				}
			break;
		case 'tour':
			switch($act){
				case 'list':
					$title_main = "Danh mục cấp 1";
					$config_open = array('name','image','seo','showads');
					@define ( _width_thumb , 1366 );
					@define ( _height_thumb , 768 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				default:
					$title_main = "tour";
					$config_open = array('name','image','images','content','description','seo','view','highlight','selling','list','price','oldprice','code');
					@define ( _width_thumb , 280 );
					@define ( _height_thumb , 200 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				}
			break;
		case 've-may-bay':
			$title_main = "vé máy bay";
			$config_open = array('name','image','content','description','seo','view');
			@define ( _width_thumb , 375 );
			@define ( _height_thumb , 250 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'khach-san':
			$title_main = "khách sạn";
			$config_open = array('name','image','content','description','seo','view');
			@define ( _width_thumb , 375 );
			@define ( _height_thumb , 250 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'tin-tuc':
			$title_main = "tin tức";
			$config_open = array('name','image','content','description','seo','view');
			@define ( _width_thumb , 375 );
			@define ( _height_thumb , 250 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'cam-nang-du-lich':
			$title_main = "cẩm nang du lịch";
			$config_open = array('name','image','content','description','seo','view','highlight');
			@define ( _width_thumb , 375 );
			@define ( _height_thumb , 250 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'chinh-sach':
			$title_main = "chính sách";
			$config_open = array('name','image','content','seo','view','description');
			@define ( _width_thumb , 70 );
			@define ( _height_thumb , 70 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'khach-hang':
			$title_main = "Khách hàng";
			$config_open = array('name','image','description','attributes');
			@define ( _width_thumb , 160 );
			@define ( _height_thumb , 160 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'ho-tro':
			$title_main = "hỗ trợ khách hàng";
			$config_open = array('name','content','seo','view');
			break;
		case 'download':
			$title_main = "Download File";
			$config_open = array('name','file','seo');
			break;
		case 'khachhang':
			$title_main = "Khách hàng";
			$config_open = array('name','image','description','content','seo');
			@define ( _width_thumb , 160 );
			@define ( _height_thumb , 160 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'visaochon':
			$title_main = "vì sao chọn";
			$config_open = array('name','icon','description');
			@define ( _width_thumb_i , 120 );
			@define ( _height_thumb_i , 120 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'album':
			$title_main = "Album";
			$config_open = array('image','name','link');
			@define ( _width_thumb , 400 );
			@define ( _height_thumb , 300 );
			@define ( _style_thumb , 1 );
			$ratio_ = 2;
			break;
		case 'video':
			$title_main = "video";
			$config_open = array('image','highlight');
			@define ( _width_thumb , 580 );
			@define ( _height_thumb , 320 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		//-------------info------------------
    	case 'gioi-thieu':
			$title_main = 'giới thiệu';
			$config_open = array('content','seo');
			@define ( _width_thumb , 555 );
			@define ( _height_thumb , 444 );
			$ratio_ = 1;
			break;
		case 'tuyen-dung':
			$title_main = 'tuyển dụng';
			$config_open = array('content','seo');
			break;
		case 'hop-tac':
			$title_main = 'hợp tác';
			$config_open = array('content','seo');
			break;
		case 'footer':
			$title_main = 'Thông tin footer';
			$config_open = array('description');
			break;
		case 'lienhe':
			$title_main = 'Thông tin Liên hệ';
			$config_open = array('content');
			break;
		case 'httt':
			$title_main = 'Hình thức thanh toán';
			$config_open = array('name','description');
			break;
		case 'tinhtrangdh':
			$title_main = 'Tình trạng đơn hàng';
			$config_open = array('name');
			break;
		case 'khoangia':
			$title_main = 'Khoản giá';
			$config_open = array('name');
			break;
		case 'tags':
			$title_main = "tags";
			$config_open = array('name','seo','highlight');
			break;
		case 'size':
			$title_main = "size";
			$config_open = array('name');
			break;
		case 'mausac':
			$title_main = "màu sắc";
			$config_open = array('name');
			break;
		case 'bank':
			$title_main = "ngân hàng";
			$config_open = array('image');
			@define ( _width_thumb , 150);
			@define ( _height_thumb , 100);
			@define ( _style_thumb , 1);
			$ratio_ = 1;
			break;
		case 'logo':
			$title_main = 'Logo';
			$config_open = array();
			@define ( _width_thumb , 270);
			@define ( _height_thumb , 118);
			@define ( _style_thumb , 1);
			$ratio_ = 1;
			break;
		case 'banner':
			$title_main = 'Banner';
			$config_open = array();
			@define ( _width_thumb , 700 );
			@define ( _height_thumb , 131 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'qc':
			$title_main = 'Banner qc';
			$config_open = array('link');
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 290 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'bocongthuong':
			$title_main = 'Bộ công thương';
			$config_open = array('link');
			@define ( _width_thumb , 129 );
			@define ( _height_thumb , 48 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'popup':
			$title_main = 'Popup';
			$config_open = array('link','shows');
			@define ( _width_thumb , 700 );
			@define ( _height_thumb , 400 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'favicon':
			$title_main = 'Favicon';
			$config_open = array();
			@define ( _width_thumb , 64 );
			@define ( _height_thumb , 64 );
			@define ( _style_thumb , 2 );
			$ratio_ = 1;
			break;
		case 'bgweb':
			$title_main = 'background web';
			$config_open = array('image');
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 576 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'bgfooter':
			$title_main = 'BG Footer';
			$config_open = array('image');
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 480 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		//-------------photo------------------
		case 'slider':
			$title_main = "Hình ảnh slider";
			$config_open = array('link');
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 493 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'doitac':
		    $title_main = "đối tác";
		    $config_open = array('link');
			@define ( _width_thumb , 182 );
			@define ( _height_thumb , 92 );
			@define ( _style_thumb , 2 );
			$ratio_ = 1;
			break;
		case 'link':
		    $title_main = "hỗ trợ trực tuyến";
		    $config_open = array('name','attributes');
			break;
		case 'danhmuc':
		    $title_main = "danh mục";
		    $config_open = array('name','ficon','link');
			break;
		case 'mangxh':
			$title_main = "Mạng xã hội";
			$config_open = array('link','name','image');
			@define ( _width_thumb , 27 );
			@define ( _height_thumb , 27 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'hotline':
			$title_main = "hotline";
			$config_open = array('name','phone');
			break;
		default: 
			break;
		}