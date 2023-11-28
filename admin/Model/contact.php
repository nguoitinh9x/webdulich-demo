<?php
switch($act){

	case "man":
		get_items();
		$template = "contact/items";
		break;
	case "add":		
		$template = "contact/item_add";
		break;
	case "edit":		
		get_item();
		$template = "contact/item_add";
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

#====================================

function get_items(){
	global $db,$func,$items, $paging,$page;
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_contact ";
	$where .= " where type=:type ";

	if($_REQUEST['keyword']!='')
	{
		$where.=" and name LIKE :keyword ";
		$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
	}
	$where .=" order by id desc";

	$arr_dpo['type'] = $_GET['type'];
	$db->bindMore($arr_dpo);
    $items  =  $db->query("select * from $where $limit");

	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);			
	
}

function get_item(){
	global $db,$func,$item,$ds_tags;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);	
	
	$db->bindMore(array("id"=>$id));
    $item  =  $db->row("select * from #_contact where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);	

    $db->bindMore(array("id"=>$id));
    $db->query("UPDATE table_contact SET view =1 WHERE  id = :id");
}

function save_item(){
	global $db,$func;

	if(empty($_POST)) transfer("Không nhận được dữ liệu",$_SESSION['links_re']);
	$id = $_POST['id'];
	$data['note'] = $_POST['note'];
	$data['number'] = $_POST['number'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");

	if($id){
		$db->setTable('contact');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('contact');
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
			$row = $db->row("select * from #_contact where id=:id ");
			if($row){
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_contact where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}
?>