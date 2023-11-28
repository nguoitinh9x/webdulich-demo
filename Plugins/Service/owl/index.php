<?php
    $listDV = $db->query("select slug,name_$lang,photo from #_cate_list where shows=1 and highlight=1 and type='dich-vu' order by number,id desc");
?>

<div id="boxDv">
	<div class="container clearfix">
		<div class="title-style-1 pb-5 clearfix"><h2>Dịch vụ</h2></div>
		<div class="owl-dichvu">
			<?php foreach ($listDV as $value) : ?>
				<div class="dichvu">
					<div class="img">
						<a class="d-block effect-v8" href="<?= 'dich-vu/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
							<img src="<?=_upload_cate_l.'220x220x1/'.$value['photo']?>" alt="<?= $value["name_$lang"] ?>">
						</a>
					</div>
					<h3 class="details"><a href="<?= 'dich-vu/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>