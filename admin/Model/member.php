<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){	

	case "man":
		get_items();
		$template = "member/items";
		break;
	case "add":
		$template = "member/item_add";
		break;
	case "edit":
		get_item();
		$template = "member/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	case "delete_img":
		delete_photo();
		break;	
	
	default:
		$template = "index";
}

//////////////////
function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_member SET active =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=member&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_member SET active =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=member&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql = "delete from table_member where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
			}
			redirect("index.php?com=member&act=man");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['active']!='')
	{
	$id_up = $_REQUEST['active'];
	$sql_sp = "SELECT id,active FROM table_member where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['active'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET active =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET active =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" where username LIKE '%$keyword%'";
	}
	
	
	$sql="SELECT count(id) AS numrows FROM #_member $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_member $where order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=member&act=man';		
	
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=member&act=man");
	
	$sql = "select * from #_member where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=member&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,15);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=member&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		$sql = "select * from #_member where id='$id'";
		$d->query($sql);		
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['id'] == 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=member&act=man");
		}	

		if($photo = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_member,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('member');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_member.$row['photo']);
			}
		}

		//Kiem tra ten dang nhap
		/*$sql = "select * from #_member where username!='".$_POST['username']."' and username='".$_POST['username']."'";
		$d->query($sql);
		if($d->num_rows()>0) transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=member&act=edit&id=".$id);
		*/
		//Kiem tra email
		$sql = "select * from #_member where email!='".$_POST['email']."' and email='".$_POST['email']."'";
		$d->query($sql);
		if($d->num_rows()>0) transfer("Email này đã có người sử dụng<br/>Xin chọn email khác.", "index.php?com=member&act=edit&id=".$id);
		
		
		/*$data['username'] = $_POST['username'];*/
		if($_POST['password']!="")
			$data['password'] = md5($_POST['password']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];

		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		
		$data['tichluy'] = $_POST['tichluy'];

		//Lưu ngày sinh
		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
		if (count($Ngay_arr)==3) {
			$ngay = $Ngay_arr[0]; //17
			$thang = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
		}	
		$ngaysinh = strtotime($ngaysinh);
		$data['ngaysinh']=$ngaysinh;
		
		$d->reset();
		$d->setTable('member');
		$d->setWhere('id', $id);		
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=member&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=member&act=man");
	
	}else{ // them moi
		
		$data['photo'] = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_member,$file_name);
		//Kiem tra ten dang nhap
		/*$sql = "select * from #_member where username='".$_POST['username']."'";
		$d->query($sql);
		if($d->num_rows()>0) transfer('Tên dăng nhập này đã có người sử dụng<br/>Xin chọn tên đăng nhập khác', 'index.php?com=member&act=add');
		*/
		//Kiem tra email
		$sql = "select * from #_member where email='".$_POST['email']."'";
		$d->query($sql);
		if($d->num_rows()>0) transfer('Email này đã có người sử dụng<br/>Xin chọn email khác', 'index.php?com=member&act=add');
		
		
		if($_POST['password']=="") transfer("Chưa nhập mật khẩu", "index.php?com=member&act=add");
		
/*		$data['username'] = $_POST['username'];*/
		$data['password'] = md5($_POST['password']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['sex'] = $_POST['sex'];
		$data['diachi'] = $_POST['diachi'];
		
		$data['tichluy'] = $_POST['tichluy'];

		//Lưu ngày sinh
		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
		if (count($Ngay_arr)==3) {
			$ngay = $Ngay_arr[0]; //17
			$thang = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
		}	
		$ngaysinh = strtotime($ngaysinh);
		$data['ngaysinh']=$ngaysinh;
		
		$data['randomkey'] = ChuoiNgauNhien(32);
		$d->setTable('member');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=member&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=member&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$sql = "select * from #_member where id='$id'";
		$d->query($sql);		
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['id'] == 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=member&act=man");
		}		
		// xoa item
		$sql = "delete from #_member where id='".$id."'";
		if($d->query($sql))
			transfer("Xóa thành viên thành công", "index.php?com=member&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=member&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=member&act=man");
}
function delete_photo(){
	global $d;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id, photo from #_member where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_member.$row['photo']);	
			}
		$sql = "UPDATE #_member SET photo ='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=member&act=edit&id=".$id);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=member&act=edit&id=".$id);
	}else transfer("Không nhận được dữ liệu", "index.php?com=member&act=edit&id=".$id);
}

?>