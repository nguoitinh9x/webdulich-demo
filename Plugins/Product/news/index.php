<?php 
    $Allnews = $db->query("select id,slug,name_$lang,photo,price,highlight from #_product where type='product' and shows=1 and promotion=1 order by number desc,id desc limit 8");
?>
<div class="boxProd clearfix">
    <div class="container">
        <div class="title-style-1"><h2>Sản phẩm mới</h2></div>
        <div class="row no-gutters">
            <?php foreach ($Allnews as $value): ?>
                <div class="col-lg-3 col-md-4 col-6 px-1">
                    <div class="items clearfix">
                        <div class="img">
                            <a class="imghv d-block" href="hai-san/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>">
                                <img src="<?=_upload_product_l.'290x420x1/'.$value['photo']?>" alt="<?=$value["name_$lang"]?>"/>
                            </a>
                        </div>
                        <div class="details">
                            <h3><a href="hai-san/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>"><?=$value["name_$lang"]?></a></h3>
                            <p class="price">
                                <?= $func->giaban($value['price']) ?>
                                <?= $value['highlight']==1 ? '<img src="images/hot.png" alt="Hot">' : '' ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="line-bg w-100 text-center mt-3">
            <a class="btn allview" href="co-gi-moi/" title="Xem tất cả">Xem tất cả</a>
        </div>
    </div>
</div>