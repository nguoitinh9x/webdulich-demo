<?php

switch($act){
	case "man_city":
		get_citys();
		$template = "place/citys";
		break;
	case "add_city":		
		$template = "place/city_add";
		break;
	case "edit_city":		
		get_city();
		$template = "place/city_add";
		break;
	case "save_city":
		save_city();
		break;
	case "delete_city":
		delete_city();
		break;

	case "man_dist":
		get_dists();
		$template = "place/dists";
		break;
	case "add_dist":		
		$template = "place/dist_add";
		break;
	case "edit_dist":		
		get_dist();
		$template = "place/dist_add";
		break;
	case "save_dist":
		save_dist();
		break;
	case "delete_dist":
		delete_dist();
		break;	


	case "man_ward":
		get_wards();
		$template = "place/wards";
		break;
	case "add_ward":		
		$template = "place/ward_add";
		break;
	case "edit_ward":		
		get_ward();
		$template = "place/ward_add";
		break;
	case "save_ward":
		save_ward();
		break;
	case "delete_ward":
		delete_ward();
		break;	

	case "man_street":
		get_streets();
		$template = "place/streets";
		break;
	case "add_street":		
		$template = "place/street_add";
		break;
	case "edit_street":		
		get_street();
		$template = "place/street_add";
		break;
	case "save_street":
		save_street();
		break;
	case "delete_street":
		delete_street();
		break;	
	
	default:
		$template = "index";
}

#====================================
function get_citys(){
	global $db,$func,$items, $paging,$page;
	$per_page = 20; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_place_city ";
	$where .= " where id!=:id ";

	if($_REQUEST['keyword']!='')
	{
		$where.=" and name LIKE :keyword ";
		$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
	}
	$where .=" order by id desc";

	$arr_dpo['id'] = 0;
	$db->bindMore($arr_dpo);
    $items  =  $db->query("select * from $where $limit");

	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);	
	
}

function get_city(){
	global $db,$func,$item,$ds_photo;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

	$db->bindMore(array("id"=>$id));
    $item  =  $db->row("select * from #_place_city where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
}

function save_city(){
	global $db,$func,$config;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$data['name'] = $_POST['name'];
	$data['slug'] = $func->changeTitle($_POST['name']);
	$data['number'] = $_POST['number'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");
	if($id){
		$db->setTable('place_city');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
		
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('place_city');
		$db->insert($data);
		$func->redirect($_SESSION['links_re']);
	}
}

function delete_city(){
	global $db,$func;
	$listid = explode(",",$_GET['listid']); 
	for ($i=0 ; $i<count($listid) ; $i++){
		$id=$listid[$i]; 
		$db->bindMore(array("id"=>$id));
		$db->query("delete from #_place_city where id=:id ");
	}
	$func->redirect($_SESSION['links_re']);
}
#====================================
function get_dists(){
	global $db,$func,$items, $paging,$page;
	$per_page = 20; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_place_dist ";
	$where .= " where id!=:id ";

	if($_REQUEST['keyword']!='')
	{
		$where.=" and name LIKE :keyword ";
		$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
	}
	$where .=" order by id desc";

	$arr_dpo['id'] = 0;
	$db->bindMore($arr_dpo);
    $items  =  $db->query("select * from $where $limit");

	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);		
	
}

function get_dist(){
	global $db,$func,$item,$ds_photo;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

	$db->bindMore(array("id"=>$id));
    $item  =  $db->row("select * from #_place_dist where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
}

function save_dist(){
	global $db,$func,$config;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$data['name'] = $_POST['name'];
	$data['id_city'] = $_POST['id_city'];
	$data['slug'] = $func->changeTitle($_POST['name']);
	$data['number'] = $_POST['number'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");
	if($id){
		$db->setTable('place_dist');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
		
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('place_dist');
		$db->insert($data);
		$func->redirect($_SESSION['links_re']);
	}
}

function delete_dist(){
	global $db,$func;
	$listid = explode(",",$_GET['listid']); 
	for ($i=0 ; $i<count($listid) ; $i++){
		$id=$listid[$i]; 
		$db->bindMore(array("id"=>$id));
		$db->query("delete from #_place_dist where id=:id ");
	}
	$func->redirect($_SESSION['links_re']);
}
#====================================
function get_wards(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_ward SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_ward");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_ward SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_ward");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_place_ward where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=place&act=man_ward");			
		}
		
		
	}
		
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_place_ward where id='".$id_up."' ";
	$db->query($sql_sp);
	$cats= $db->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_ward SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_ward SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
		
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" where ten LIKE '%$keyword%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_ward $where";
	$db->query($sql);	
	$dem=$db->fetch_array();
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
	
	$sql = "SELECT * from #_place_ward $where order by id limit $bg,$pageSize";		
	$db->query($sql);
	$items = $db->result_array();	
	$url_link='index.php?com=place&act=man_ward';		
	
}

function get_ward(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward");	
	$sql = "select * from #_place_ward where id='".$id."'";
	$db->query($sql);
	if($db->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_ward");
	$item = $db->fetch_array();	
	
}

function save_ward(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['id_dist'] = (int)$_POST['id_dist'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$db->setTable('place_ward');
		$db->setWhere('id', $id);
		if($db->update($data)){						
			redirect("index.php?com=place&act=man_ward&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_ward");
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];
		$data['id_dist'] = (int)$_POST['id_dist'];		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$db->setTable('place_ward');
		if($db->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_ward");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_ward");
	}
}

function delete_ward(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$db->reset();		
		$sql = "delete from #_place_ward where id='".$id."'";
	
		

		if($db->query($sql))
			redirect("index.php?com=place&act=man_ward".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_ward");
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward");
}
#====================================
function get_streets(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_street SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_street");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_street SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_street");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_place_street where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=place&act=man_street");			
		}
		
		
	}
		
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_place_street where id='".$id_up."' ";
	$db->query($sql_sp);
	$cats= $db->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_street SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_street SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
		
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" where ten LIKE '%$keyword%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_street $where";
	$db->query($sql);	
	$dem=$db->fetch_array();
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
	
	$sql = "SELECT * from #_place_street $where order by id limit $bg,$pageSize";		
	$db->query($sql);
	$items = $db->result_array();	
	$url_link='index.php?com=place&act=man_street';		
	
}

function get_street(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street");	
	$sql = "select * from #_place_street where id='".$id."'";
	$db->query($sql);
	if($db->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_street");
	$item = $db->fetch_array();	
	
}

function save_street(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['id_dist'] = (int)$_POST['id_dist'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$db->setTable('place_street');
		$db->setWhere('id', $id);
		if($db->update($data)){						
			redirect("index.php?com=place&act=man_street&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_street");
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];
		$data['id_dist'] = (int)$_POST['id_dist'];		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$db->setTable('place_street');
		if($db->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_street");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_street");
	}
}

function delete_street(){
	global $db;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$db->reset();		
		$sql = "delete from #_place_street where id='".$id."'";
	
		

		if($db->query($sql))
			redirect("index.php?com=place&act=man_street".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_street");
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street");
}
?>