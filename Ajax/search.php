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

	$type = $_POST['type'];
	$id_list = $_POST['id_list'];

	if ($type == 'list') {
		$result_value = $db->query("select id,name_vi from #_cate_cat where shows=1 and id_list='".$id_list."' order by id desc");
		$str = '	
		<option value="">Tìm kiếm theo dòng xe</option>';
		foreach ($result_value as $key => $value) {
			$str.='<option value="'.$value['id'].'">'.$value['name_vi'].'</option>';
		}
		echo $str;
	}
?>