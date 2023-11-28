<?php
	@$id = $_GET['id'];

	$db->bindMore(array("shows"=>1,"type"=>$type_bar,"slug"=>$id));
	$row_detail = $db->row("select * from #_post where shows=:shows and type=:type and slug=:slug");

	$db->bindMore(array("type"=>$type_bar,"id_cate"=>$row_detail['id']));
	$ab_photos = $db->query("select photo from #_cate_photo where type=:type and id_cate=:id_cate order by number,datecreate desc");

	$title_detail = $row_detail['name_vi'];

    /* $album = $db->query("select name_$lang,slug,photo,datecreate from #_post where shows=1 and type='album' order by number,datecreate desc");
    $video = $db->query("select name_vi,link,photo from #_video where shows=1 and type='video' order by number,datecreate asc");  */

