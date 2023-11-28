<div class="container">
    <?= $breadcrumbs->urls($row_detail) ?> 
    <div class="row">
        <div class="col-md-5 frame_images mb-3">
            <div class="app-figure" id="zoom-fig">
                <a href="<?= _upload_product_l.$row_detail['photo'] ?>" id="Zoom-1" class="MagicZoom" title="<?= $row_detail["name_$lang"] ?>">
                    <img src="<?= _upload_product_l.'270x360x1/'.$row_detail['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>"/>
                </a>
            </div>
            
            <?php if(count($item_photos)):  ?>
            <div class="selectors">
                <ul class="owl_carousel_detail ul">
                    <li><a data-zoom-id="Zoom-1" href="<?= _upload_product_l.$row_detail['photo'] ?>" data-image="<?= _upload_product_l.'270x360x1/'.$row_detail['photo'] ?>">
                        <img u="image" src="<?= _upload_product_l.'270x360x1/'.$row_detail['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>"/></a>
                    </li>
                    <?php foreach ($item_photos as $value) { ?>
                        <li><a data-zoom-id="Zoom-1" href="<?= _upload_cate_l.$value['photo'] ?>" data-image="<?= _upload_cate_l.'270x360x1/'.$value['photo'] ?>">
                            <img u="image" src="<?= _upload_cate_l.'270x360x1/'.$value['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>"/></a>
                        </li>
                    <?php }  ?>
                </ul>
            </div>
            <?php endif  ?>
        </div>
        <ul class="col-md-7 khung_thongtin">
            <li><h1><?= $row_detail["name_$lang"] ?></h1></li>
            <li class="ngaydang"><i class="far fa-calendar-alt mr-2"></i> <?= date('d/m/Y - H:s', strtotime($row_detail['datecreate'])) ?></li>
            <li class="code"><i class="fas fa-eye mr-2"></i> Lượt xem: <?= $row_detail['view'] ?></li>
            <li class="gia_detail"><i class="fas fa-dollar-sign mr-2"></i><?= $func->giaban($row_detail['price']) ?></li>
            <li class="mota_detail"><i class="fas fa-tags mr-2"></i> Mô tả : <?= $row_detail["description_$lang"] ?></li>
            
            <?php if($config['setup']['cart']=='true'):  ?>
                <?php /* ?>
                <li class="code"><i class="fas fa-qrcode mr-2"></i> Mã SP: <?=  $row_detail['code']!='' ? $row_detail['code'] : '<span>Unknown</span>'  ?></li>
                <li class="code"><i class="fas fa-balance-scale mr-2"></i> Khối lượng: <?=  $row_detail['mass']!='' ? $row_detail['mass'] : '<span>Unknown</span>'  ?></li>
                <?php */ ?>
                <li>
                    <div class="quantity-product">
                        <div class="input-group bootstrap-touchspin">
                        <span class="input-group-btn giam_sl"><button class="btn" type="button">-</button></span>
                        <input id="soluong" type="tel" name="soluong" value="1" min="1" max="100" class="form-control">
                        <span class="input-group-btn tang_sl"><button class="btn" type="button">+</button></span></div>
                    </div>
                </li>
                <li>
                    <a href="javascript:;" title="Đặt hàng" class="dathat_detail" data-id="<?= $row_detail['id'] ?>" data-type="muangay"><i class="fas fa-cart-plus"></i> Đặt hàng</a>
                </li>
            <?php endif  ?>

            <li><?= $fb->share() ?></li>

            <?php if($row_detail['tags']):  ?>
                <li><i class="fas fa-tags"></i> <b>Tags:</b> <?= $func->show_tags($row_detail["tags"]) ?></li>
            <?php endif  ?>

        </ul>
    </div>
    <div id="container_product">
        <ul class="ul clearfix" id="tabs">
            <li class="active"><a href="tab-1"><?= _chitietsanpham ?></a></li>
        </ul>
        <div id="tab-1" class="tab_hidden active">
            <div class="w-100 clearfix">
                <?= $row_detail["content_$lang"]!='' ? '<article>'.$row_detail["content_$lang"].'</article>' : '<div class="alert alert-danger w-100 mt-3" role="alert">'._updating.'</div>'; ?>
                <?= $fb->comment() ?>
            </div>
        </div>
    </div>

    <?php if(count($item)):  ?>
        <div class="boxProd mb-lg-5 clearfix">
            <h2 class="title-other"><?= _sanphamkhac ?></h2>
            <div class="row">
                <?php foreach ($item as $value):  ?>
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
                <?php endforeach; echo $paging ?>
            </div>
        </div>
    <?php endif  ?>
</div>

