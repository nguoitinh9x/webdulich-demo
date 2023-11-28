<?php
	$tuvan = $db->query("select name_$lang,slug,description_$lang from #_post where shows=1 and type='tu-van' order by number,id desc");
?>
<div id="boxtuvan">
	<div class="container">
		<div class="title-style-1">
			<h2>ưu đãi & tư vấn miễn phí</h2>
			<p><?= $trangchu["description_$lang"] ?></p>
		</div>
		<div class="owl-tuvan">
			<?php foreach ($tuvan as $value) { ?>
				<div class="tuvan">
					<h3><?= $value["name_$lang"] ?></h3>
					<div class="des">
						<p><?= $func->catchuoi($value["description_$lang"],320) ?></p>
					</div>
					<a class="btn" href="lien-he/" title="Đăng ký ngay">Đăng ký ngay</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>