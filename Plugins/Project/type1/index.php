<?php
    $db->bindMore(array("shows"=>1,"type"=>"project","highlight"=>1));
    $listp = $db->query("select id,name_$lang from #_cate_list where shows=:shows and type=:type and highlight=:highlight order by number,id desc");
?>

<div id="project" class="py-5 clearfix">
    <div class="title-style-1 clearfix">
        <p>Thực hiện</p>
        <h2>Dự án nổi bật</h2>
    </div>

    <div class="container">
        <ul class="listp">
            <?php foreach ($listp as $key => $vl):?>
                <li data-idl="<?=$vl['id']?>" class="choose_idl"><?=$vl["name_$lang"]?></li>
            <?php endforeach ?>
        </ul>

        <div id="show_product"></div>
    </div>
</div>
