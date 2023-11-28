<?php
    $sale = $db->row("select * from #_info where type='sale'");

    $db->bindMore(array("shows"=>1,"type"=>"khuyenmai","highlight"=>1));
    $khuyenmai = $db->query("select slug,photo,name_$lang,description_$lang from #_post where shows=:shows and type=:type and highlight=:highlight order by number,datecreate desc");
?>

<div id="khuyenmai" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-4 pl-lg-5">
                <div class="title-style-1 text-left">
                    <h2><?=$sale['name_vi']?></h2>
                    <div class="des">
                        <?=$sale['content_vi']?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="owl-sale">         
                    <?php foreach ($khuyenmai as $value) {?>
                        <div class="sale">
                            <div class="img">
                                <img src="<?=_upload_post_l.'520x520x1/'.$value['photo']?>" alt="<?=$value['name_'.$lang]?>"/>
                           
                                <div class="details">
                                    <h3><?=$value['name_'.$lang]?></h3>
                                    <p><?=$value['description_'.$lang]?></p>
                                    <a class="btn" href="khuyen-mai/<?=$value['slug']?>.html" title="Xem chi tiết"><span>Nhấn vào đây</span></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>