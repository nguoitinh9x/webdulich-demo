<?php
	$gioithieu = $db->row("select * from #_info where type='gioi-thieu' ");
?>

<div id="gioithieu" class="clearfix pb-4">
	<div class="container">
		<div class="line-bg pb-3 mb-4"></div>
		<div class="row">
			<div class="col-lg-10 mx-lg-auto text-center">
				<h2 class="title-about"><?= $gioithieu["name_$lang"] ?></h2>
				<p><?= $gioithieu['description_'.$lang] ?></p>
			</div>
		</div>
		<div class="w-100 text-center mt-3">
			<a class="btn allview" href="gioi-thieu/" title="Xem thêm">Xem thêm</a>
		</div>
	</div>
</div>