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
	defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );

	require_once __DIR__ . '/Library/autoload.php';
	// $row = $db->query("select photo2,photo,slug,id from #_product ");
	// for ($i = 0; $i<count($row) ; $i++) {
	// 	if($row[$i]['photo']=='' && $row[$i]['photo2']!=''){
	// 		$duoi = explode('.',$row[$i]['photo2']);
	// 		$file_name = $row[$i]['slug'].'.'.end($duoi);
	// 		//echo $file_name.'<br>';
	// 		$func->downloadFile($row[$i]['photo2'],'../Upload/product/'.$file_name);

	// 		//$data['photo2'] = $row[$i]['photo'];
	// 		$data['photo'] = $file_name;
	// 		$db->setTable('product');
	// 		$db->setWhere('id',$row[$i]['id']);
	// 		$db->update($data);
	// 	}
	// }

	// $row = $db->query("select photo2,photo,id,id_cate from #_cate_photo ");
	// for ($i = 0; $i<count($row) ; $i++) {
	// 	$row_name = $db->row("select slug from #_product where id='".$row[$i]['id_cate']."' ");
	// 	if($row[$i]['photo']!=''){
	// 		$duoi = explode('.',$row[$i]['photo']);
	// 		$file_name = $row_name['slug'].'-'.rand (100,999).'.'.end($duoi);
	// 		$func->downloadFile($row[$i]['photo'],'../Upload/product/'.$file_name);

	// 		$data['photo2'] = $row[$i]['photo'];
	// 		$data['photo'] = $file_name;
	// 		$db->setTable('cate_photo');
	// 		$db->setWhere('id',$row[$i]['id']);
	// 		$db->update($data);
	// 	}
	// }
?>