<?php 
    $db->bindMore(array('type'=>'quangcao','shows'=>1));
    $ads = $db->query("select photo_vi as photo, name_vi as name, link from #_photo where shows=:shows and type=:type order by number,id desc");
?>

<div class="w-100">
	<div class="owl-ads">
		<?php foreach ($ads as $value) {?>
			<div class="img">
				<a class="effect-v8" href="<?=$value['link']?>" title="<?=$value['name']?>">
					<img src="<?=_upload_hinhanh_l.'1366x334x1/'.$value['photo']?>" alt="<?=$value['name']?>" />
				</a>
			</div>
		<?php } ?>
	</div>
</div>