<?php
    $db->bindMore(array("shows"=>1,"type"=>"khachhang"));
    $khachhang = $db->query("select name_$lang,slug,photo,photo,description_$lang from #_post where shows=:shows and type=:type order by number,id desc");
?>

<div id="khachhang">
    <div class="container clearfix">
        <div class="title-style-1">
            <h2>ý kiến khách hàng</h2>
            <p>Hoạt động chăm sóc sắc đẹp đã trở thành việc thiết yếu và ngày nay lại càng trở nên thiết thực hơn </p>
        </div>

        <div class="owl-customer">
            <?php foreach ($khachhang as $key => $value) { ?>
                <div class="items">
                    <div class="details">
                        <img src="images/phay.png" alt="khách hàng">
                        <p><?=$func->catchuoi($value['description_'.$lang],160)?></p>
                    </div>
                    <div class="boximg">
                        <div class="img">
                            <img src="<?=_upload_post_l.'80x80x1/'.$value['photo']?>" alt="<?=$value['name_'.$lang]?>">
                        </div>
                        <div class="des">
                            <h3><?=$value['name_'.$lang]?></h3>
                            <p>Giáo viên hướng dẫn Spa </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


