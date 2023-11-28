<?php
	$mangxahoi = $db->query("select link, photo, name_$lang from #_link where shows=1 and type='mangxh' order by number,id desc");
?>
<div class="mangxh clearfix">
	<span>Follow us: </span>
	<?php foreach ($mangxahoi as $value) : ?>
		<a rel="noreferrer" href="<?= $value['link']?>" title="<?= $value["name_$lang"] ?>" target="_blank">
			<img class="zimges" src="<?= _upload_hinhanh_l.'27x27x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
		</a>
	<?php endforeach ?>
</div>

<div id="mangxh_fixed">
	<?php foreach ($mangxahoi as $value) : ?>
		<a rel="noreferrer" href="<?= $value['link']?>" title="<?= $value["name_$lang"] ?>" target="_blank">
			<img src="<?= _upload_hinhanh_l.'40x40x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
		</a>
	<?php endforeach ?>
</div>