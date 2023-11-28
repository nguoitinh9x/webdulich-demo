<div class="container clearfix">
    <?= $breadcrumbs->urls($row_detail) ?>
    <div class="row">
        <div class="col-lg-9">
            <h1 class="heading"> <?= $row_detail["name_$lang"] ?></h1>
            <p class="datecreate"><i class="far fa-calendar-alt mr-2"></i><?=date('d/m/Y - H:s', strtotime($row_detail['datecreate'])) ?></p>
            <div class="w-100 clearfix">
                <?= $row_detail["content_$lang"]!='' ? '<article>'.$row_detail["content_$lang"].'</article>' : '<div class="alert alert-danger w-100 mt-3" role="alert">'._updating.'</div>';?>
                <?= $fb->comment() ?>
            </div>
            <?php if($config['rating']==true){ echo $rating->html($com,$row_detail['id']); } ?>  
            <?= $fb->share() ?>
        </div>
        <!-- newsfrind -->
        <?php if($com!='ho-tro-khach-hang' && $com!='chinh-sach'): ?>
            <div class="col-lg-3">
                <?php if(count($list_news)>0 ): ?>
                    <div class="newsfrind">
                        <div class="title-news">Lĩnh vực tin</div>
                        <ul class="ul">
                            <?php foreach ($list_news as $value): ?>
                                <li class="clearfix">
                                    <div class="details">
                                        <h3> <a href="<?= $com.'/'.$value['slug'] ?>/" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <div class="newsfrind">
                    <div class="title-news">Cùng lĩnh vực</div>
                    <ul class="ul">
                        <?php foreach ($item as $tinkhac): ?>
                            <li class="clearfix">
                                <div class="img">
                                    <a href="<?= $com.'/'.$tinkhac['slug'] ?>" title="<?= $tinkhac["name_$lang"] ?>">
                                        <img src="<?= _upload_post_l.'120x100x1/'.$tinkhac['photo'] ?>" alt="<?= $tinkhac["name_$lang"] ?>">
                                    </a>
                                </div>
                                <div class="details">
                                    <h3> <a href="<?= $com.'/'.$tinkhac['slug'] ?>" title="<?= $tinkhac["name_$lang"] ?>"><?= $tinkhac["name_$lang"] ?></a></h3>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>