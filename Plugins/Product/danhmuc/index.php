<?php 
	$prod_list = $db->query("select id,name_$lang,slug from #_cate_list where shows=1 and type='product' and highlight=1 order by number,id desc"); 
?>

<div class="boxDm">
	<div class="container">
		<?php foreach ($prod_list as $vl) :
			$prod_cat = $db->query("select id,slug,name_$lang from #_cate_cat where type='product' and shows=1 and id_list='".$vl['id']."' order by number desc,id desc");
			if(count($prod_cat)>0): ?>
			<h2 class="title-style-2"><?= $vl["name_$lang"] ?></h2>
			<div class="row">
				<?php foreach ($prod_cat as $vc) :
					$prod_item = $db->query("select id,slug,name_$lang from #_cate_item where type='product' and shows=1 and id_cat='".$vc['id']."' order by number desc,id desc");
				?>
					<ul class="danhmuc col-xl-2 col-lg-3 col-md-4 col-6">
						<li><a href="san-pham/<?=$vl['slug']?>/<?=$vc['slug']?>" title="<?=$vc["name_$lang"]?>"><?=$vc["name_$lang"]?></a>
							<?php if(count($prod_item)>0): ?>
								<ul class="ul">
									<?php foreach ($prod_item as $value) :?>
										<li><a href="san-pham/<?=$vl['slug']?>/<?=$vc['slug']?>/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>"><?=$value["name_$lang"]?></a></li>
									<?php endforeach ?>
								</ul>
							<?php endif; ?>
						</li>
					</ul>
				<?php endforeach ?>
			</div>
		<?php endif; endforeach ?>
	</div>
</div>