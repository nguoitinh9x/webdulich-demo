<?php
switch($act){
	case "login":
		$template = "user/login";
		break;
	case "admin_edit":
		edit();
		$template = "user/admin_add";
		break;
	case "logout":
		logout();
		break;	
	case "man":
		get_items();
		$template = "user/items";
		break;
	case "add":
		$template = "user/item_add";
		break;
	case "edit":
		get_item();
		$template = "user/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	default:
		$template = "index";
}

//////////////////
function get_items(){
	global $db,$func, $items, $paging ,$page;
	
	if($_SESSION['login']['role']!='3'){
		$func->transfer("Chỉ có admin mới được vào mục này . ", "index.html");
	}
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$arr_dpo['role'] = 1;
	$db->bindMore($arr_dpo);
	$where = " #_user where role=:role order by username ";

	$items = $db->query("select * from $where $limit");

	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);
}

function get_item(){
	global $db,$func,$item,$quyenhang;
	
	if($_SESSION['login']['role']!='3'){
		$func->transfer("Chỉ có admin mới được vào mục này . ", "index.html");
	}
	$id = $_GET['id'];
	if(!$id) { $func->transfer("Không nhận được dữ liệu", "index.html?com=user&act=man"); }

	$db->bindMore(array("id"=>$id));
    $item = $db->row("select * from #_user where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
    
}

function save_item(){
	global $db,$func;
	if($_SESSION['login']['role']!='3'){
		$func->transfer("Chỉ có admin mới được vào mục này . ", "index.html");
	}
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.html?com=user&act=man");
	$id = $_POST['id'];

	$data['username'] = $_POST['username'];
	if($_POST['oldpassword']!=""){
		$data['password'] = $func->encrypt_password($_POST['oldpassword']);
	}
	$data['email'] = $_POST['email'];
	$data['name'] = $_POST['name'];
	$data['sex'] = $_POST['sex'];
	$data['phone'] = $_POST['phone'];
	$data['skype'] = $_POST['skype'];
	$data['address'] = $_POST['address'];
	$data['country'] = $_POST['country'];
	$data['city'] = $_POST['city'];
	$data['permission'] = $_POST['permission'];
	$data['role'] = $_POST['role'];
	$data['number'] = $_POST['number'];
	$data['dateupdate'] = date("Y-m-d H:i:s");
	if($id){
		$db->setTable('user');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
		
	} else {
		$db->bindMore(array("username"=>$_POST['username']));
		$row = $db->row("select * from #_user where username=:username");
		if(!$row){
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('user');
			$db->insert($data);
			$func->redirect($_SESSION['links_re']);
		} else {
			$func->transfer("Error : Username tồn tại . ","index.html?com=user&act=add");
		}
	}
	
}

function delete_item(){
		global $db,$func;
		if($_SESSION['login']['role']!='3'){
			$func->transfer("Chỉ có admin mới được vào mục này . ", "index.html");
		}
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select * from #_user where id=:id ");
			if($row){
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_user where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}

///////////////////////

function edit(){
	global $db,$func,$item, $login_name;
	
	if(!empty($_POST)){
		$db->bindMore(array("username"=>$_SESSION['login']['username'],"username2"=>$_POST['username']));
		$row = $db->row("select * from #_user where username!=:username and username=:username2 and role=3");
		if($row){
			$func->transfer("Tên đăng nhập này đã có","index.html?com=user&act=admin_edit");
		}
		
		$db->bindMore(array("username"=>$_SESSION['login']['username']));
		$row = $db->row("select * from #_user where username=:username");
		if($row){
			if($row['password'] != $func->encrypt_password($_POST['oldpassword'])) $func->transfer("Mật khẩu không chính xác","index.html?com=user&act=admin_edit");
		} else {
			die('Hệ thống bị lỗi. Xin liên hệ với admin. <br>Cám ơn.');
		}
		
		$data['username'] = $_POST['username'];
		if($_POST['new_pass']!=""){
			$data['password'] = $func -> encrypt_password($_POST['new_pass']);
		}
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['phone'] = $_POST['phone'];
		$data['number'] = 1;
		$db->setTable('user');
		$db->setWhere('id',$row['id']);
		$db->update($data);
		session_unset();
		$func->redirect("index.html");
	}
	$db->bindMore(array("username"=>$_SESSION['login']['username']));
	$item  =  $db->row("select * from #_user where username=:username");
}
	
function logout(){
	global $login_name,$func;
	$_SESSION['login'] = '';
	$_SESSION[$login_name] = false;
	$func->transfer("Đăng xuất thành công", "index.html?com=user&act=login");
}
?>