<div class="responsiveslides clearfix">
	<ul class="ul rslides" id="slider5">
		<li><img src="<?= _upload_post_l.'768x460x1/'.$row_detail['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>"></li>
		<?php foreach ($item_photos as $value) : ?>
			<li><img src="<?= _upload_cate_l.'768x460x1/'.$value['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>"></li>
		<?php endforeach ?>
	</ul>
	<?php if(count($item_photos)):  ?>
		<ul id="slider5-pager" class="ul d-none d-sm-block">
			<li>
				<a href="javascript:;" title="<?= $row_detail["name_$lang"] ?>">
					<img src="<?= _upload_post_l.'100x70x1/'.$row_detail['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>">
				</a>
			</li>
			<?php foreach ($item_photos as $value) : ?>
				<li>
					<a href="javascript:;" title="<?= $row_detail["name_$lang"] ?>">
						<img src="<?= _upload_cate_l.'100x70x1/'.$value['photo'] ?>" alt="<?= $row_detail["name_$lang"] ?>">
					</a>
				</li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>
</div>