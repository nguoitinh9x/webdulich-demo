<?php
switch($act){
	
	case "capnhat":
		get_banner();
		$template = "bannerqc/item_add";
		break;
	case "save":
		save_banner();
		break;
	#====================================
	
	default:
		$template = "index";
}


function get_banner(){
	global $db,$item;
	$type = $_GET['type'];
	$db->bindMore(array("type"=>$type));
	$item  =  $db->row("select * from #_photo where type=:type");
}

function save_banner(){
	global $db,$func,$config;
	
	$type = $_GET['type'];
	$db->bindMore(array("type"=>$type));
	$item = $db->row("select * from #_photo where type=:type");
	$id=$item['id'];
		
	foreach ($config['lang'] as $key => $value) {
		$file_name=$func->images_name($_FILES['file_'.$key]['name']);
		if($photo = $func->upload_image("file_".$key,_img_type, _upload_hinhanh,$file_name)){
			$data['photo_'.$key] = $photo;
			$data['thumb_'.$key] = $func->create_thumb($data['photo_'.$key], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);
			if($item){
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
		$data['name_'.$key] = $_POST['name_'.$key];
	}

	$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
	$data['link'] = $_POST['link'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");
	$data['type'] = $type;

	if($item){

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

?>