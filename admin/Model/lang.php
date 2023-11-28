<?php
switch($act){
	case "man":
		get_mans();
		$template = "lang/items";
		break;
	case "add":		
		$template = "lang/item_add";
		break;
	case "edit":		
		get_man();
		$template = "lang/item_add";
		break;
	case "save":
		save_man();
		break;
	case "update":
		update_lang();
		break;
	case "delete":
		delete_man();
		break;
	#============================================================
	default:
		$template = "index";
}

#====================================update lang
function update_lang(){
	global $db,$func,$config;
	foreach ($config['lang'] as $key => $value) {
		$langfile = "../Upload/lang/lang_".$key.".json";
		#================create lang file
		$row = $db->query("select name,type_".$key." from #_lang");
		for($i=0;$i<count($row);$i++){
			$arr_json[$row[$i]['name']] = $row[$i]['type_'.$key];
		}
		create_json($langfile,$arr_json);
	}
	$func->transfer("Cập nhật dữ liệu Thành công !", $_SESSION['links_re']);
}

function create_json($path,$arr=array()){
	$fp = fopen($path, 'w');
	fwrite($fp, json_encode($arr));
	fclose($fp);
}

#====================================

function get_mans(){
	global $db,$func,$items, $paging,$page,$config;

	$per_page = 50; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_lang ";

	if($_GET['keyword']!='')
	{
		$where.=" where name LIKE :keyword ";
		foreach ($config['lang'] as $key => $value) {
			$where.=" or type_$key LIKE :type_$key ";
			$arr_dpo['type_'.$key] = '%'.$_GET['keyword'].'%';
		}
		$arr_dpo['keyword'] = '%'.$_GET['keyword'].'%';
		$db->bindMore($arr_dpo);
	}
	$where .=" order by id desc";

    $items  =  $db->query("select * from $where $limit");

	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

}

function get_man(){
	global $db,$func,$item,$ds_tags,$ds_photo;
	$id = $_GET['id'];
	if(!$id) $func->transfer("Không nhận được dữ liệu", $_SESSION['links_re']);

	$db->bindMore(array("id"=>$id));
    $item  =  $db->row("select * from #_lang where id=:id");
    if(!$item) $func->transfer("Dữ liệu không có thực", $_SESSION['links_re']);
}

function save_man(){
	global $db,$func,$config;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu",$_SESSION['links_re']);
	$id = $_POST['id'];
	/*save*/
	$data['name'] =$_POST['name'];
	foreach ($config['lang'] as $key => $value) {
		$data['type_'.$key] = $_POST['type_'.$key];
	}
	/*save*/
	if($id){
		$db->setTable('lang');
		$db->setWhere('id', $id);
		$db->update($data);
		$func->redirect($_SESSION['links_re']);
	}else{
		$db->setTable('lang');
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
			$row = $db->row("select * from #_lang where id=:id ");
			if($row){
				$db->bindMore(array("id"=>$id));
				$db->query("delete from #_link where id=:id ");
			}
		}
		$func->redirect($_SESSION['links_re']);
	}