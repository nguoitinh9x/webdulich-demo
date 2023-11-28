<?php
switch($act){
	#===================================================
	case "man":
		get_mans();
		$template = "link/items";
		break;
	case "add":		
		$template = "link/item_add";
		break;
	case "edit":		
		get_man();
		$template = "link/item_add";
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
		
		$where = " #_link ";
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
		global $db,$func,$item;
		$id = $_GET['id'];
		if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

		$db->bindMore(array("id"=>$id));
	    $item  =  $db->row("select * from #_link where id=:id");
	    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	}

	function save_man(){
		global $db,$func,$config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
			if ($id) {
				$db->setTable('link');
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
		}

		$data['attributes'] = json_encode($_POST['attributes'],JSON_UNESCAPED_UNICODE);
		
		if($_POST['slug']){
			$data['slug'] = $_POST['slug'];
		} else {
			$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		}
		$data['ficon'] = $_POST['ficon'];
		$data['number'] = $_POST['number'];
		$data['link'] = $_POST['link'];
		$data['type'] = $_GET['type'];
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");
		if($id){
			

			$db->setTable('link');
			$db->setWhere('id', $id);
			$db->update($data);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('link');
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
			$row = $db->row("select id,photo,thumb from #_link where id=:id ");
			if($row){
				$func->delete_file(_upload_hinhanh.$row['photo']);
				$func->delete_file(_upload_hinhanh.$row['thumb']);
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_link where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}


?>