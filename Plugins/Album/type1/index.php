<?php
	$albums = $db->query("select id, name_$lang, photo, icon, description_$lang from #_post where shows=1 and type='album' and highlight=1 order by number,id desc"); 
?>
<div id="album" class="clearfix">
	<div class="container">
		<div class="title-style-1">
			<p>Đẹp hơn mỗi ngày</p>
			<h2>Hình ảnh khách hàng</h2>
		</div>
		<div class="row">
			<?php foreach ($albums as $value) { ?>
				<div class="col-lg-6">
					<div class="img ">
						<a class="items" href="<?=_upload_post_l.$value['photo']?>" data-fancybox="images" data-caption="<?=$value["name_$lang"]?>">
							<img src="<?=_upload_post_l.'255x358x1/'.$value['photo']?>" alt="<?=$value["name_$lang"]?>"/>
						</a>
						<a class="items" href="<?=_upload_post_l.$value['icon']?>" data-fancybox="images" data-caption="<?=$value["name_$lang"]?>">
							<img src="<?=_upload_post_l.'255x358x1/'.$value['icon']?>" alt="<?=$value["name_$lang"]?>"/>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>