<div class="boxProd clearfix">
    <div class="container">
        <?=$breadcrumbs->urls($row_detail)?>
        <div class="title-style-1 clearfix"><h1><?=$title_detail?></h1></div>

        <?php if(empty($item)): echo '<div class="alert alert-danger w-100">'._updating.'</div>';else: ?>
            <div class="row">
                <?php foreach ($item as $value) : ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="items">
                            <div class="img">
                                <a class="imghv d-block" href="san-pham/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
                                    <img onerror="this.src='images/noimage.gif'" src="<?=_upload_product_l.'270x360x1/'.$value['photo']?>" alt="<?= $value["name_$lang"] ?>"/>
                                </a>
                            </div>
                            <div class="details">
                                <h3><a href="san-pham/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                                <p class="price"><span>Giá: </span><?= $func->giaban($value['price']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; echo $paging?>
            </div>
        <?php endif ?>
    </div>
</div>
