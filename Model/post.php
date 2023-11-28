<?php
	@$idl =  $_GET['idl'];
	@$idc =  $_GET['idc'];
	@$id =  $_GET['id'];
	#các sản phẩm khác======================
	$select_field = "name_$lang,slug,id,thumb,photo,description_$lang,datecreate,view,type";
	if($id!=''){

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$id));
		$row_detail  =  $db->row("select * from #_post where shows=:shows and type=:type and slug=:slug");

		$tags = explode(",", $row_detail['tags']) ;

	    $db->bindMore(array("shows"=>1,"type"=>$type_bar,"id_cate"=>$row_detail['id']));
		$item_photos = $db->query("select thumb,id,photo from #_cate_photo where shows=:shows and type=:type and id_cate=:id_cate order by number,id desc");

		$func->daxem($row_detail['id']);
		$func->luotxem('post',$row_detail['id']);

		$json_code .= $json->BreadcrumbList($row_detail,'post',$com,$type_bar,$title_com,0);
		$json_code .= $json->NewsArticle($row_detail);

		$share_facebook = '<meta property="og:url" content="'.$get_nows.'" />';
		$share_facebook .= '<meta property="og:title" content="'.$row_detail['name_'.$lang].'" />';
		$share_facebook .= '<meta property="og:description" content="'.$row_detail['description_'.$lang].'" />';
		$share_facebook .= '<meta property="og:image" content="'._BASEURL_.'/'._upload_post_l.$row_detail['photo'].'" />';

		$db->bindMore(array("shows"=>1,"type"=>$type_bar));
		$list_news = $db->query("select id,slug,name_$lang from #_cate_list where shows=:shows and type=:type order by number,datecreate desc");

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"id_list"=>$row_detail['id_list'],"id"=>$row_detail['id']));
		$item = $db->query("select $select_field from #_post where shows=:shows and type=:type and id_list=:id_list and id!=:id order by number,datecreate desc");

		$title_detail .= $title_com;

		$title_bar .= $row_detail['title'];
		if($row_detail['title']=='') $title_bar .= $row_detail['name_'.$lang];

		$keywords_bar .= $row_detail['keywords'];
		if($row_detail['keywords']=='') $keywords_bar .= $row_detail['description_'.$lang];

		$description_bar .= $row_detail['description'];
		if($row_detail['description']=='') $description_bar .= $row_detail['description_'.$lang];

	} elseif($idl!=''){

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$idl));
		$row_detail  =  $db->row("select * from #_cate_list where shows=:shows and type=:type and slug=:slug");

		$per_page = 12; // Set how many records do you want to display per page .
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_post where shows=:shows and type=:type and id_list=:id_list ";
		$where .= $where_tk;
		$where .= " order by number,datecreate desc ";

		$arr_dpo = array("type"=>$type_bar,"shows"=>1,"id_list"=>$row_detail['id']);
		$db->bindMore($arr_dpo);
		$item  =  $db->query("select $select_field from $where $limit");

		$json_code .= $json->ItemList($com,$item);

		$url = $get_nows;
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

		$func->luotxem('cate_list',$row_detail['id']);

		$title_detail = $row_detail['name_'.$lang];
		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];

	} elseif($idc!=''){

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$idc));
		$row_detail  =  $db->row("select * from #_cate_cat where shows=:shows and type=:type and slug=:slug");

		$per_page = 12; // Set how many records do you want to display per page .
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_post where shows=:shows and type=:type and id_cat=:id_cat ";
		$where .= $where_tk;
		$where .= " order by number,datecreate desc ";

		$arr_dpo = array("type"=>$type_bar,"shows"=>1,"id_cat"=>$row_detail['id']);
		$db->bindMore($arr_dpo);
		$item  =  $db->query("select $select_field from $where $limit");

		$json_code .= $json->ItemList($com,$item);

		$url = $get_nows;
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

		$func->luotxem('cate_cat',$row_detail['id']);

		$title_detail = $row_detail['name_'.$lang];
		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];
	} else {
		
		$per_page = 12; // Set how many records do you want to display per page .
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_post where shows=:shows and type=:type ";
		$where .= $where_tk;
		$where .= " order by number,datecreate desc ";

		$arr_dpo = array("type"=>$type_bar,"shows"=>1);
		$db->bindMore($arr_dpo);
		$item  =  $db->query("select $select_field from $where $limit");

		$json_code .= $json->ItemList($com,$item);

		$url = $get_nows;
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

		$title_detail = $title_com;
	}
	if (count($item)==1) {
		header('Location: '._BASEURL_.$item[0]['type'].'/'.$item[0]['slug']);
	}