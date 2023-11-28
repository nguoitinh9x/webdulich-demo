<?php 
	$prod_list = $db->query("select id,name_$lang,slug,photo from #_cate_list where shows=1 and type='product' and highlight=1 order by number,id desc"); 
?>

<div id="boxProd">
	<div class="container clearfix">
		<div class="title-style-1 pb-5 clearfix"><h2>Sản phẩm</h2></div>
		<div class="row">
			<?php foreach ($prod_list as $vl) :
				$product = $db->query("select id,slug,name_$lang,photo,description_$lang from #_product where type='product' and shows=1 and highlight=1 and id_list='".$vl['id']."' order by number desc,id desc");
				?>
				<div class="col-lg-6 mb-4">
					<div class="items">
						<div class="list-img">
							<a class="imghv d-block" href="<?= 'san-pham/'.$vl['slug'] ?>/" title="<?= $vl["name_$lang"] ?>">
								<img src="<?= _upload_cate_l.'570x440x1/'.$vl['photo'] ?>" alt="<?= $vl["name_$lang"] ?>"/>
							</a>
							<?php foreach ($product as $value) : ?>
								<div class="details this-<?= $value['id'] ?>">
									<h3><?= $value["name_$lang"] ?></h3>
									<p><?= $func->catchuoi($value["description_$lang"], 500) ?></p>
								</div>
							<?php endforeach ?>
						</div>
						<div class="owl-prod">
							<?php foreach ($product as $value): ?>
								<div class="img" data-key="<?= $value['id'] ?>">
									<a class="imghv d-block" href="<?= 'san-pham/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
										<img src="<?= _upload_product_l.'135x180x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
									</a>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>