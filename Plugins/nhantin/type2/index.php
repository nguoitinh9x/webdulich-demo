<?php 
    $VideoClips = $db->query("select name_$lang,link,photo from #_video where shows=1 and type='video' and highlight=1 order by number,id desc ");
    $list_DV = $db->query("select name_$lang from #_cate_list where shows=1 and type='dich-vu' order by number,id desc");
?>

<div id="nhantin">
    <div class="container clearfix">
        <div class="row">
            <div class="col-lg-10 mx-lg-auto">
                <div class="row bg-nhantin p-5">
                    <div class="col-lg-7 mb-4">
                        <div class="title-style-1 pt-0 clearfix"><h2>Đặt lịch hẹn</h2></div>
                        <div class="contact-form-body">
                            <form method="post" action="lien-he/" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <input class="form-control" type="text" name="name" required placeholder="Họ và tên">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input class="form-control" type="text" required name="phone" pattern=".{10}" title="10 số" onkeypress="return isNumberKey(event)" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="address" required placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required name="email" placeholder="Email">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <input class="form-control" type="date" name="date" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input class="form-control" type="time" name="time" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="title" required>
                                        <option>Chọn dịch vụ</option>
                                        <?php foreach ($list_DV as $value) : ?>
                                            <option value="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn">Đặt lịch</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="videos clearfix">
                            <div class="owl-videos">
                                <?php foreach ($VideoClips as $value): ?>
                                    <div class="mastervideo">
                                        <div class="img">
                                            <img class="w-100" onerror="this.src='images/noimage.gif'" src="<?= _upload_video_l.'430x330x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>">
                                            <div class="btnplay">
                                                <a class="fancybox" data-fancybox-type="iframe" href="<?= $value['link'] ?>?autoplay=1"><i class="fas fa-play"></i></a>
                                            </div>
                                            <h3 class="title"><?= $value["name_$lang"] ?></h3>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>