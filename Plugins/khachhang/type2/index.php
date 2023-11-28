<?php
    $cus = $db->query("select photo,name_$lang,description_$lang,content_$lang from #_post where shows=1 and type='khachhang' order by number,id desc");
?>

<div id="khachhang" class="clearfix">
    <div class="container">
        <div class="owl-cus">         
            <?php foreach ($cus as $value) {?>
                <div class="cus">
                    <div class="details pr-md-5">
                        <h2>Những chuyên gia của chúng tôi</h2>
                        <h3><?=$value["name_$lang"]?></h3>
                        <div class="des">
                            <?=$value["content_$lang"]?>
                        </div>
                        <p><?=$value["description_$lang"]?></p>                    
                    </div>
                    <div class="img">
                        <img src="<?=_upload_post_l.'487x487x1/'.$value['photo']?>" alt="<?=$value['name_'.$lang]?>"/>
                    </div>
                    
                </div>
            <?php } ?>
        </div>
    </div>
</div>