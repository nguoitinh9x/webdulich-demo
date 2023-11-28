<?php 
    $db->bindMore(array("type"=>"quangcao"));
    $quangcao = $db->row("select photo_vi from #_photo where type=:type ");
?>

<div id="quangcao">
	<a class="effect-v8" href="<?=$quangcao['link']?>" target="_blank" title="quảng cáo">
		<img src="<?=_upload_hinhanh_l.'1366x476x1/'.$quangcao['photo_vi']?>" alt="quảng cáo"/>
	</a>
</div>