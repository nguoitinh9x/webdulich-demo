<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	 
	
/*	$expired = '2019-10-12 0:0:0';
	$expired = strtotime($expired);
	if (time() >= $expired) {if ($_REQUEST['com']=='') {header("Location: cip.php"); die(); } }*/
	
	defined( 'ROOT' ) ?:  define( 'ROOT', __DIR__);
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	require_once ROOT . '/Library/autoload.php';
?>