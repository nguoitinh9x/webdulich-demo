<?php
    $id = $_GET['id'];  
    $select_field = "id,type,slug,name_$lang,photo,price,oldprice,promotion";

    if($id){
        $db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$id));
        $row_detail  =  $db->row("select * from #_post where shows=:shows and type=:type and slug=:slug");

        $per_page = 12;
        $startpoint = ($page * $per_page) - $per_page;
        $limit = ' limit '.$startpoint.','.$per_page;
        
        $where = " #_product where shows=:shows and type=:type and FIND_IN_SET(".$row_detail['id'].",tags)";
        $where .= " order by number,datecreate desc ";

        $arr_dpo = array("shows"=>1,"type"=>"product");
        $db->bindMore($arr_dpo);
        $item  =  $db->query("select $select_field from $where $limit");

        $json_code .= $json->ItemList($com,$item);

        $url = $func->getCurrentPageURL();
        $paging = $func->pagination($where,$per_page,$page,$url,$arr_dpo);


        $title_detail = 'Tags : <span class="text-color">" '. $row_detail["name_$lang"].' "</span>';
    }
