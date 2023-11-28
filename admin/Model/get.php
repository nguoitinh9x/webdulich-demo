<?php
switch($act){
	#===================================================
	case "man":
		//get_mans();
		//get_sanphams();
		//get_details();
		$template = "get/items";
		break;
}

#====================================
function get_mans(){
	global $db,$func,$items, $paging,$page;

	if($_POST['noidung']!=''){
		$content = str_replace("'","",$_POST['noidung']);
		$content = explode('<li class="nav-item',$content);

		for ($i = 1; $i <=5 ; $i++) {
			$linklist = explode('<a class="nav-item-link" href="/',$content[$i]);
			$link = explode('"',$linklist[1]);

			$Namelist = explode('<span class="nav-item-link-title">',$content[$i]);
			$name = explode('</span>',$Namelist[1]);

			$data['name_vi'] = $name[0];
			$data['slug'] = $func->changeTitle($name[0]);
			$data['number'] = 1;
			$data['type'] = 'product';
			$data['links'] = $link[0];
			$data['shows'] = 1;
			$data['dateupdate'] = date("Y-m-d H:i:s");
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('cate_list');
			$db->insert($data);
			$id_list = $db->InsertId();

			$sub = explode('<li class="sub-nav-item">',$content[$i]);
			for ($j = 1; $j <count($sub) ; $j++) {
				$linklists = explode('<a class="sub-nav-item-link" href="/',$sub[$j]);
				$links = explode('"',$linklists[1]);

				$Namelists = explode('<span class="sub-nav-item-link-title">',$sub[$j]);
				$names = explode('</span>',$Namelists[1]);
				$data1['id_list'] = $id_list;
				$data1['name_vi'] = $names[0];
				$data1['slug'] = $func->changeTitle($names[0]);
				$data1['number'] = 1;
				$data1['type'] = 'product';
				$data1['links'] = $links[0];
				$data1['shows'] = 1;
				$data1['dateupdate'] = date("Y-m-d H:i:s");
				$data1['datecreate'] = date("Y-m-d H:i:s");
				$db->setTable('cate_cat');
				$db->insert($data1);
			}

		}
	}	
	
}

function get_sanphams(){
	global $db,$func,$items, $paging,$page;

	if($_POST['noidung']!=''){
		$content = str_replace("'","",$_POST['noidung']);
		$content = explode('<div class="product-block flex column max-cols-4 min-cols-2">',$content);
		for ($i = 1; $i <=count($content) ; $i++) {
			$linklist = explode('<a href="/',$content[$i]);
			$link = explode('"',$linklist[1]);

			$namelist = explode('<h1 class="product-title">',$content[$i]);
			$name = explode('</h1>',$namelist[1]);

			$gialist = explode('<span class="current-price">',$content[$i]);
			$gia = explode('</span>',$gialist[1]);

			$gia = (int)str_replace('.','',$gia[0]);

			$data['id_list'] = $_POST['id_list'];
			$data['id_cat'] = $_POST['id_cat'];
			$data['name_vi'] = $name[0];
			$data['slug'] = $func->changeTitle($name[0]);
			$data['number'] = 1;
			$data['type'] = 'product';
			$data['links'] = $link[0];
			$data['price'] = $gia;
			$data['shows'] = 1;
			$data['dateupdate'] = date("Y-m-d H:i:s");
			$data['datecreate'] = date("Y-m-d H:i:s");
			$db->setTable('product');
			$db->insert($data);
		}
	}	
	
}

function get_details(){
	global $db,$func,$items, $paging,$page;

	if($_POST['noidung']!=''){

		$row_detail = $db->row("select * from #_product where id='".$_POST['id']."' ");

		$content = str_replace("'","",$_POST['noidung']);

		$linklists = explode('<div class="main pl-parent">',$content);
		$linklists = explode('href="',$linklists[1]);
		$linklists = explode('?',$linklists[1]);

		$linklists_tb = explode('<a class="thumbnail" href="',$content);
		for ($i = 1; $i <count($linklists_tb) ; $i++) {
			$linkthumb = explode('?',$linklists_tb[$i]);
		}

		$masp = explode('<span class="sku__value">',$content);
		$masp = explode('</span>',$masp[1]);

		$content = explode('<table class="noborder">',$content);
		$content = explode('</table>',$content[2]);

		$data['photo'] = $linklists[0];
		$data['masp'] = $masp[0];
		$data['content'] = '<table class="noborder">'.$content[0];

		print_r($data);
		exit();

	}		
	
}


?>