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

	$type_get = $_POST['type_get'];
	$id_get = $_POST['id_get'];

	if ($type_get == 'city') {
		$result_value = $db->query("select id,name from #_place_city where shows=1 order by name asc");
		$str = '	
		<option value="">Chọn tỉnh/thành phố</option>';
		foreach ($result_value as $key => $value) {
			$str.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		echo $str;
	}
	if ($type_get == 'dist') {
		$result_value = $db->query("select id,name from #_place_dist where shows=1 and id_city='".$id_get."' order by name asc");
		$str = '	
		<option value="">Chọn Quận/Huyện</option>';
		foreach ($result_value as $key => $value) {
			$str.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		echo $str;
	}
	if ($type_get == 'ward') {
		$result_value = $db->query("select id,name from #_place_ward where shows=1 and id_dist='".$id_get."' order by name asc");
		$str = '	
		<option value="">Chọn Xã/Phường</option>';
		foreach ($result_value as $key => $value) {
			$str.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		echo $str;
	}
	if ($type_get == 'street') {
		$result_value = $db->query("select id,name from #_place_street where shows=1 and id_dist='".$id_get."' order by name asc");
		$str = '	
		<option value="">Chọn Đường/Phố</option>';
		foreach ($result_value as $key => $value) {
			$str.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		echo $str;
	}
?>