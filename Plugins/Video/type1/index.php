<?php 
	$VideoClips = $db->query("select name_$lang as name,link,photo from #_video where shows=1 and type='video' order by number,id desc ");
?>

<div class="videos clearfix">
	<div class="title-style-2 clearfix"><h2>Video</h2></div>
	<div class="videobox">
		<div class="mastervideo">
			<img class="w-100" src="<?= _upload_video_l.'580x320x1/'.$VideoClips[0]['photo'] ?>" alt="<?= $VideoClips[0]['name'] ?>">
			<div class="btnplay">
				<a class="fancybox" data-fancybox-type="iframe" href="<?= $VideoClips[0]['link'] ?>?autoplay=1"><i class="far fa-play-circle"></i></a>
			</div>
		</div>
		<div class="owlvideos">
			<?php foreach ($VideoClips as $key => $value): ?>
				<div class="items ivideos">
					<a href="javascript:;" data-href="<?=  $value['link'] ?>?autoplay=1" data-src="<?= _upload_video_l.'580x320x1/'.$value['photo'] ?>">
						<img src="<?= _upload_video_l.'190x100x1/'.$value['photo'] ?>" alt="<?= $value['name'] ?>">
					</a>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>