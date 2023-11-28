<?php
	$selling = $db->query("select name_$lang,slug,photo,description_$lang,price,oldprice,datein from #_post where shows=1 and type='tour' and selling=1 order by number,id desc");
?>

<div class="boxNews clearfix">
	<div class="container clearfix">
		<div class="title-style-1 clearfix"><h2>Tour hot</h2></div>
		<div class="owl-sell">
			<?php foreach ($selling as $value) : ?>
				<div class="items">
					<div class="img">
						<a class="imghv d-block" href="<?= 'tour/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
							<img src="<?= _upload_post_l.'220x180x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
						</a>
					</div>
					<div class="details">
						<h3><a href="<?= 'tour/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
						<p class="des"><strong>Hành trình: </strong><?= $func->catchuoi($value["description_$lang"], 140) ?></p>
						<div class="row">
							<div class="col-8">
								<p class="price"><?= $func->giamoicu($value['price'], $value['oldprice']) ?></p>
								<p class="datein"><strong>Khởi hành: </strong><?= date('d/m/Y', strtotime( $value['datein'] )) ?></p>
							</div>
							<div class="col-4 pl-0 d-flex align-items-center">
								<a class="booktour" href="<?= 'tour/'.$value['slug'] ?>" title="Đặt tour">ĐẶT TOUR</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>