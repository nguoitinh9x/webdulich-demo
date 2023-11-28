<?php
    $db->bindMore(array("shows"=>1,"type"=>"album"));
    $gridAlbum = $db->query("select link, name_$lang, photo_vi as photo from #_photo where shows=:shows and type=:type order by number,id desc");
?>

<div id="boxGrid" class="clearfix">
    <div class="title-style-1 clearfix"><h2>Hình ảnh</h2></div>
    <div class="container">
        <div class="gridPhoto clearfix">
            <?php foreach ($gridAlbum as $key => $value): ?>
                <div class="items">
                    <a class="effect-v9" href="<?= $value['link'] ?>">
                        <img src="<?=_upload_hinhanh_l.($key==1 ? '285x410x1/' : '580x410x1/').$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>">
                    </a>
                    <div class="caption">
                        <h3><?= $value["name_$lang"] ?></h3>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>