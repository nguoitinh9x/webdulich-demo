<?php
      $row_lienhe  =  $db->row("SELECT COUNT(*) as num FROM #_contact where view=0 ");
      $tong_count = 0;

      if($config['setup']['cart']=='true'){
          $row_giohang  =  $db->row("SELECT COUNT(*) as num FROM #_order where view=0");
          $tong_count +=$row_giohang['num'];
      }
      $tong_count += $row_lienhe['num'];
?>
<div class="wrapper">
    <div class="welcome"><a href="#" title=""><img src="Assets/images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login']['username']?>!</span></div>
    <div class="userNav">
        <ul>
            <!-- <li><a href="index.html?com=user&act=man" title=""><span>Quản trị thành viên</span></a></li>
            <li><a href="index.html?com=permission&act=man" title=""><span>Quản trị phân quyền</span></a></li> -->
            <?php if(count($config['lang'])>1){?>
            <li><a href="index.html?com=lang&act=man" title=""><span>Ngôn ngữ</span></a></li>
            <?php } ?>
            <li><a href="<?=_BASEURL_?>" title="" target="_blank"><img src="Assets/images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
            <li><a href="index.html?com=user&act=admin_edit" title=""><img src="Assets/images/icons/topnav/profile.png" alt="" /><span>Thông tin tài khoản</span></a></li>
            <li class="ddnew"><a title=""><img src="Assets/images/icons/topnav/messages.png" alt="" /><span>Thông báo</span><span class="numberTop"><?=$row_lienhe['num']?></span></a>
                <ul class="userMessage">
                    <li><a href="index.html?com=contact&act=man&type=contact" title="" class="sInbox"><span>Liên hệ</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_lienhe['num']?></span></a></li>
                </ul>
            </li>
            <?php if($config['setup']['cart']=='true'){ ?>
            <li class="ddnew"><a title=""><img src="Assets/images/icons/topnav/messages.png" alt="" /><span>Đơn hàng</span><span class="numberTop"><?=$row_giohang['num']?></span></a>
                <ul class="userMessage">
                    <li><a href="index.html?com=order&act=man" title="" class="sInbox"><span>Quản lý đơn</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_giohang['num']?></span></a></li>
                    <li><a href="index.html?com=title&act=man&type=httt" title="" class="sInbox"><span>Hình thức thanh toán</span></a></li>
                    <li><a href="index.html?com=title&act=man&type=tinhtrangdh" title="" class="sInbox"><span>Tình trạng</span></a></li>
                    <li><a href="index.html?com=title&act=man&type=khoangia" title="" class="sInbox"><span>Khoản giá</span></a></li>
                </ul>
            </li>
            <?php } ?>
            <li><a href="index.html?com=user&act=logout" title=""><img src="Assets/images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
            <li><a href="../sitemap.php" title="" target="_blank"><span>Cập nhật sitemap</span></a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>