<div class="container clearfix mb-4">
    <?=$breadcrumbs->urls($row_detail)?>
    <div class="row">
        <div class="col-lg-10 mx-lg-auto">
            <h1 class="title-style-1"><?=$title_detail?></h1>
            <div class="row">
                <?php foreach ($item as $value): ?>
                    <div class="col-md-6 download mb-3">
                        <a href="<?=_upload_download_l.$value['download'];?>" target="_blank" title="<?=$value["name_$lang"]?>">
                            <i class="fas fa-file-pdf mr-2"></i> <?=$value["name_$lang"]?>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>