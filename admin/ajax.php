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

	$do = (isset($_REQUEST['do'])) ? addslashes($_REQUEST['do']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	switch ($do) {
		case 'admin':
		if($act=='login'){
			$username = $_POST['email'];
			$password = $_POST['pass'];
			$secretKey ='6LfzH3YUAAAAAO3fS-Irvr0xwebj_9-xrZcxioeu';
			$recaptcha = isset($_POST['recaptcha']) ? $_POST['recaptcha'] : '';
			/*if($recaptcha==='') {
				echo '{"mess":"Bạn cần xác nhận không là Robot!"}';
				die();
			}
			$ip = $_SERVER['REMOTE_ADDR'];
			$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$recaptcha."&remoteip=".$ip);
			$responseKeys = json_decode($response,true);
			if(intval($responseKeys["success"]) !== 1) {
				echo '{"mess":"Lỗi bảo mật xảy ra! Vui lòng thao tác lại!"}';
				die();
			}*/

			$db->bindMore(array("username"=>$username));
			$row  =  $db->row("select * from #_user where username=:username");
			if($row){
				if($row['password'] == $func->encrypt_password($password)){
					$_SESSION[$login_name] = true;
					$_SESSION['login']['role'] = $row['role'];
					$_SESSION['login']['type'] = $row['type'];
					$_SESSION['login']['quyen'] = $row['quyen'];
					$_SESSION['isLoggedIn'] = true;
					$_SESSION['login']['username'] = $username;
					echo '{"page":"index.html"}';
				} else echo '{"mess":"Mật khẩu không chính xác!"}';
			} else echo '{"mess":"Tên đăng nhập không tồn tại!"}';
		}
		break;

		case 'number':
		if($act=='update'){
			$table=$_POST['table'];
			$id=$_POST['id'];
			$num=(int)$_POST['num'];
			$db->bindMore(array("stt"=>$num,"id"=>$id));
			$row  =  $db->query("update #_$table set stt=:stt where id=:id");
		}
		break;

		case 'status':
		if($act=='update'){						
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);
			$field=addslashes($_POST['field']);
				//$db->bindMore(array("stt"=>$num,"id"=>$id));
	    		//$row  =  $db->query("update #_$table set $field =  where id='$id' ");

			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_cart));
			echo json_encode($cart);
		}
		break;

		case 'cart':
		if($act=='update'){						
			$id=(int)$_POST['id'];
			$sl=(int)$_POST['sl'];

			$db->bindMore(array("soluong"=>$sl,"id"=>$id));
			$db->query("update #_order_detail set soluong=:soluong where id=:id ");			

			$db->bindMore(array("id"=>$id));
			$result = $db->row("select * from #_order_detail where id=:id ");	

			$thanhtien=$result['gia']*$result['soluong'];
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_cart));
			echo json_encode($cart);
		}
		if($act=='delete'){						
			$id=(int)$_POST['id'];			
			$db->bindMore(array("id"=>$id));
			$db->row("delete from #_order_detail where id=:id ");	

			$db->bindMore(array("id"=>$id));
			$result = $db->row("select * from #_order_detail where id=:id ");					
			$cart=array('tongtien'=>$func->get_tong_tien($id_cart));
			echo json_encode($cart);

		}
		break;
		
		default:
		echo "default";
		break;
	}	
?>