<?php 
	$db->bindMore(array("type"=>$type_bar));
    $row_detail = $db->row("select * from #_info where type=:type");

    $title_detail .= $title_com;
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
?>