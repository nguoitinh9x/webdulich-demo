<?php 
$db->bindMore(array('type'=>'danhmuc','shows'=>1));
$danhmuc = $db->query("select photo_$lang as photo,name_$lang as name,link,description_$lang as des from #_photo where shows=:shows and type=:type order by number,datecreate desc");
?>

<div id="gridphoto" class="clearfix">
    <div class="title-style-1 my-lg-4"><h2 class="text-white">Sản phẩm</h2></div>
    <div class="container">
        <div class="gridphoto clearfix">
            <?php foreach ($danhmuc as $key => $value):?>
                <div class="items">
                    <a class="effect-v9" href="<?=$value['link']?>" title="<?=$value['name']?>">
                        <img src="<?=_upload_hinhanh_l.($key==1 ? '275x395x1/' : '555x375x1/').$value['photo'] ?>" alt="<?=$value['name']?>">
                    </a>
                    <div class="caption">
                        <h3><a href="<?=$value['link']?>" title="<?=$value['name']?>"><?=$value['name']?></a></h3>
                        <p><?=$value['des']?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>