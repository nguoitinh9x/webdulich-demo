<?= $nhantin->html() ?>

<div class="footer clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-lg-5 mb-4">
				<h5><?= $Setting["name_$lang"] ?></h5>
				<?= $thongtin_ft->html() ?>
				<?= $mangxh->html() ?>
			</div>
			<div class="col-lg-3 col-sm-6 mb-4">
				<h6>Fanpage</h6>
				<?= $facebook->html() ?>
			</div>
			<div class="col-lg-4 col-sm-6 mb-4 pl-lg-5">
				<h6>Bản đồ</h6>
				<div class="map"><?= $Setting['location_map'] ?></div>
			</div>
		</div>
	</div>
</div>
<div id="copyright">
	<div class="container clearfix">
		<div class="row align-items-center">
			<div class="col-lg-6 copy text-lg-left">
				Copyright &copy; 2020 <span> <?=$Setting["shortname_$lang"]?></span>
				<a href="https://thietkewebcip.com" target="_blank" title="Designed by Thiết kế web CIP Media"> All rights reserved.</a>
			</div>
			<div class="col-lg-6 pt-2 pt-lg-0 text-lg-right">
				<?=$thongke->html()?>
			</div>
		</div>
	</div>
</div>

<?= $toolbar->html() ?> 