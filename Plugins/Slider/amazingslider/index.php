<?php 
    $Slider = $db->query("select photo_vi as photo, name_vi as name, description_vi as descs, link,youtube from #_photo where shows=1 and type='slider' order by number,id desc");
?>

<div class="amazingslider-wrapper" id="amazingslider-wrapper-1">
	<div class="amazingslider" id="amazingslider-1">
		<ul class="ul amazingslider-slides">
			<?php foreach ($Slider as $key => $value){ 
			if($value['youtube']==''){?>
				<li><img src="<?=_upload_hinhanh_l.'1366x460x1/'.$value['photo']?>" alt="<?= $value['name'] ?>" title="<?= $value['name'] ?>" /></li>
			<?php } else{?>
				<li><video preload="none" src="https://www.youtube.com/embed/<?= $func->youtobi($value['youtube']) ?>"></video></li>
			<?php } } ?>
		</ul>
	</div>
</div>