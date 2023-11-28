<?php
    $visaochon = $db->query("select name_$lang,icon,description_$lang from #_post where shows=1 and type='visaochon' order by number,id desc");
?>

<div id="chonchungtoi">
	<div class="container py-5">
		<div class="owl-chonchungtoi">
			<?php foreach ($visaochon as $value) : ?>
				<div class="chonchungtoi">
					<div class="img">
						<img src="<?=_upload_post_l.'120x120x1/'.$value['icon']?>" alt="<?= $value["name_$lang"] ?>">
					</div>
					<div class="details">
						<h3><?= $value["name_$lang"] ?></h3>
						<p><?= $func->catchuoi($value["description_$lang"],300) ?></p>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>