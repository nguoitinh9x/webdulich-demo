<?php $popup = $db->row("select thumb_$lang,link,shows from #_photo where type='popup'");
    if(isset($_SESSION['popup'])){
        $_SESSION['popup'] ++;
        if($_SESSION['popup'] > 11) $_SESSION['popup'] = 1;
    }else{
        $_SESSION['popup'] = 1;
    }
    if($popup['shows']==1 && $_SESSION['popup']<=3){?>  
    <div id="popup">
        <div class="popup">
            <div class="close_popup"></div>
            <a rel="noreferrer" href="<?=$popup['link']?>" title="popup" target="_blank">
              <img src="<?=_upload_hinhanh_l.$popup['thumb_'.$lang]?>" alt="<?=$popup['link']?>" class="w-100" />
            </a>
        </div>
    </div>
<?php } ?>