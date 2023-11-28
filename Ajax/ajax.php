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

	@$act = $_POST['act'];

    switch($act){
		//-------------capnhat------------------
		case 'rating':
			$ip = $_SERVER['REMOTE_ADDR'];
			$db->bindMore(array("com"=>$_POST['com'],"id_product"=>$_POST['id_product']));
			$row = $db->row("select * from #_review where com=:com and id_product=:id_product and ip='".$ip."' ");
			if(!$row){
				if(isset($_POST['star'])){
					$data['star'] = $_POST['star'];
					$data['content'] = $_POST['content'];
					$data['name'] = $_POST['fullname'];
					$data['id_product'] = $_POST['id_product'];
					$data['com'] = $_POST['com'];
					$data['iduser'] = $_POST['iduser'];
					$data['ip'] = $ip;
					$data['datecreate'] = date('Y-m-d H:i:s');
					$db->setTable('review');
					if($db->insert($data))
						echo 0;
					else
						echo 2;
				}
			} else {
				echo 3;
			}
			break;

		case 'like':
			$ip = $_SERVER['REMOTE_ADDR'];
			$db->bindMore(array("type"=>$_POST['tbl'],"id_product"=>$_POST['id_product']));
			$row = $db->row("select * from #_like where type=:type and id_product=:id_product and ip='".$ip."' ");
			if(!$row){
				if(isset($_POST['tbl'])){
					$data['type'] = $_POST['tbl'];
					$data['id_product'] = $_POST['id_product'];
					$data['iduser'] = $_POST['iduser'];
					$data['ip'] = $ip;
					$data['datecreate'] = date('Y-m-d H:i:s');
					$db->setTable('like');
					$db->insert($data);

					$db->bindMore(array("type"=>$_POST['tbl'],"id_product"=>$_POST['id_product']));
					$dem_like = $db->row("select count(*) as tong from #_like where type=:type and id_product=:id_product");
					echo count($dem_like);
				}
			} else {
				echo 0;
			}
			break;

		case 'capnhat':
			break;
			
	
		default: 
			
			break;

	}