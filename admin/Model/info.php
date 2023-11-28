<?php	
switch($act){
	case "capnhat":
		get_info();
		$template = "info/item_add";
		break;
	case "save":
		save_info();
		break;		
	default:
		$template = "index";
}

function get_info(){
	global $db,$func,$item,$ds_photo;
	$type = $_GET['type'];

	$db->bindMore(array("type"=>$type));
	$item  =  $db->row("select * from #_info where type=:type limit 0,1");

	$id = $item['id'];

	$db->bindMore(array("type"=>$_GET['type'],"id_cate"=>$id));
	$ds_photo  =  $db->query("select * from #_cate_photo where id_cate=:id_cate and type=:type order by number,id desc");
}

function save_info(){
	global $db,$config,$func,$getPost;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

	$type = $_GET['type'];
	$file_name=$func->images_name($_FILES['file']['name']);

	$db->bindMore(array("type"=>$type));
	$row_item = $db->row("select * from #_info where type=:type ");

	$id = $row_item['id'];

	if($photo = $func->upload_image("file",_img_type, _upload_hinhanh,$file_name)){
		$data['photo'] = $photo;	
		$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
		if($id){
			$id = $row_item['id'];
			$db->setTable('info');
			$db->setWhere('id',$id);
			$db->setType('row');
			$row = $db->select('photo,thumb');
			if($row){
				$func->delete_file(_upload_hinhanh.$row['photo']);	
				$func->delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}	
	}

	foreach ($config['lang'] as $key => $value) {
		$data['name_'.$key] = $_POST['name_'.$key];
		$data['description_'.$key] = $_POST['description_'.$key];
		$data['content_'.$key] = $_POST['content_'.$key];
		//$data['content_'.$key] = $getPost->strip_word_html($_POST['content_'.$key],$_POST['name_'.$key],$data['slug']);
	}

	$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);

	$data['attributes'] = $func->raw_json_encode($_POST['attributes']);
	
	$data['title'] = $_POST['title'];
	$data['keywords'] = $_POST['keywords'];
	$data['description'] = $_POST['description'];
	
	$data['number'] = $_POST['number'];
	$data['shows'] = isset($_POST['shows']) ? 1 : 0;
	$data['dateupdate'] = date("Y-m-d H:i:s");
	$data['type'] = $type;
	if($row_item){

		$db->setTable('info');
		$db->setWhere('id', $id);
		$db->update($data);
		multi_upload($id);
		$func->redirect($_SESSION['links_re']);
		
	} else {
		$data['datecreate'] = date("Y-m-d H:i:s");
		$db->setTable('info');
		$db->insert($data);
		multi_upload($db->InsertId());
		$func->redirect($_SESSION['links_re']);
	}


}

	function multi_upload($id){
		global $db,$func;
		if (isset($_FILES['files'])) {
            for($i=0;$i<count($_FILES['files']['name']);$i++){
            	if($_FILES['files']['name'][$i]!=''){

					$file['name'] = $_FILES['files']['name'][$i];
					$file['type'] = $_FILES['files']['type'][$i];
					$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$file['error'] = $_FILES['files']['error'][$i];
					$file['size'] = $_FILES['files']['size'][$i];
				    $file_name = $func->images_name($_FILES['files']['name'][$i]);
					$photo = $func->upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_cate,$file_name);
					$data['photo'] = $photo;
					//dongdauanh($data['photo'],_upload_hinhanh);
					$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_cate,$file_name,_style_thumb);
					$data['number'] = (int)$_POST['stthinh'][$i];
					$data['type'] = $_GET['type'];	
					$data['id_cate'] = $id;
					$data['shows'] = 1;
					$db->setTable('cate_photo');
					$db->insert($data);
				}
			}
        }
	}

?>