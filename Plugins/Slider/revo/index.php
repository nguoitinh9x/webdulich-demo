<?php 
	$db->bindMore(array('type'=>'slider','shows'=>1));
	$Slider = $db->query("select photo_$lang as photo,name_$lang as name,link from #_photo where shows=:shows and type=:type order by number,id desc");
?>

<div class="blockslidermaster">
	<div class="blockslider rv_slider_wrapper fullwidthbanner-container clearfix ">
		<div id="revoslider" class="rv_slider fullwidthabanner">		
			<ul class="ul">
				<?php foreach ($Slider as $value): ?>
					<li data-transition="random-premium" <?=!empty($value['link']) ? 'data-link="'.$value['link'].'" data-target="_blank" data-slideindex="back"' : '' ?>>
						<img src="<?=_upload_hinhanh_l.'1366x645x1/'.$value['photo']?>" alt="<?=$value['name'] ?>" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"/>
					</li>        
				<?php endforeach ?>
			</ul>
			<div class="tp-bannertimer"></div>
		</div>
	</div>
</div>
