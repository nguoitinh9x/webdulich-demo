<?php
	$dichvu = $db->query("select slug,name_$lang,icon,description_$lang from #_post where shows=1 and type='dichvu' and highlight=1 order by number,id desc");
?>

<div id="boxDv" class="clearfix">
	<div class="container">
		<div class="row">
			<?php foreach ($dichvu as $value){?>
				<div class="col-lg-4 col-md-6">
					<div class="boxDv">
						<div class="img">
							<img src="<?=_upload_post_l.'55x55x1/'.$value['icon']?>" alt="<?=$value["name_$lang"]?>">
						</div>
						<div class="details">
							<h3><a href="dich-vu/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>"><?=$value["name_$lang"]?></a></h3>
							<p><?=$func->catchuoi($value["description_$lang"],300)?></p>
						</div>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</div>