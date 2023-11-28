<?php
switch($act){
	case "man":
		get_photos();
		$template = "photo/items";
		break;
	case "add":		
		$template = "photo/item_add";
		break;
	case "edit":
		get_photo();
		$template = "photo/item_add";
		break;
	case "save":
		save_photo();
		break;
	case "delete":
		delete_photo();
		break;			
	default:
		$template = "index";
}

function get_photos(){
	global $db,$func,$items, $paging,$page;
		$per_page = 10; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_photo ";
		$where .= " where type=:type ";

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name_vi LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by number, id desc";

		$arr_dpo['type'] = $_GET['type'];
		$db->bindMore($arr_dpo);
	    $items  =  $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);			
}

function get_photo(){
	global $db,$func,$item;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

	$db->bindMore(array("id"=>$id));
    $item = $db->row("select * from #_photo where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
}

function save_photo(){
	global $db,$config,$func;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = $_POST['id'];

	foreach ($config['lang'] as $key => $value) {
		$file_name=$func->images_name($_FILES['file_'.$key]['name']);
		if($photo = $func->upload_image("file_".$key,_img_type, _upload_hinhanh,$file_name)){
			$data['photo_'.$key] = $photo;
			$data['thumb_'.$key] = $func->create_thumb($data['photo_'.$key], _width_thumb, _height_thumb , _upload_hinhanh,$file_name,_style_thumb);
			if($id){
				$db->setTable('photo');
				$db->setType('row');
				$db->setWhere('id', $id);
				$row = $db->select();
				if($row){
					$func->delete_file(_upload_hinhanh.$row['photo_'.$key]);
					$func->delete_file(_upload_hinhanh.$row['thumb_'.$key]);
				}
			}	
		}

		$file_name2=$func->images_name($_FILES['file2_'.$key]['name']);
		if($photo2 = $func->upload_image("file2_".$key,_img_type, _upload_hinhanh,$file_name2)){
			$data['photo2_'.$key] = $photo2;
			if($id){
				$db->setTable('photo');
				$db->setType('row');
				$db->setWhere('id', $id);
				$row = $db->select();
				if($row){
					$func->delete_file(_upload_hinhanh.$row['photo2_'.$key]);
				}
			}	
		}

		$data['name_'.$key] = $_POST['name_'.$key];
		$data['description_'.$key] = $_POST['description_'.$key];
	}
	$data['youtube'] = $_POST['youtube'];
	$data['number'] = $_POST['number'];
	$data['link'] = $_POST['link'];	
	$data['type'] = $_POST['type'];	
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;

	if($id){

		

		$db->setTable('photo');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
		
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('photo');
		$db->insert($data);
		$func->redirect($_SESSION['links_re']);
	}
	
}

function delete_photo(){
	global $db,$func,$config;
	$listid = explode(",",$_GET['listid']); 
	$type = $_GET['type'];
	for ($i=0 ; $i<count($listid) ; $i++){
		$id=$listid[$i]; 
		$db->bindMore(array("id"=>$id));
		$row = $db->row("select * from #_photo where id=:id ");
		if($row){
			foreach ($config['lang'] as $key => $value) {
				$func->delete_file(_upload_hinhanh.$row['photo_'.$key]);
				$func->delete_file(_upload_hinhanh.$row['thumb_'.$key]);
			}
			$db->bindMore(array("id"=>$id));
			$db->query("delete from #_photo where id=:id ");
		}
	}
	$func->redirect($_SESSION['links_re']);
}

?>	