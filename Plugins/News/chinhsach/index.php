<?php
	$chinhsach = $db->query("select name_$lang,slug,photo,description_$lang from #_post where shows=1 and type='chinh-sach' order by number,id desc");
?>
<div id="boxCS">
	<div class="container">
		<div class="owl-cs">
			<?php foreach ($chinhsach as $value): ?>
				<div class="boxCS">
					<div class="img"><img src="<?=_upload_post_l.'70x70x1/'.$value['photo']?>" alt="<?= $value["name_$lang"] ?>"></div>
					<div class="details">
						<h3><a href="chinh-sach/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
						<p><?= $func->catchuoi($value["description_$lang"],120)?></p>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>