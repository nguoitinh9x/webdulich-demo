<div class="container clearfix">
    <?= $breadcrumbs->urls($row_detail) ?>  
    <div class="title-style-1"><h1><?= $title_detail ?></h1></div>
    <div class="row">
        <?php include LAYOUT."left_tpl.php"; ?>
        <div class="col-md-8">
            <?php if(empty($item)): echo '<div class="alert alert-danger w-100">'._updating.'</div>';else: ?>
                <div class="boxDv">
                    <?php foreach ($item as $value) : ?>
                        <div class="items clearfix">
                            <div class="img">
                                <a class="imghv d-block" href="<?= $com .'/'. $value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
                                    <img onerror="this.src='images/noimage.gif'" src="<?= _upload_post_l.'290x250x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
                                </a>
                            </div>
                            <div class="details">
                                <h3><a href="<?= $com .'/'. $value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                                <p><?= $func->catchuoi($value["description_$lang"],160) ?></p>
                                <p><i class="fas fa-qrcode mr-2"></i>Mã tour : <?= $value['code'] ?></p>
                                <p><i class="far fa-clock mr-2"></i>Thời gian : <?= $value['code'] ?></p>
                                <p><i class="far fa-calendar-alt mr-2"></i>Khởi hành : <?= date('d/m/Y', strtotime( $value['datein'] )) ?></p>
                                <p><i class="fas fa-plane mr-2"></i>Phương tiện : <?= $value['phuongtien'] ?></p>
                                <p class="price"><span><i class="fas fa-dollar-sign mr-2"></i>Giá tour:</span> <?= $func->giamoicu($value['price'], $value['oldprice']) ?></p>
                                <a class="btn booktour float-right clearfix" href="<?= 'tour/'.$value['slug'] ?>" title="Đặt tour">ĐẶT TOUR</a>
                            </div>
                        </div>
                    <?php endforeach; echo $paging ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>