<?php 
    $db->bindMore(array("type"=>"tour"));
    $tour_list = $db->query("select id,name_$lang,photo from #_cate_list where shows=1 and highlight=1 and type=:type order by number,id desc");
?>

<div class="boxNews clearfix">
    <?php foreach ($tour_list as $key => $value) :
        $db->bindMore(array("type"=>"tour","id_list"=>$value['id']));
        $tour = $db->query("select id from #_post where shows=1 and highlight=1 and id_list=:id_list and type=:type order by number,id desc");
        if(count($tour)): ?>
            <div class="showproduct" data-idl="<?= $value['id'] ?>" style="background-image:url(<?= _upload_cate_l.'1366x768x1/'.$value['photo'] ?>);">
                <div class="container">
                    <div class="title-style-1 clearfix"><h2><?= $value["name_$lang"] ?></h2></div>
                    <div id="danhmuc_<?= $value['id'] ?>" rel="<?= $value['id'] ?>"></div>
                </div>
            </div>
    <?php endif; endforeach ?>
</div>