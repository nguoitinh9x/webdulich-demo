<?php
    $sell = $db->query("select name_$lang,slug,photo,description_$lang,price,oldprice,datein from #_post where shows=1 and type='tour' and selling=1 order by number,id desc limit 3");
    $listTour = $db->query("select id,name_$lang from #_cate_list where shows=1 and type='tour' order by number,id desc");
?>

<div class="col-md-4">
    <div class="boxLeft">
        <div class="d-search">
            <div class="title-left"><h2 class="rounded-0">Tìm tour</h2></div>
            <div class="p-3">
                <form method="post" action="tim-kiem/" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" required placeholder="Nhập tên, vị trí, địa danh ...">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="idl" required>
                            <option value="">Loại tour</option>
                            <?php foreach ($listTour as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value["name_$lang"] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" onfocus="(this.type='date')" name="date" placeholder="Tìm theo ngày khởi hành">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-danger w-100">TÌM KIẾM</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-search">
            <div class="title-left mb-3"><h2 class="rounded-0">Tour Hot</h2></div>
            <div class="boxNews px-4 py-2">
                <?php foreach ($sell as $value) : ?>
                    <div class="items mb-3 clearfix">
                        <div class="img">
                            <a class="imghv d-block" href="<?= 'tour/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
                                <img src="<?= _upload_post_l.'320x260x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
                            </a>
                        </div>
                        <div class="details">
                            <h3><a href="<?= 'tour/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                            <p class="des"><strong>Hành trình: </strong><?= $func->catchuoi($value["description_$lang"], 140) ?></p>
                            <div class="row">
                                <div class="col-8">
                                    <p class="price"><?= $func->giamoicu($value['price'], $value['oldprice']) ?></p>
                                    <p class="datein"><strong>Khởi hành: </strong><?= date('d/m/Y', strtotime( $value['datein'] )) ?></p>
                                </div>
                                <div class="col-4 pl-0 d-flex align-items-center">
                                    <a class="booktour" href="<?= 'tour/'.$value['slug'] ?>" title="Đặt tour">ĐẶT TOUR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>