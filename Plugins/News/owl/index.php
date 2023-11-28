<?php
    $post = $db->query("select name_$lang,slug,photo,description_$lang from #_post where shows=1 and type='cam-nang-du-lich' and highlight=1 order by number,id desc");
?>

<div class="boxNew clearfix">
    <div class="title-style-2 clearfix"><h2>Cẩm nang du lịch</h2></div>
    <div class="owl-news">
        <?php foreach ($post as $value): ?>
            <div class="items">
                <a class="imghv d-block" href="<?= 'cam-nang-du-lich/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
                    <img src="<?= _upload_post_l.'245x230x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
                </a>
                <div class="details">
                    <h3><a href="<?= 'cam-nang-du-lich/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                    <p><?= $func->catchuoi($value["description_$lang"],130) ?></p>
                    <div class="text-right">
                        <a class="arrow" href="<?= 'cam-nang-du-lich/'.$value['slug'] ?>" title="Xem thêm">Xem thêm</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>