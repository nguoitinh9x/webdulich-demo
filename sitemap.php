<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	
	defined( 'ROOT' ) ?:  define( 'ROOT', __DIR__);
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );
	require_once ROOT . '/Library/autoload.php';

	$header_xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
	$footer_xml = "</urlset>";
	$file_topic = fopen("Upload/sitemap.xml", "w+");
	fwrite($file_topic, $header_xml);
	fwrite($file_topic, "<url><loc>"._BASEURL_."</loc><lastmod>".date('c')."</lastmod><priority>1</priority></url>");
	fwrite($file_topic, "<url><loc>"._BASEURL_."gioi-thieu/</loc><lastmod>".date('c')."</lastmod><priority>0.85</priority></url>");
	fwrite($file_topic, "<url><loc>"._BASEURL_."san-pham/</loc><lastmod>".date('c')."</lastmod><priority>0.85</priority></url>");
	fwrite($file_topic, "<url><loc>"._BASEURL_."dich-vu/</loc><lastmod>".date('c')."</lastmod><priority>0.85</priority></url>");
	fwrite($file_topic, "<url><loc>"._BASEURL_."du-an/</loc><lastmod>".date('c')."</lastmod><priority>0.85</priority></url>");
	fwrite($file_topic, "<url><loc>"._BASEURL_."tin-tuc/</loc><lastmod>".date('c')."</lastmod><priority>0.85</priority></url>");
	fwrite($file_topic, "<url><loc>"._BASEURL_."lien-he/</loc><lastmod>".date('c')."</lastmod><priority>0.85</priority></url>");


	$sanpham = $db->query("select name_$lang,id,slug,dateupdate from #_product where shows=1 and type='product' order by number,id desc ");
	foreach ($sanpham as $value) { 
		fwrite($file_topic, "<url><loc>"._BASEURL_."san-pham/".$value['slug']."</loc><lastmod>".date('c',strtotime($value['dateupdate']))."</lastmod><priority>0.69</priority></url>");
	}

	$tintuc = $db->query("select name_$lang,id,slug,dateupdate from #_post where shows=1 and type='tin-tuc' order by number,id desc ");
	foreach ($tintuc as $value) { 
		fwrite($file_topic, "<url><loc>"._BASEURL_."tin-tuc/".$value['slug']."</loc><lastmod>".date('c',strtotime($value['dateupdate']))."</lastmod><priority>0.69</priority></url>");
	}

	fwrite($file_topic, $footer_xml);
	fclose($file_topic);

	$func->transfer("Đã tạo xong sitemap ! ", "sitemap.xml");
?>