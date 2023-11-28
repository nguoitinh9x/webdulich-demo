<?php
switch($act){
	case "man":
		get_mails();
		$template = "newsletter/items";
		break;
	case "add":
		$template = "newsletter/item_add";
		break;
	case "edit":
		get_mail();
		$template = "newsletter/item_add";
		break;	
	case "send":
		send();
		break;
	case "save":
		save_mail();
		break;	
	case "delete":
		delete();
		break;	
	default:
		$template = "index";
}

function get_mails(){
	global $db, $items, $func;
	$items  =  $db->query("select * from #_newsletter order by id desc");
	if(!$items) { $func->transfer("Dữ liệu chưa khởi tạo.", "index.html"); }
}

function get_mail(){
	global $db, $item, $func;
	$id = $_GET['id'];

	$db->bindMore(array("id"=>$id));
	$item  =  $db->row("select * from #_newsletter where id=:id");

	$db->bindMore(array("id"=>$id));
    $db->query("UPDATE table_newsletter SET view =1 WHERE  id = :id");
    

	if(!$item) { $func->transfer("Dữ liệu không có thực", "index.html?com=newsletter&act=man"); }

}

function save_mail(){
	global $db, $func;
	if(empty($_POST)) transfer("Không nhận được dữ liệu",$_SESSION['links_re']);
	$id = $_POST['id'];
	$data['note'] = $_POST['note'];
	$data['number'] = $_POST['number'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");
	if($id){
		$db->setTable('newsletter');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('newsletter');
		$db->insert($data);
		$func->redirect($_SESSION['links_re']);
	}
}

function delete(){
	global $db,$func;
	if(isset($_GET['id'])){
		$id =  $_GET['id'];
		$db->bindMore(array("id"=>$id));
		$db->query("delete from #_newsletter where id=:id");
		$func->redirect("index.html?com=newsletter&act=man");
	} else {
		$func->transfer("Không nhận được dữ liệu", "index.html?com=newsletter&act=man");
	}
}
function send(){
	global $db, $func;
	$file_name= $func->changeTitle($_FILES['file']['name']);
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.html?com=newsletter&act=man");
	if($file = $func->upload_image("file",_download_type, _upload_download, $file_name)){
		$data['file'] = $file;
	}
	$Setting  =  $db->row("select * from #_setting limit 1");
	if(isset($_POST['listid'])){
		require dirname(dirname(__DIR__)).'/Library/phpMailer/class.phpmailer.php';
		$mail = new PHPMailer();

		$mail->Host       = 'localhost'; // tên SMTP server
		$mail->SMTPAuth   = false; // Sử dụng đăng nhập vào account
		$mail->Port 	  = 25; // SMTP account username

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom(C_EMAIL, $_POST['name']);
		$listid = explode(",", $_POST['listid']); 
		for ($i=0 ; $i<count($listid); $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select email from #_newsletter where id=:id");
			if($row){
				$mail->AddAddress($row['email'], $Setting['name_vi']);
			}
		}
		/*=====================================
		* THIET LAP NOI DUNG EMAIL
		*=====================================*/
		//Thiết lập tiêu đề
		$mail->Subject    = $_POST['name'];
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	
		$body = $_POST['content'];
		$mail->Body = $body;
		if($data['file']){
			$mail->AddAttachment(_upload_download.$data['file']);
		}
		if($mail->Send())
			$func->transfer("Thông tin đã được gửi đi.", "index.html?com=newsletter&act=man");
		else
			$func->transfer("Hệ thống bị lỗi, xin thử lại sau.", "index.html?com=newsletter&act=man");
	}
}

?>