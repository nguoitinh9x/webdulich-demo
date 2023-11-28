<?php

$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_user'])) ? "&id_user=".addslashes($_REQUEST['id_user']) : "";
$urldanhmuc.= (isset($_REQUEST['datefm'])) ? "&id_user=".addslashes($_REQUEST['datefm']) : "";
$urldanhmuc.= (isset($_REQUEST['dateto'])) ? "&id_user=".addslashes($_REQUEST['dateto']) : "";
$urldanhmuc.= (isset($_REQUEST['status'])) ? "&status=".addslashes($_REQUEST['status']) : "";

$id=$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "order/items";
		break;
	case "add":		
		$template = "order/item_add";
		break;
	case "edit":		
		get_item();
		$template = "order/item_add";
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
		
		$where = " #_order ";
		$where .= " where id!=:id ";

		$ngaybd = $_GET['ngaybd'];
		$ngaykt = $_GET['ngaykt'];
		$sotien = $_GET['sotien'];
		$httt = $_GET['httt'];
		$status = $_GET['tinhtrang'];

		if($httt)
		{
			$where.=" and type_payment = :type_payment ";
			$arr_dpo['type_payment'] = $httt;
		}

		if($status)
		{
			$where.=" and status = :status ";
			$arr_dpo['status'] = $status;
		}

		if($_REQUEST['id_list']!='')
		{
			$where.=" and id_list = :id_list ";
			$arr_dpo['id_list'] = $_GET['id_list'];
		}

		if($ngaybd)
		{
			$where.=" and datecreate >= :ngaybd ";
			$arr_dpo['ngaybd'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$ngaybd)));
		}

		if($ngaykt)
		{
			$where.=" and datecreate <= :ngaykt ";
			$arr_dpo['ngaykt'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$ngaykt)));
		}

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by id desc";

		$arr_dpo['id'] = 0;
		$db->bindMore($arr_dpo);
		// print_r($arr_dpo);
		// echo "select * from $where $limit";
	    $items  =  $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);	
}

function get_item(){
	global $db,$func,$item,$result_ctdonhang;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.html?com=order&act=man");

	$db->bindMore(array("id"=>$id));
    $item  =  $db->row("select * from #_order where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);

	$db->bindMore(array("id_order"=>$item['id']));
    $result_ctdonhang = $db->query("select * from #_order_detail where id_order = :id_order");

    $db->bindMore(array("id"=>$id));
    $db->query("UPDATE table_order SET view =1 WHERE  id = :id");
}

function save_item(){
	global $db,$func;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.html?com=order&act=man");
	$id = $_POST['id'];
	if($id){
		$data['note'] = $_POST['note'];
		$data['status'] = $_POST['id_tinhtrang'];
		if($data['status'] == 8){
			for($i=0;$i<count($_POST['idproduct']);$i++){
				$result_sl = $db->query("select amount from #_product where id = '".$_POST['idproduct'][$i]."'");
				$slton = $result_sl['amount'] - $_POST['amount'][$i];
				$db->bindMore(array("amount"=>$slton,"id"=>$_POST['idproduct'][$i]));
				$db->query("UPDATE table_product SET amount =:amount WHERE  id = :id");
			}
		}	

		$db->setTable('order');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
	}
}

function delete_item(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 

			$db->bindMore(array("id"=>$id));
			$db->query("delete from #_order_detail where id_order=:id ");

			$db->bindMore(array("id"=>$id));
			$db->query("delete from #_order where id=:id ");

		}
		$func->redirect($_SESSION['links_re']);
	}

?>