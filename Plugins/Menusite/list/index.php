<?php 
	$MenuList = $db->query("select id, name_$lang, slug from #_cate_list where shows=1 and type='product' order by number,id desc limit 8");
	$danhmuc = $db->query("select name_$lang,ficon,link from #_link where type='danhmuc' and shows=1 order by number asc,id desc");
?>
<div class="menusite clearfix">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-3">
				<div class="boxheadmenu">
					<div class="lbl"><i class="fas fa-bars"></i> <span>Danh mục sản phẩm</span></div>
					<ul class="ul listmenu">
						<?php foreach ($MenuList as $vl) :
							$db->bindMore(array("type"=>"product", "id_list"=>$vl['id']));
							$MenuCats = $db->query("select name_$lang, slug from #_cate_cat where shows=1 and type=:type and id_list=:id_list order by number,id desc");
							?>
							<li><a href="san-pham/<?= $vl['slug'] ?>/" title="<?= $vl["name_$lang"] ?>"><?= $vl["name_$lang"] ?></a>
								<?php if (!empty($MenuCats)): ?>
									<ul class="ul">
										<?php foreach ($MenuCats as $value): ?>
											<li><a href="san-pham/<?= $vl['slug'] ?>/<?= $value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></li>
										<?php endforeach ?>
									</ul>
								<?php endif ?>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
			<div class="col-9">
				<ul class="ul menu2 text-center row">
					<?php foreach ($danhmuc as $value): ?>
						<li class="col"><a href="<?= $value['link'] ?>" title="<?= $value["name_$lang"] ?>"><i class="mr-2 <?= $value['ficon'] ?>"></i><?= $value["name_$lang"] ?></a></li>
					<?php endforeach ?>
					<li class="col">
						<a class="cart" href="gio-hang/" title="Giỏ hàng"><i class="fas fa-cart-plus"></i><span><?=count($_SESSION['cart'])?></span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>