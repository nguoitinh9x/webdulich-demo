<?php 
    $List = $db->query("select id,slug,name_$lang from #_cate_list where shows=1 and type='tour' and showads=1 order by number,id desc");
?>
<div id="menu" class="clearfix">
    <div class="container">
        <nav class="main-nav">
            <ul class="ul text-lg-center">
                <li <?= $func->activemenu('') ?>><a href="./" title="<?= _trangchu ?>"><i class="fas fa-home"></i></a></li>
                <li class="d-lg-none"><a href="gioi-thieu/" title="Giới thiệu">Giới thiệu</a></li>
                <?php foreach ($List as $vl) :
                    $db->bindMore(array("type"=>"tour", "id_list"=>$vl['id']));
                    $Cats = $db->query("select name_$lang, slug from #_cate_cat where shows=1 and type=:type and id_list=:id_list order by number,id desc");
                    ?>
                    <li><a href="tour/<?= $vl['slug'] ?>/"><?= $vl["name_$lang"] ?></a>
                        <?php if (!empty($Cats)): ?>
                            <ul>
                                <?php foreach ($Cats as $value): ?>
                                    <li><a href="tour/<?= $vl['slug'] ?>/<?= $value['slug'] ?>"><?= $value["name_$lang"] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
                <li <?= $func->activemenu('ve-may-bay') ?>><a href="ve-may-bay/" title="Vé máy bay">Vé máy bay</a></li>
                <li <?= $func->activemenu('khach-san') ?>><a href="khach-san/" title="Khách sạn">Khách sạn</a></li>
                <li <?= $func->activemenu('tin-tuc') ?>><a href="tin-tuc/" title="<?= _tintuc ?>"><?= _tintuc ?></a></li>
                <li class="d-lg-none"><a href="tuyen-dung/" title="Tuyển dụng">Tuyển dụng</a></li>
                <li class="d-lg-none"><a href="hop-tac/" title="Hợp tác">Hợp tác</a></li>
                <li <?= $func->activemenu('lien-he') ?>><a href="lien-he/" title="<?= _lienhe ?>"><?= _lienhe ?></a></li>
            </ul>
        </nav>
        <div class="m-nav d-lg-none">
            <button class="menu-btn act nav-close d-lg-none" type="button">
                <i></i>
            </button>
            <div class="nav-ct"></div>
        </div>
        <div class="row no-gutters">
            <div class="d-lg-none mx-auto">
                <a class="mlogo" href="./"><img src="<?= _upload_hinhanh_l.'270x118x1/'.$Logosite ?>" alt="<?=$Setting["shortname_$lang"]?>"/></a>
                <a class="smooth h-hotline" href="tel:<?= preg_replace('/[^0-9]/','', $Setting['hotline'] ) ?>" title="<?=$Setting['hotline'];?>">Hotline: <?=$Setting['hotline'];?></a>
                <button class="menu-btn nav-open d-lg-none" type="button"><i></i></button>
            </div>
        </div>
    </div>
</div>

