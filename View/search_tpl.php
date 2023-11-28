<div class="boxProd clearfix">
    <div class="container clearfix">
        <?=$breadcrumbs->urls($row_detail)?>  
        <div class="title-style-1 clearfix"><h1><?=$title_detail?></h1></div>
        <?php if(count($item)==0){echo '<div class="alert alert-danger w-100" role="alert">'._updating.'</div>';}else{?>
            <div class="row">
                <?php foreach ($item as $value) {?>
                    <div class="col-xl-3 col-md-4 col-6 mb-4 px-lg-2 clearfix">
                        <div class="items">
                            <div class="img">
                                <div class="caption">
                                    <a class="view" href="<?=$value['type']=='dich-vu' ? 'dich-vu' : 'san-pham' ?>/<?=$value['slug']?>" title="Xem nhanh">
                                        <i class="fas fa-eye"></i> Xem nhanh
                                    </a>
                                    <?php if($value['type']=='dich-vu'){?>
                                        <a href="lien-he/" title="Đặt hẹn">
                                            <i class="far fa-calendar-alt"></i> Đặt hẹn
                                        </a>
                                    <?php }else{?>
                                        <a class="boxCart" href="javascript:;" data-id="<?=$value['id']?>" title="Mua ngay">
                                            <i class="fas fa-cart-plus"></i> Mua ngay
                                        </a>
                                    <?php }?>
                                </div>
                                <a href="<?=$value['type']=='dich-vu' ? 'dich-vu' : 'san-pham' ?>/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>">
                                    <img src="<?=_upload_product_l.'275x275x2/'.$value['photo']?>" alt="<?=$value["name_$lang"]?>"/>
                                </a>
                            </div>
                            <div class="details">
                                <h3><a href="<?=$value['type']=='dich-vu' ? 'dich-vu' : 'san-pham' ?>/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>"><?=$value["name_$lang"]?></a></h3>
                                <?php if($value['type']=='dich-vu'){?>
                                    <p class="price"><?= $func->giamoicu($value['price'],$value['oldprice']) ?></p>
                                <?php }else{?>
                                    <p class="price"><span>Giá:</span> <?= $func->giaban($value['price']) ?></p>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php } echo $paging?>
            </div>
        <?php }?>
    </div>
</div>