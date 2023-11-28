<div class="container clearfix">
    <?=$breadcrumbs->urls($row_detail)?>  
    <div class="title-style-1"><h1><?=$title_detail?></h1></div>
    <?php if(empty($item)): echo '<div class="alert alert-danger w-100">'._updating.'</div>';else: ?>
        <div class="row">
            <?php foreach ($item as $value) : ?>
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="post border-0">
                        <div class="img">
                            <a class="imghv d-block" href="<?= $com ?>/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>">
                                <img onerror="this.src='images/noimage.gif'" src="<?=_upload_post_l.'370x240x1/'.$value['photo']?>" alt="<?=$value["name_$lang"]?>"/>
                            </a>
                        </div>
                        <div class="details">
                            <h3><a href="<?= $com ?>/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>"><?=$value["name_$lang"]?></a></h3>
                            <p><?=$func->catchuoi($value['description_'.$lang],180)?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; echo $paging?>
        </div>
    <?php endif ?>
</div>