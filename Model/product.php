<?php
	@$idl =  $_GET['idl'];
	@$idc =  $_GET['idc'];
	@$idi =  $_GET['idi'];
	@$id =  $_GET['id'];
	#các sản phẩm======================
	$select_field = "name_$lang,slug,id,thumb,price,oldprice,photo,promotion,description_$lang,type,code,attributes,highlight";
	
	if($id!=''){
		$plugin_css .= \Library\plugins::addcss(ROOT."/Assets/addons/magiczoomplus/magiczoomplus.css");

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$id));
		$row_detail  =  $db->row("select * from #_product where shows=:shows and type=:type and slug=:slug");

		$tags = explode(",", $row_detail['tags']);
		
		$attributes = json_decode($row_detail['attributes'],true);
		$row_star = $db->query("select * from #_review where com='".$com."' and id_product='".$row_detail['id']."' ");
		$tongsao = 0;
		for($i=0;$i<count($row_star);$i++){
			$tongsao = $tongsao + $row_star[$i]['star'];
		}
		if(count($row_star)>0){
			$num_star = round($tongsao/count($row_star),1);
		}

		$db->bindMore(array("type"=>$type_bar,"id_cate"=>$row_detail['id']));
		$item_photos  =  $db->query("select thumb,id,photo from #_cate_photo where type=:type and id_cate=:id_cate order by number,datecreate desc");

		$db->bindMore(array("type"=>"muahang"));
		$chinhsach_bv  =  $db->row("select content_$lang from #_info where type=:type");

		$func->daxem($row_detail['id']);
		$func->luotxem('product',$row_detail['id']);

		$json_code .= $json->BreadcrumbList($row_detail,'product','san-pham','product','Sản phẩm',2);
		$json_code .= $json->Product($row_detail,count($row_star),$num_star);
		$json_code .= $json->Review($row_detail,count($row_star),$num_star);

		$luotmua = $db->row("select COUNT(*) as tong from #_order_detail where id_product='".$row_detail['id']."' ");

		$share_facebook = '<meta property="og:url" content="'.$get_nows.'" />';
		$share_facebook .= '<meta property="og:title" content="'.$row_detail['name_'.$lang].'" />';
		$share_facebook .= '<meta property="og:description" content="'.$row_detail['description_'.$lang].'" />';
		$share_facebook .= '<meta property="og:image" content="'._SITEURL_.'/'._upload_product_l.$row_detail['photo'].'" />';

		// San pham khac .
		$per_page = 8; 
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		$where = " #_product where shows=:shows and type=:type and id_list=:id_list and id!=:id ";
		$where .= $where_tk;
		$where .= " order by number,datecreate desc ";
		$arr_dpo = array("shows"=>1,"type"=>$type_bar,"id_list"=>$row_detail['id_list'],"id"=>$row_detail['id']);
		$db->bindMore($arr_dpo);
		$item  =  $db->query("select $select_field from $where $limit");
		$json_code .= $json->ItemList($com,$item);
		$url = $get_nows;
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

		$title_detail = 'Chi tiết sản phẩm';

		$title_bar .= $row_detail['title'];
		if($row_detail['title']=='') $title_bar .= $row_detail['name_'.$lang];

		$keywords_bar .= $row_detail['keywords'];
		if($row_detail['keywords']=='') $keywords_bar .= $row_detail['description_'.$lang];

		$description_bar .= $row_detail['description'];
		if($row_detail['description']=='') $description_bar .= $row_detail['description_'.$lang];

	} elseif($idl!=''){

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$idl));
		$row_detail  =  $db->row("select * from #_cate_list where shows=:shows and type=:type and slug=:slug");

		$per_page = 20; // Set how many records do you want to display per page .
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_product where shows=:shows and type=:type and id_list=:id_list ";
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

		$per_page = 20; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_product where shows=:shows and type=:type and id_cat=:id_cat  order by number,id desc";

		$arr_dpo = array("shows"=>1,"type"=>$type_bar,"id_cat"=>$row_detail['id']);
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

	} elseif($idi!=''){
		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$idi));
		$row_detail  =  $db->row("select * from #_cate_item where shows=:shows and type=:type and slug=:slug");

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"id"=>$row_detail['id_list']));
		$row_detail_list  =  $db->row("select * from #_cate_list where shows=:shows and type=:type and id=:id");

		$db->bindMore(array("shows"=>1,"type"=>$type_bar,"id"=>$row_detail['id_cat']));
		$row_detail_cat  =  $db->row("select * from #_cate_cat where shows=:shows and type=:type and id=:id");

		$per_page = 16; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_product where shows=:shows and type=:type and id_item=:id_item  order by number,id desc";
		$arr_dpo = array("shows"=>1,"type"=>$type_bar,"id_item"=>$row_detail['id']);
		$db->bindMore($arr_dpo);
		$item  =  $db->query("select $select_field from $where $limit");

		$json_code .= $json->ItemList($com,$item);

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

		$title_detail = $row_detail['name_'.$lang];
		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];
	} else {
		
		$per_page = 20; // Set how many records do you want to display per page .
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		if($com=='co-gi-moi'){
			$where = " #_product where shows=:shows and type=:type and promotion=1 ";
		}else{
			$where = " #_product where shows=:shows and type=:type ";
		}
		$where .= $where_tk;
		$where .= " order by number,datecreate desc ";

		$arr_dpo = array("type"=>$type_bar,"shows"=>1);
		$db->bindMore($arr_dpo);
		$item = $db->query("select $select_field from $where $limit");

		$json_code .= $json->ItemList($com,$item);

		$url = $get_nows;
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);

		$title_detail = $title_com;
	}
?>