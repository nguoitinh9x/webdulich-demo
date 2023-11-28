<?php 
	$VideoClips = $db->query("select name_$lang,link,photo from #_video where shows=1 and type='video' and highlight=1 order by number,id desc ");
?>

<div class="videos clearfix">
	<div class="owl-videos">
		<?php foreach ($VideoClips as $value): ?>
			<div class="mastervideo">
				<div class="img">
					<img class="w-100" onerror="this.src='images/noimage.gif'" src="<?= _upload_video_l.'580x400x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>">
					<div class="btnplay">
						<a class="fancybox" data-fancybox-type="iframe" href="<?= $value['link'] ?>?autoplay=1"><i class="fab fa-google-play"></i></a>
					</div>
					<h3 class="title"><?= $value["name_$lang"] ?></h3>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>