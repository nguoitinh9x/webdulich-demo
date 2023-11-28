<?php 
    $List = $db->query("select id,slug,name_$lang from #_cate_list where shows=1 and highlight=1 and type='product' order by number asc,id desc");
?>

<div class="jumbotron boxProd py-lg-5 m-0 clearfix">
    <div class="container">
        <div class="title-style-1"><h2>Sản phẩm của chúng tôi</h2></div>
        <ul class="nav nav-tabs pt-3 pb-4" id="myTab" role="tablist">
            <?php foreach ($List as $k => $vl) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $k==0 ? 'active' : '' ?>" id="home<?= $k ?>-tab" data-toggle="tab" href="#home<?= $k ?>" ><?= $vl["name_$lang"] ?></a>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php foreach ($List as $k => $vl) : 
                $product = $db->query("select slug,name_$lang,photo,price from #_product where type='product' and shows=1 and highlight=1 and id_list='".$vl['id']."' order by number desc,id desc limit 8");
                ?>
                <div class="tab-pane fade <?= $k==0 ? 'show active' : '' ?>" id="home<?= $k ?>">
                    <?php if(empty($product)): echo '<div class="alert alert-danger w-100">'._updating.'</div>';else:?> 
                        <div class="row">   
                            <?php foreach ($product as $value): ?>
                                <div class="col-xl-3 col-md-4 col-6 items clearfix">
                                    <div class="img">
                                        <a class="imghv d-block" href="san-pham/<?=$value['slug']?>" title="<?= $value["name_$lang"] ?>">
                                            <img src="<?=_upload_product_l.'285x280x2/'.$value['photo']?>" alt="<?= $value["name_$lang"] ?>"/>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <h3><a href="san-pham/<?=$value['slug']?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                                        <p class="price"><span>Giá: </span><?= $func->giaban($value['price']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <?= count($product) == 8 ? '<div class="w-100 text-center"><a class="btn allview" href="san-pham/'.$vl['slug'].'/" title="Xem thêm">Xem thêm<i class="far fa-arrow-alt-circle-right ml-2"></i></a></div>' : '' ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>