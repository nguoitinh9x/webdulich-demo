<?php
	$gioithieu = $db->row("select name_$lang,photo,description_$lang from #_info where type='gioi-thieu' ");
?>
<div class="gioithieu py-5 clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mb-4">
				<div class="img">
					<img class="w-100" src="<?= _upload_hinhanh_l.'555x444x1/'.$gioithieu['photo'] ?>" alt="<?= $gioithieu["name_$lang"] ?>">
				</div>
			</div>
			<div class="col-md-6 pl-lg-5">
				<div class="title-style-1">
					<h2><?= $gioithieu['name_'.$lang] ?></h2>
				</div>
				<div class="details text-center">
					<p><?= $func->catchuoi($gioithieu['description_'.$lang],700) ?></p>
					<a class="btn allview mt-4" href="gioi-thieu/" title="Xem tất cả">Xem tất cả</a>
				</div>
			</div>
			
		</div>
	</div>
</div>