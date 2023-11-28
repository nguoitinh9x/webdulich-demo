<?php	
switch($act){

	case "man_list":
		get_lists();
		$template = "cate/list/items";
		break;
	case "add_list":		
		$template = "cate/list/item_add";
		break;
	case "edit_list":		
		get_list();
		$template = "cate/list/item_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;	
	#===================================================
	case "man_cat":
		get_cats();
		$template = "cate/cat/items";
		break;
	case "add_cat":		
		$template = "cate/cat/item_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "cate/cat/item_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;	
	#===================================================
	case "man_item":
		get_items();
		$template = "cate/item/items";
		break;
	case "add_item":		
		$template = "cate/item/item_add";
		break;
	case "edit_item":		
		get_item();
		$template = "cate/item/item_add";
		break;
	case "save_item":
		save_item();
		break;
	case "delete_item":
		delete_item();
		break;
	#===================================================
	case "man_sub":
		get_subs();
		$template = "cate/sub/items";
		break;
	case "add_sub":		
		$template = "cate/sub/item_add";
		break;
	case "edit_sub":		
		get_sub();
		$template = "cate/sub/item_add";
		break;
	case "save_sub":
		save_sub();
		break;
	case "delete_sub":
		delete_sub();
		break;	
	
	default:
		$template = "index";
}

#=================List===================
function get_lists(){

		global $db,$func,$items, $paging,$page;
		$per_page = 100; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_cate_list ";
		$where .= " where type=:type ";

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name_vi LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by number,id desc";

		$arr_dpo['type'] = $_GET['type'];
		$db->bindMore($arr_dpo);
	    $items  =  $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);		
		
	}

	function get_list(){
		global $db,$func, $item,$ds_tags,$ds_photo;
		$id = $_GET['id'];
		if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

		$db->bindMore(array("id"=>$id));
	    $item  =  $db->row("select * from #_cate_list where id=:id");
	    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	}

	function save_list(){
		global $db,$func,$config;


		if($_REQUEST['xoaanh']=='xoaanh'){
			$func->delete_file(_upload_cate.$item['photo']);
			$func->delete_file(_upload_cate.$item['thumb']);
			$db->bindMore(array("id"=>$_REQUEST['id']));
			$db->query("UPDATE table_cate_list SET photo ='',thumb ='' WHERE id=:id ");
			$func->transfer("Đã xóa ảnh ! ", $_SESSION['links_re']);
		}
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_cate,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_cate,$file_name,_style_thumb);
			if($id){
				$db->setTable('cate_list');
				$db->setWhere('id',$id);
				$db->setType('row');
				$row = $db->select('photo,thumb');
				if($row){
					$func->delete_file(_upload_cate.$row['photo']);	
					$func->delete_file(_upload_cate.$row['thumb']);				
				}
			}	
		}

		foreach ($config['lang'] as $key => $value) {
			$data['name_'.$key] = $_POST['name_'.$key];
			$data['description_'.$key] = $_POST['description_'.$key];
			$data['content_'.$key] = $_POST['content_'.$key];
		}

		if($_POST['slug']){
			$data['slug'] = $_POST['slug'];
		} else {
			$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		}
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['number'] = $_POST['number'];
		$data['type'] = $_GET['type'];
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");
		if($id){

			

			$db->setTable('cate_list');
			$db->setWhere('id', $id);
			$db->update($data);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('cate_list');
			$db->insert($data);
			$func->redirect($_SESSION['links_re']);
		}

	}

	function delete_list(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select id,photo,thumb from #_cate_list where id=:id ");
			
			if($row){
				$func->delete_file(_upload_cate.$row['photo']);
				$func->delete_file(_upload_cate.$row['thumb']);
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_cate_list where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}

#=================cat===================
function get_cats(){

		global $db,$func,$items, $paging,$page;
		$per_page = 100; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		

		$where = " #_cate_cat ";
		$where .= " where type=:type ";

		if($_REQUEST['id_list']!='')
		{
			$where.=" and id_list = :id_list ";
			$arr_dpo['id_list'] = $_GET['id_list'];
		}

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name_vi LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by number,id desc";

		$arr_dpo['type'] = $_GET['type'];
		$db->bindMore($arr_dpo);
	    $items  =  $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);		
		
	}

	function get_cat(){
		global $db,$func,$item,$ds_tags,$ds_photo;
		$id = $_GET['id'];
		if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

		$db->bindMore(array("id"=>$id));
	    $item  =  $db->row("select * from #_cate_cat where id=:id");
	    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	}

	function save_cat(){
		global $db,$func,$config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_cate,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_cate,$file_name,_style_thumb);
			if($id){
				$db->setTable('cate_cat');
				$db->setWhere('id',$id);
				$db->setType('row');
				$row = $db->select('photo,thumb');
				if($row){
					$func->delete_file(_upload_cate.$row['photo']);	
					$func->delete_file(_upload_cate.$row['thumb']);				
				}
			}	
		}

		foreach ($config['lang'] as $key => $value) {
			$data['name_'.$key] = $_POST['name_'.$key];
			$data['description_'.$key] = $_POST['description_'.$key];
			$data['content_'.$key] = $_POST['content_'.$key];
		}
		$data['id_list'] = $_POST['id_list'];
		if($_POST['slug']){
			$data['slug'] = $_POST['slug'];
		} else {
			$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		}
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['number'] = $_POST['number'];
		$data['type'] = $_GET['type'];
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");
		if($id){

			$db->setTable('cate_cat');
			$db->setWhere('id', $id);
			$db->update($data);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('cate_cat');
			$db->insert($data);
			$func->redirect($_SESSION['links_re']);
		}

	}

	function delete_cat(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select id,photo,thumb from #_cate_cat where id=:id ");
			
			if($row){
				$func->delete_file(_upload_cate.$row['photo']);
				$func->delete_file(_upload_cate.$row['thumb']);
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_cate_cat where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}

#=================Item===================
function get_items(){

		global $db,$func,$items,$paging,$page;
		$per_page = 100; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_cate_item ";
		$where .= " where type=:type ";

		if($_REQUEST['id_list']!='')
		{
			$where.=" and id_list = :id_list ";
			$arr_dpo['id_list'] = $_GET['id_list'];
		}

		if($_REQUEST['id_cat']!='')
		{
			$where.=" and id_cat = :id_cat ";
			$arr_dpo['id_cat'] = $_GET['id_cat'];
		}

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name_vi LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by number,id desc";

		$arr_dpo['type'] = $_GET['type'];
		$db->bindMore($arr_dpo);
	    $items  =  $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);		
		
	}

	function get_item(){
		global $db,$func,$item,$ds_tags,$ds_photo;
		$id = $_GET['id'];
		if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

		$db->bindMore(array("id"=>$id));
	    $item  =  $db->row("select * from #_cate_item where id=:id");
	    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	}

	function save_item(){
		global $db,$func,$config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_cate,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_cate,$file_name,_style_thumb);
			if($id){
				$db->setTable('cate_item');
				$db->setWhere('id',$id);
				$db->setType('row');
				$row = $db->select('photo,thumb');
				if($row){
					$func->delete_file(_upload_cate.$row['photo']);	
					$func->delete_file(_upload_cate.$row['thumb']);				
				}
			}	
		}

		foreach ($config['lang'] as $key => $value) {
			$data['name_'.$key] = $_POST['name_'.$key];
			$data['description_'.$key] = $_POST['description_'.$key];
			$data['content_'.$key] = $_POST['content_'.$key];
			$data['shortname_'.$key] = $_POST['shortname_'.$key];
		}
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_list'] = $_POST['id_list'];
		if($_POST['slug']){
			$data['slug'] = $_POST['slug'];
		} else {
			$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		}
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['number'] = $_POST['number'];
		$data['type'] = $_GET['type'];
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");
		if($id){

			

			$db->setTable('cate_item');
			$db->setWhere('id', $id);
			$db->update($data);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('cate_item');
			$db->insert($data);
			$func->redirect($_SESSION['links_re']);
		}

	}

	function delete_item(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select id,photo,thumb from #_cate_item where id=:id ");
			
			if($row){
				$func->delete_file(_upload_cate.$row['photo']);
				$func->delete_file(_upload_cate.$row['thumb']);
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_cate_item where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}
#=================Sub===================
function get_subs(){

		global $db,$func,$items, $paging,$page;
		$per_page = 100; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_cate_sub ";
		$where .= " where type=:type ";

		if($_REQUEST['id_list']!='')
		{
			$where.=" and id_list = :id_list ";
			$arr_dpo['id_list'] = $_GET['id_list'];
		}

		if($_REQUEST['id_cat']!='')
		{
			$where.=" and id_cat = :id_cat ";
			$arr_dpo['id_cat'] = $_GET['id_cat'];
		}

		if($_REQUEST['id_item']!='')
		{
			$where.=" and id_item = :id_item ";
			$arr_dpo['id_item'] = $_GET['id_item'];
		}

		if($_REQUEST['keyword']!='')
		{
			$where.=" and name_vi LIKE :keyword ";
			$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		}
		$where .=" order by number,id desc";

		$arr_dpo['type'] = $_GET['type'];
		$db->bindMore($arr_dpo);
	    $items  =  $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);		
		
	}

	function get_sub(){
		global $db,$func,$item,$ds_tags,$ds_photo;
		$id = $_GET['id'];
		if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

		$db->bindMore(array("id"=>$id));
	    $item  =  $db->row("select * from #_cate_sub where id=:id");
	    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	}

	function save_sub(){
		global $db,$func,$config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
		$file_name=$func->images_name($_FILES['file']['name']);
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		
		if($photo = $func->upload_image("file",_img_type,_upload_cate,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = $func->create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_cate,$file_name,_style_thumb);
			if($id){
				$db->setTable('cate_sub');
				$db->setWhere('id',$id);
				$db->setType('row');
				$row = $db->select('photo,thumb');
				if($row){
					$func->delete_file(_upload_cate.$row['photo']);	
					$func->delete_file(_upload_cate.$row['thumb']);				
				}
			}	
		}

		foreach ($config['lang'] as $key => $value) {
			$data['name_'.$key] = $_POST['name_'.$key];
			$data['description_'.$key] = $_POST['description_'.$key];
			$data['content_'.$key] = $_POST['content_'.$key];
		}
		
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_list'] = $_POST['id_list'];
		$data['id_item'] = $_POST['id_item'];
		if($_POST['slug']){
			$data['slug'] = $_POST['slug'];
		} else {
			$data['slug'] = $func->changeTitle($_POST['name_'.$config['activelang']]);
		}
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['number'] = $_POST['number'];
		$data['type'] = $_GET['type'];
		$data['shows'] = isset($_POST['shows']) ? 1 : 0;
		$data['dateupdate'] = date("Y-m-d H:i:s");
		if($id){

			$db->setTable('cate_sub');
			$db->setWhere('id', $id);
			$db->update($data);
			$func->redirect($_SESSION['links_re']);
			
		} else {
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('cate_sub');
			$db->insert($data);
			$func->redirect($_SESSION['links_re']);
		}

	}

	function delete_sub(){
		global $db,$func;
		$listid = explode(",",$_GET['listid']); 
		$type = $_GET['type'];
		for ($i=0 ; $i<count($listid) ; $i++){
			$id=$listid[$i]; 
			$db->bindMore(array("id"=>$id));
			$row = $db->row("select id,photo,thumb from #_cate_sub where id=:id ");
			
			if($row){
				$func->delete_file(_upload_cate.$row['photo']);
				$func->delete_file(_upload_cate.$row['thumb']);
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_cate_sub where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}
#====================================
?>