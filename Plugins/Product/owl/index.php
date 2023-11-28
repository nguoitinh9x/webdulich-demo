<?php 
    $Selling = $db->query("select id,slug,name_$lang,photo,price,oldprice,description_$lang from #_product where type='product' and shows=1 and selling=1 order by number desc,id desc");
?>

<div class="boxProd py-4 clearfix">
    <div class="container">
        <div class="bg-white">
            <div class="title-style-2"><h2>Top sản phẩm bán chạy</h2></div>
            <div class="owl-prod">
                <?php foreach ($Selling as $value): ?>
                    <div class="items">
                        <div class="img">
                            <a class="imghv d-block" href="san-pham/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
                                <img src="<?=_upload_product_l.'240x230x1/'.$value['photo']?>" alt="<?= $value["name_$lang"] ?>"/>
                            </a>
                        </div>
                        <div class="details">
                            <h3><a href="san-pham/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                            <p class="des"><?= $func->catchuoi($value["description_$lang"],80) ?></p>
                            <p class="price"><?= $func->giamoicu($value['price'], $value['oldprice']) ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>