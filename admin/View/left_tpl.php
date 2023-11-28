<div class="logo"> <a href="#" target="_blank" onclick="return false;"> <img src="Assets/images/headerlogo.png" width="120"/> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
    <li class="dash" id="menu1"><a class=" active" href="index.html"><span>Trang chủ</span></a></li>
    <!-- 
    <li class="categories_li<?php if($type=='product') echo ' activemenu' ?>" id="menu_sp"><a href="" class="exp"><span>Sản phẩm</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='product' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=cate&act=man_list&type=product">Danh mục cấp 1</a></li>
            <li<?php if($type=='product' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=cate&act=man_cat&type=product">Danh mục cấp 2</a></li>
            <li<?php if($type=='product' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=cate&act=man_item&type=product">Danh mục cấp 3</a></li>
            <li<?php if($type=='product' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=product&act=man&type=product">Quản lý sản phẩm</a></li>
        </ul>
    </li>
    -->
    <li class="categories_li<?php if($type=='tour') echo ' activemenu' ?>" id="menu_tr"><a href="" class="exp"><span>Tour</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='tour' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=cate&act=man_list&type=tour">Danh mục cấp 1</a></li>
            <li<?php if($type=='tour' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=tour">Quản lý tour</a></li>
        </ul>
    </li>

    <li class="categories_li<?php if($com=='post' && $type!='album') echo ' activemenu' ?>" id="menu_bv"><a href="" class="exp"><span>Bài viết</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='ve-may-bay' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=ve-may-bay">Vé máy bay</a></li>
            <li<?php if($type=='khach-san' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=khach-san">Khách sạn</a></li>
            <li<?php if($type=='tin-tuc' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=tin-tuc">Tin tức</a></li>
            <li<?php if($type=='cam-nang-du-lich' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=cam-nang-du-lich">Cẩm nang du lịch</a></li>
            <!-- 
            <li<?php if($type=='visaochon' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=visaochon">Vì sao chọn</a></li>
            <li<?php if($type=='download' && $fact=='') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=download">Download file</a></li>
            -->
            </ul>
        </li>
        <!-- <li class="tags_li<?php if($type=='tags') echo ' activemenu' ?>" id="menu_tg"><a href="#" class="exp"><span>Tags</span><strong></strong></a>
            <ul class="sub">
                <li<?php if($type=='tags') echo ' class="this"' ?>><a href="index.html?com=post&act=man&type=tags">Quản lý tags</a></li>
            </ul>
        </li> -->
        <li class="categories_li<?php if($com=='info') echo ' activemenu' ?>" id="menu_tt"><a href="" class="exp"><span>Trang tĩnh</span><strong></strong></a>
            <ul class="sub">
                <li <?php if($type=='gioi-thieu') echo ' class="this"' ?>><a href="index.html?com=info&act=capnhat&type=gioi-thieu">Giới thiệu</a></li>
                <li <?php if($type=='tuyen-dung') echo ' class="this"' ?>><a href="index.html?com=info&act=capnhat&type=tuyen-dung">Tuyển dụng</a></li>
                <li <?php if($type=='hop-tac') echo ' class="this"' ?>><a href="index.html?com=info&act=capnhat&type=hop-tac">Hợp tác</a></li>
                <li<?php if($type=='lienhe') echo ' class="this"' ?>><a href="index.html?com=info&act=capnhat&type=lienhe">Liên hệ</a></li>
                <!-- 
                    <li<?php if($type=='footer') echo ' class="this"' ?>><a href="index.html?com=info&act=capnhat&type=footer">Footer</a></li>
                --> 
            </ul>
        </li>
    <!-- <li class="categories_li<?php if($type=='bank') echo ' activemenu' ?>" id="menu_bk"><a href="#" class="exp"><span>Ngân hàng</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='bank') echo ' class="this"' ?>><a href="index.html?com=title&act=man&type=bank">Tài khoản ngân hàng</a></li>
        </ul>
    </li> 
    -->
    <li class="album_li<?php if($type=='album') echo ' activemenu' ?>" id="menu_abs"><a href="#" class="exp"><span>Album</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='album') echo ' class="this"' ?>><a href="index.html?com=photo&act=man&type=album">Hình ảnh</a></li>
        </ul>
    </li> 
    <li class="gallery_li<?php if($com=='photo') echo ' activemenu' ?>" id="menu7"><a href="#" class="exp"><span>Slider</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='slider') echo ' class="this"' ?>><a href="index.html?com=photo&act=man&type=slider">Hình ảnh slider</a></li>
            <!-- <li<?php if($type=='doitac') echo ' class="this"' ?>><a href="index.html?com=photo&act=man&type=doitac">Đối tác</a></li> -->
        </ul>
    </li>
    <li class="marketing_li<?php if($com=='yahoo' || $com=='link') echo ' activemenu' ?>" id="menu6"><a href="#" class="exp"><span>Liên kết</span><strong></strong></a>
        <ul class="sub">
            <li <?php if($type=='hotline') echo ' class="this"' ?>><a href="index.html?com=link&act=man&type=hotline">Hotline</a></li>
            <li <?php if($type=='mangxh') echo ' class="this"' ?>><a href="index.html?com=link&act=man&type=mangxh">Mạng xã hội</a></li>
            <!-- 
            <li <?php if($com=='link') echo ' class="this"' ?>><a href="index.html?com=link&act=man&type=link">Hỗ trợ trực tuyến</a></li> -->
        </ul>
    </li>
    <li class="video_li<?php if($com=='video') echo ' activemenu' ?>" id="menu_v"><a href="#" class="exp"><span>Video</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($com=='video') echo ' class="this"' ?>><a href="index.html?com=video&act=man&type=video">Video clips</a></li>
        </ul>
    </li>
    <li class="album_li<?php if($com=='bannerqc' | $com=='background' ) echo ' activemenu' ?>" id="menu_alb"><a href="#" class="exp"><span>Cấu hình hình ảnh</span><strong></strong></a>
        <ul class="sub">
            <li<?php if($type=='logo') echo ' class="this"' ?>><a href="index.html?com=bannerqc&act=capnhat&type=logo">Logo</a></li>
            <li<?php if($type=='favicon') echo ' class="this"' ?>><a href="index.html?com=bannerqc&act=capnhat&type=favicon">Favicon</a></li>    
            <li<?php if($type=='qc') echo ' class="this"' ?>><a href="index.html?com=bannerqc&act=capnhat&type=qc">Banner qc</a></li>
            <li<?php if($type=='bgfooter') echo ' class="this"' ?>><a href="index.html?com=background&act=capnhat&type=bgfooter">Background footer</a></li>
            <!-- 
            <li<?php if($type=='banner') echo ' class="this"' ?>><a href="index.html?com=bannerqc&act=capnhat&type=banner">Banner</a></li>
            <li<?php if($type=='popup') echo ' class="this"' ?>><a href="index.html?com=bannerqc&act=capnhat&type=popup">Popup</a></li>
            <li<?php if($type=='bgweb') echo ' class="this"' ?>><a href="index.html?com=background&act=capnhat&type=bgweb">Background header</a></li>
            <li<?php if($type=='bocongthuong') echo ' class="this"' ?>><a href="index.html?com=bannerqc&act=capnhat&type=bocongthuong">Bộ công thương</a></li>
        -->
    </ul>
</li>
<li class="template_li<?php if($com=='setting' || $com=='newsletter' || $com=='bannerqc') echo ' activemenu'?>" id="menu_st"><a href="#" class="exp"><span>Thông tin công ty</span><strong></strong></a>
    <ul class="sub">
        <li<?php if($com=='setting') echo ' class="this"' ?>><a href="index.html?com=setting&act=capnhat">Cấu hình chung</a></li>
        <!-- <li<?php if($com=='newsletter') echo ' class="this"' ?>><a href="index.html?com=newsletter&act=man">Đăng ký nhận tin</a></li> -->
    </ul>
</li>
</ul>