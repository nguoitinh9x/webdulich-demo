<?php 
    $List = $db->query("select id,slug,name_$lang from #_cate_list where shows=1 and highlight=1 and type='du-an' order by number asc,id desc");
?>

<div class="boxProd py-lg-5 m-0 clearfix">
    <div class="container">
        <div class="title-style-1"><h2>Dự án của chúng tôi</h2></div>
        <ul class="nav nav-tabs pt-3 pb-4 justify-content-center" role="tablist">
            <?php foreach ($List as $k => $vl) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $k==0 ? 'active' : '' ?>" id="project<?= $k ?>-tab" data-toggle="tab" href="#project<?= $k ?>" ><?= $vl["name_$lang"] ?></a>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php foreach ($List as $k => $vl) : 
                $post = $db->query("select slug,name_$lang,photo from #_post where type='du-an' and shows=1 and highlight=1 and id_list='".$vl['id']."' order by number desc,id desc");
                ?>
                <div class="tab-pane fade <?= $k==0 ? 'show active' : '' ?>" id="project<?= $k ?>">
                    <?php if(empty($post)): echo '<div class="alert alert-danger w-100">'._updating.'</div>';else:?> 
                        <div class="row">   
                            <?php foreach ($post as $value): ?>
                                <div class="col-md-4 col-6 items clearfix">
                                    <div class="img">
                                        <a class="imghv d-block" href="du-an/<?=$value['slug']?>" title="<?= $value["name_$lang"] ?>">
                                            <img src="<?=_upload_post_l.'370x240x1/'.$value['photo']?>" alt="<?= $value["name_$lang"] ?>"/>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <h3><a href="du-an/<?=$value['slug']?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>