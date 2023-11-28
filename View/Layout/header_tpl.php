<?php
    $sdt = $db->query("select ficon, name_$lang from #_link where shows=1 and type='hotline' order by number,id desc");
?>
<div class="container d-none d-lg-block clearfix">
    <div class="row">
        <div class="col-xl-3 col-lg-4 text-left">
            <a class="logo" href="./"><img src="<?= _upload_hinhanh_l.'270x118x1/'.$Logosite ?>" alt="<?= $Setting["name_$lang"] ?>"/></a>
        </div>
        <div class="col-xl-3 col-lg-4 pl-lg-5 d-none d-lg-flex align-items-center hotline">
            <img src="images/phone.png" alt="phone">
            <p class="text-right pl-3 my-0">
                <span>Tổng Đài</span>
                <span><a href="tel:<?= preg_replace('/[^0-9]/','', $Setting['phone'] ) ?>"><?= $Setting['phone'] ?></a></span>
                <span><?= $Setting['timelive'] ?></span>
            </p>
        </div>
        <div class="col-xl-3 col-lg-4 px-xl-0 d-none d-lg-flex align-items-center hotline">
            <img src="images/phone.png" alt="phone">
            <p class="text-right pl-3 my-0">
                <?php foreach ($sdt as $value) : ?>
                    <span><?= $value["name_$lang"] ?> : <a href="tel:<?= preg_replace('/[^0-9]/','', $value['ficon'] ) ?>"><?= $value['ficon'] ?></a></span>
                <?php endforeach ?>
            </p>
        </div>
        <div class="col-xl-3 d-none d-xl-flex align-items-center">
        	<ul class="ul menu-header">
        		<li><a href="gioi-thieu/" title="Giới thiệu">Giới thiệu</a></li>
        		<li><a href="tuyen-dung/" title="Tuyển dụng">Tuyển dụng</a></li>
        		<li><a href="hop-tac/" title="Hợp tác">Hợp tác</a></li>
        	</ul>
        </div>
    </div>
</div>
<?php include LAYOUT."menu_tpl.php"; ?>