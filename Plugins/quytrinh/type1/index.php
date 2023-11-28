<?php
  $quytrinh  =  $db->query("select name_$lang,description_$lang,slug,photo,id from #_post where shows=1 and type='quytrinh' order by number,id desc");
?>
<div id="quytrinh">
    <div class="thanh_title"><h2>quy trình <span>vận chuyển</span></h2></div>
    <div class="owl_ct none_control">
        <?php for($i=0;$i<count($quytrinh);$i++){?>
          <div class="owl_quytrinh">
              <p><a href="dich-vu/<?=$quytrinh[$i]['slug']?>.html"><img src="<?=_upload_post_l.'100x100x1/'.$quytrinh[$i]['photo']?>" alt="<?=$quytrinh[$i]['name_'.$lang]?>" /></a></p>
              <h3><a href="dich-vu/<?=$quytrinh[$i]['slug']?>.html"><?=$quytrinh[$i]['name_'.$lang]?></a></h3>
          </div>
        <?php } ?>
      </div>
</div>
<script type="text/javascript">
  $(document).ready(function(e) {
    $('.owl_ct').owlCarousel({
          loop:false,
          margin:22,
          responsiveClass:true,
          responsive:{
              0:{
                  items:2,
                  nav:true
              },
              600:{
                  items:3,
                  nav:true
              },
              1000:{
                  items:4,
                  nav:true,
              }
          }
    })
  });
</script>