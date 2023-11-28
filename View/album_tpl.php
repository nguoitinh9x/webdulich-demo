<div class="container">
    <?=$breadcrumbs->urls($row_detail,'nocom')?> 
    <div class="title-style-1"><h1><?=$title_detail?></h1></div>
    <div class="thuvien">
        <?php if(empty($item)): echo '<div class="alert alert-danger w-100">'._updating.'</div>';else:?>
            <div class="row">
                <?php  foreach ($item as $key => $value):
                    $item_photos = $db->query("select photo from #_cate_photo where shows=1 and type='album' and id_cate='".$value['id']."' order by number,id desc");
                ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="view">
                            <img onerror="this.src='images/noimage.gif'" src="<?=_upload_post_l.'400x300x1/'.$value['photo']?>" alt="<?=$value["name_$lang"]?>"/>
                            <div class="flex-center">
                                <div class="details">
                                    <h3><?=$value["name_$lang"]?></h3>
                                    <a class="chitiet fancybox" data-fancybox="group<?=$value['id']?>" href="<?=_upload_post_l.'400x300x1/'.$value['photo']?>" data-caption="<?=$value["name_$lang"]?>" title="Chi tiết">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <?php foreach ($item_photos as $k => $v): ?>
                                        <a class="fancybox" data-fancybox="group<?=$value['id']?>" href="<?=_upload_cate_l.$v['photo']?>" data-caption="<?=$value["name_$lang"]?>"></a>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
               <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</div>