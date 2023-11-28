<?php
	$post = $db->query("select name_$lang,slug,photo,description_$lang,datecreate from #_post where shows=1 and type='tin-tuc' and highlight=1 order by number,id desc");
?>
<div id="boxNews">
	<ul class="simplyscroll_post ul">
		<?php foreach ($post as $value) {?>
			<li class="items">
				<div class="img">
					<div class="date">
						<p><?=date('d', strtotime($value['datecreate']));?></p>
						<span><?=date('m, Y', strtotime($value['datecreate']));?></span>
					</div>
					<a class="imghv d-block" href="tin-tuc/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
						<img src="<?= _upload_post_l.'170x130x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
					</a>
				</div>
				<div class="details">
					<h3><a href="tin-tuc/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
					<p><?= $func->catchuoi($value["description_$lang"],120)?></p>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>