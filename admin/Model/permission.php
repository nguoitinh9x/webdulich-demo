<?php
switch($act){
	case "man":
		get_items();
		$template = "permission/items";
		break;
	case "add":
		$template = "permission/item_add";
		break;
	case "edit":
		get_item();
		$template = "permission/item_add";
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

function get_items(){
	global $db,$func,$items, $paging,$page;
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_permission ";
	$where .=" order by number,id desc";
    $items  =  $db->query("select * from $where $limit");

	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);	

}

function get_item(){
	global $db,$func,$item;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=permission&act=man");

	$db->bindMore(array("id"=>$id));
    $item  =  $db->row("select * from #_permission where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
}

function save_item(){
	global $db,$func;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=permission&act=man");
	$id = $_POST['id'];
	$data['name'] = $_POST['name'];
	$data['amount'] = $_POST['amount'];
	$data['color'] = $_POST['color'];
	
	if($_POST['id_list']!=''){
		$data['id_list'] = json_encode($_POST['id_list']);
	} else {
		$data['id_list'] = '';
	}
	if($_POST['id_cat']!=''){ 
		$data['id_cat'] = json_encode($_POST['id_cat']);
	} else {
		$data['id_cat'] = '';
	}
	if($_POST['id_item']!=''){
		$data['id_item'] = json_encode($_POST['id_item']);
	} else {
		$data['id_item'] = '';
	}
	
	if($_POST['xem']!=''){
		$data['views'] = json_encode($_POST['xem']);
	} else {
		$data['views'] = '';
	}
	if($_POST['xoa']!=''){
		$data['deletes'] = json_encode($_POST['xoa']);
	} else {
		$data['deletes'] = '';
	}
	if($_POST['sua']!=''){
		$data['edits'] = json_encode($_POST['sua']);
	} else {
		$data['edits'] = '';
	}
	if($_POST['them']!=''){
		$data['adds'] = json_encode($_POST['them']);
	} else {
		$data['adds'] = '';
	}
	
	$data['number'] = $_POST['number'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");

	if($id){
		$db->setTable('permission');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
		
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('permission');
		$db->insert($data);
		$func->redirect($_SESSION['links_re']);
	}

}

function delete_item(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select * from #_permission where id=:id ");
			if($row){
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_permission where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}


?>