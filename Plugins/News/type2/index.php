<?php
    $db->bindMore(array("shows"=>1,"type"=>"kienthuc","highlight"=>1));
    $ktld = $db->query("select name_$lang,slug,datecreate,photo,description_$lang from #_post where shows=:shows and type=:type and highlight=:highlight order by number,datecreate desc");
?>

<div class="container clearfix">
    <div class="title-style-1">
        <h2>Hướng dẫn kiến thức làm đẹp</h2>
        <p>Những tin tức đặc biệt và nổi bậc nhất</p>
    </div>

    <div class="boxNews clearfix mb-lg-3">
        <div class="owl-kt">
            <?php foreach ($ktld as $key => $value): ?>
                <div class="items">
                    <div class="img">
                        <a class="imghv d-block" href="huong-dan/<?=$value['slug']?>.html" title="<?=$value['name_'.$lang]?>">
                            <img src="<?=_upload_post_l.'380x310x1/'.$value['photo']?>" alt="<?=$value['name_'.$lang]?>"/>
                        </a>
                    </div>
                    <div class="details">
                        <div class="date">
                            <span><?=date('d', strtotime($value['datecreate']));?></span>
                            <span><?=date('m', strtotime($value['datecreate']));?></span>
                            <span><?=date('Y', strtotime($value['datecreate']));?></span>
                        </div>
                        <h3><a href="huong-dan/<?=$value['slug']?>.html" title="<?=$value['name_'.$lang]?>"><?=$value['name_'.$lang]?></a></h3>
                        <p><?=$func->catchuoi($value['description_'.$lang],120)?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>