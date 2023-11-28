<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package Simple Nina Framework
	 * @author  Hiếu Nguyễn <nguyenhieunina@gmail.com>
	 * @version 1.0.0
	 * @license http://nina.vn
	 */
	defined( 'ROOT' ) ?:  define( 'ROOT', dirname(__DIR__));
	defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );
	require_once ROOT . '/Library/autoload.php';
	
	$email=$_POST['email'];
	$act=$_POST['act'];
	
	switch ($act) {
		case 'duan':
			if(isset($_POST['email'])){
				$data['name'] = $_POST['ten'];
				$data['email'] = $_POST['email'];
				$data['phone'] = $_POST['dienthoai'];
				$data['content'] = $_POST['noidung'];
				$data['title'] = $_POST['duan'];
				$data['type'] = 'contact';
				$data['datecreate'] = date("Y-m-d H:i:s");
				$db->setTable('contact');
				if($db->insert($data))
					echo 0;
				else
					echo 2;
			}
			break;
		
		default:
			$maill =$db->query("select id from #_newsletter where email='".$_POST['email']."'");
			if(count($maill)!=0){
				echo 1;
			} else {

				if(isset($_POST['email'])){
					$data['email'] = $_POST['email'];
					$data['phone'] = $_POST['dienthoai'];
					$data['content'] = $_POST['noidung'];
					$data['sex'] = $_POST['gioitinh'];
					$data['datecreate'] = date("Y-m-d H:i:s");
					$db->setTable('newsletter');
					if($db->insert($data))
						echo 0;
					else
						echo 2;
				}
				
			}
			break;
	}
	
		

?>

