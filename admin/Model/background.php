<?php

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "background/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
	default:
		$template = "index";
}

function get_gioithieu(){
	global $db,$func,$item;

	$type = $_GET['type'];
	$db->bindMore(array("type"=>$type));
	$item  =  $db->row("select * from #_bgweb where type=:type limit 0,1");

	if($_REQUEST['xoaanh']!='' && $item){
		$id_up = $_REQUEST['xoaanh'];
		$func->delete_file(_upload_hinhanh.$item['photo']);
		$func->delete_file(_upload_hinhanh.$item['thumb']);
		$db->bindMore(array("type"=>$type));
		$db->query("UPDATE table_bgweb SET photo ='',thumb ='' where type=:type ");
		$func->transfer("Đã xóa ảnh ! ", "index.php?com=background&act=capnhat&type=".$_GET['type']);
	}
}

function save_gioithieu(){
	global $db,$func;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=background&act=capnhat&type=".$_GET['type']);
	$type = $_GET['type'];
	$file_name=$func->images_name($_FILES['file']['name']);

	$db->bindMore(array("type"=>$type));
	$row_item = $db->row("select * from #_bgweb where type=:type");
	$id = $row_item['id'];
	if($photo = $func->upload_image("file", _img_type,_upload_hinhanh,$file_name)){
		$data['photo'] = $photo;
		$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
		if($row_item){
			$db->setTable('bgweb');
			$db->setWhere('id',$id);
			$db->setType('row');
			$row = $db->select('photo,thumb');
			if($row){
				$func->delete_file(_upload_hinhanh.$row['photo']);	
				$func->delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}
	}

	$data['re_peat'] = $_POST['re_peat'];
	$data['waytop'] = $_POST['waytop'];
	$data['wayleft'] = $_POST['wayleft'];
	$data['wayright'] = $_POST['wayright'];
	$data['waybottom'] = $_POST['waybottom'];
	$data['fix_bg'] = $_POST['fix_bg'];
	$data['bgcolor'] = $_POST['bgcolor']; 
	$data['type'] = $_GET['type'];
	$data['dateupdate'] = date("Y-m-d H:i:s");
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;

	if($row_item){
		$db->setTable('bgweb');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('bgweb');
		$db->insert($data);
		$func->redirect($_SESSION['links_re']);
	}
	
}
