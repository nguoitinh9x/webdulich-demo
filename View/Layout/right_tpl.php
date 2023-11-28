<div class="col-md-4">
    <div class="boxLeft">
        <div class="d-search">
            <div class="title-left"><h2 class="rounded-0">THÔNG TIN TOUR</h2></div>
            <div class="px-4 py-3">
                <h3><?= $row_detail["name_$lang"] ?></h3>
                <p><?= $func->catchuoi($row_detail["description_$lang"],160) ?></p>
                <p><i class="fas fa-qrcode mr-2"></i>Mã tour : <?= $row_detail['code'] ?></p>
                <p><i class="far fa-clock mr-2"></i>Thời gian : <?= $row_detail['code'] ?></p>
                <p><i class="far fa-calendar-alt mr-2"></i>Khởi hành : <?= date('d/m/Y', strtotime( $row_detail['datein'] )) ?></p>
                <p><i class="fas fa-plane mr-2"></i>Phương tiện : <?= $row_detail['phuongtien'] ?></p>
                <p class="price"><span><i class="fas fa-dollar-sign mr-2"></i>Giá tour:</span> <?= $func->giamoicu($row_detail['price'], $row_detail['oldprice']) ?></p>
                <p class="text-center mt-3 py-3 bg-ccc">
                    <a class="hotline" href="tel:<?= preg_replace('/[^0-9]/','', $Setting['hotline'] ) ?>"><?= $Setting['hotline'] ?></a>
                    <a class="btn booktour" href="javascript:;" title="Đặt tour" data-toggle="modal" data-target="#myModal">ĐẶT TOUR</a>
                </p>
            </div>
        </div>
        <div class="d-search">
            <div class="title-left mb-3"><h2 class="rounded-0">Tour Khác</h2></div>
            <div class="boxNews px-4 py-2">
                <?php foreach ($item as $value) : ?>
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



<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="contact-form-header">
                <h5 class="contact-title mx-auto" id="title-form">LIÊN HỆ ĐẶT TOUR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <div class="contact-form-body">
                <form method="post" action="lien-he/" enctype="multipart/form-data">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-ribbon"></i></div>
                        </div>
                        <input class="form-control" type="text" name="title" value="<?= $row_detail["name_$lang"] ?>" readonly>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input class="form-control" type="text" name="name" required="required" placeholder="<?=_hoten?> *">
                    </div>
                    <div class="form-row ">
                        <div class="form-group input-group col-lg-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-at"></i></div>
                            </div>
                            <input class="form-control" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required name="email" placeholder="Email *">
                        </div>
                        <div class="form-group input-group col-lg-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                            </div>
                            <input class="form-control" type="text" required name="phone" pattern=".{10}" title="10 số" onkeypress="return isNumberKey(event)" placeholder="<?=_dienthoai?> *">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea rows="4" class="form-control" name="content" required placeholder="<?=_noidung?> *"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-danger py-2 px-4">GỬI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>