<?php
	if(!empty($_POST)){
		$idl = $_POST['idl'];
		$date = $_POST['date'];
		$key = trim($_POST['name']);
		$key_khong_dau = $func->changeTitle($key);
		$diemkhoihanh = trim($_POST['diemkhoihanh']);
		$diemden = trim($_POST['diemden']);

		$per_page = 20;
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		$where = " #_post where shows=:shows and type='tour' ";

		if($idl!=''){
			$row_detail = $db->row("select * from #_cate_list where shows=1 and type='tour' and id=$idl ");
			$where.=" and id_list=$idl ";
		}
		if($key!=''){
			$where.=" and ( name_$lang like :key or slug like :key_khong_dau ) ";
			$arr_pdo['key'] = "%".$key."%";
			$arr_pdo['key_khong_dau'] = "%".$key_khong_dau."%";
		}
		if($date!=''){
			$where.=" and ( datein = :date ) ";
			$arr_pdo['date'] = $date;
		}
		if($diemkhoihanh!=''){
			$where.=" and ( diemkhoihanh like :diemkhoihanh ) ";
			$arr_pdo['diemkhoihanh'] = "%".$diemkhoihanh."%";
		}
		if($diemden!=''){
			$where.=" and ( diemden like :diemden ) ";
			$arr_pdo['diemden'] = "%".$diemden."%";
		}
		$where .= " order by number,id desc";
		$arr_pdo['shows']=1;
		$db->bindMore($arr_pdo);
		$item = $db->query("select * from $where $limit");

		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($where,$per_page,$page,$url,$arr_pdo);

		if($idl!='' && $key==''){
			$title_detail = 'Tìm kiếm: <span class="text-warning">" '. $row_detail["name_$lang"].' "</span> - <span class="text-warning">" '. $diemkhoihanh.' "</span> - <span class="text-warning">" '. $diemden.' "</span>';
		}elseif($key!='' && $idl=='') {
			$title_detail .= 'Tìm kiếm: <span class="text-warning">" '. $key.' "</span>';
		}else{
			$title_detail = '<span class="text-warning">" '. $row_detail["name_$lang"].' "</span> - Tìm kiếm : <span class="text-warning">" '. $key.' "</span> - Khởi hành : <span class="text-warning">" '.date('d/m/Y', strtotime( $date )).' "</span>' ;
		}
	}
