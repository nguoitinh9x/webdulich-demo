<?php
	$db->bindMore(array("type"=>"link"));
	$link = $db->query("select link, photo, name_$lang from #_link where shows=1 and type=:type order by number,id desc ");
?>
<div class="mangxh">
	<?php foreach ($link as $value) {?>
		<a rel="noreferrer" href="<?=$value['link']?>" title="<?=$value['name_$lang']?>" target="_blank">
			<img class="zimges" src="<?=_upload_hinhanh_l.$value['photo']?>" alt="<?=$value['name_$lang']?>"/>
		</a>
	<?php } ?>
</div>