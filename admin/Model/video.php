<?php
switch($act){
	#===================================================
	case "man":
		get_mans();
		$template = "video/items";
		break;
	case "add":		
		$template = "video/item_add";
		break;
	case "edit":		
		get_man();
		$template = "video/item_add";
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
		
		$where = " #_video ";
		$where .= " where type=:type ";

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name_vi LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by id desc";

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
	    $item  =  $db->row("select * from #_video where id=:id");
	    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	}

	function save_man(){
		global $db,$func,$config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_video,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_video,$file_name,_style_thumb);	
			if($id){
				$db->setTable('video');
				$db->setWhere('id',$id);
				$db->setType('row');
				$row = $db->select('photo,thumb');
				if($row){
					$func->delete_file(_upload_video.$row['photo']);	
					$func->delete_file(_upload_video.$row['thumb']);				
				}
			}
		}

		foreach ($config['lang'] as $key => $value) {
			$data['name_'.$key] = $_POST['name_'.$key];
		}

		$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		$data['link'] = $_POST['link'];
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$data['number'] = $_POST['number'];
		$data['type'] = $_GET['type'];
		
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");
		if($id){
			
			$db->setTable('video');
			$db->setWhere('id', $id);
			$db->update($data);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('video');
			$db->insert($data);
			$func->redirect($_SESSION['links_re']);
		}

	}


	function delete_man(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 

			$db->bindMore(array("id"=>$id));
			$row = $db->row("select id,photo,thumb from #_video where id=:id ");
			
			if($row){
				$func->delete_file(_upload_video.$row['photo']);
				$func->delete_file(_upload_video.$row['thumb']);
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_video where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}


?>