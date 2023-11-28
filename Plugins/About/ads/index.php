<?php
	$qc = $db->row("select photo_vi as photo,link from #_photo where type='qc' limit 1 ");
?>

<div id="boxAds" class="clearfix">
	<a href="<?= $qc['link'] ?>" target="_blank" title="<?= $Setting["shortname_$lang"] ?>">
		<img src="<?= _upload_hinhanh_l.'1366x290x1/'.$qc['photo'] ?>" alt="<?= $Setting["shortname_$lang"] ?>"/>
	</a>
</div>