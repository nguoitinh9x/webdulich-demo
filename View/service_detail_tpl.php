<div class="container clearfix">
    <?= $breadcrumbs->urls($row_detail) ?>
    <div class="row">
        <div class="col-md-8">
            <h1 class="heading"> <?= $row_detail["name_$lang"] ?></h1>
            <p class="datecreate"><i class="far fa-calendar-alt mr-2"></i><?=date('d/m/Y - H:s', strtotime($row_detail['datecreate'])) ?></p>

            <?= $responsiveslides->html() ?>

            <div class="w-100 clearfix">
                <?= $row_detail["content_$lang"]!='' ? '<article>'.$row_detail["content_$lang"].'</article>' : '<div class="alert alert-danger w-100 mt-3" role="alert">'._updating.'</div>';?>
                <?= $fb->comment() ?>
            </div>
            <?php if($config['rating']==true){ echo $rating->html($com,$row_detail['id']); } ?>  
            <?= $fb->share() ?>
        </div>
        <?php include LAYOUT."right_tpl.php"; ?>
    </div>
</div>