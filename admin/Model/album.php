<?php
switch($act){
	#===================================================
	case "man":
	get_mans();
	$template = "album/items";
	break;
	case "add":		
	$template = "album/item_add";
	break;
	case "edit":		
	get_man();
	$template = "album/item_add";
	break;
	case "save":
	save_man();
	break;
	case "delete":
	delete_man();
	break;	
	default:
	$template = "index";
}

#====================================

function get_mans(){

	global $db,$func,$items, $paging,$page;
		$per_page = 10; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_album ";
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

	function get_man(){
		global $db,$func,$item,$ds_photo;
		$id = $_GET['id'];
		if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

		$db->bindMore(array("id"=>$id));
		$item  =  $db->row("select * from #_album where id=:id");
		if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);

		$db->bindMore(array("type"=>$_GET['type'],"id_cate"=>$id));
	    $ds_photo = $db->query("select * from #_cate_photo where id_cate=:id_cate and type=:type order by number,id desc");
	}

	function save_man(){
		global $db,$func,$config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);

		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_album,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_album,$file_name,_style_thumb);
			if($id){
				$db->setTable('album');
				$db->setWhere('id',$id);
				$db->setType('row');
				$row = $db->select('photo,thumb');
				if($row){
					$func->delete_file(_upload_album.$row['photo']);	
					$func->delete_file(_upload_album.$row['thumb']);				
				}
			}	
		}
		foreach ($config['lang'] as $key => $value) {
			$data['name_'.$key] = $_POST['name_'.$key];
		}

		$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		$data['number'] = $_POST['number'];
		$data['id_list'] = $_POST['id_list'];
		$data['type'] = $_GET['type'];
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");

		if($id){
			$db->setTable('album');
			$db->setWhere('id', $id);
			$db->update($data);
			multi_upload($id);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('album');			
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
					//dongdauanh($data['photo'],_upload_post);
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

	function delete_man(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];

		if(isset($_GET['listid'])==true)
		{
			for ($i=0 ; $i<count($listid) ; $i++){
				$id=$listid[$i]; 
				$db->bindMore(array("id"=>$id));
				$row = $db->row("select id,photo,thumb from #_album where id=:id ");
				if($row){
					$func->delete_file(_upload_album.$row['photo']);
					$func->delete_file(_upload_album.$row['thumb']);
					$db->bindMore(array("id"=>$id));
					$db->query("delete from #_album where id=:id ");
				}
			}
			$func->redirect($_SESSION['links_re']);
		}
		else{			
				$id=$_GET['id']; 
				$db->bindMore(array("id"=>$id));
				$row = $db->row("select id,photo,thumb from #_album where id=:id ");
				if($row){
					$func->delete_file(_upload_album.$row['photo']);
					$func->delete_file(_upload_album.$row['thumb']);
					$db->bindMore(array("id"=>$id));
					$db->query("delete from #_album where id=:id ");
				}
			$func->redirect($_SESSION['links_re']);
		}
	}
?>