<h1 class="visit_hidden"><?= $Setting['title'] ?></h1>

<?= $Slider->html() ?>

<?= $Hot->html() ?>

<?= $Ads->html() ?>

<?= $Tour->html() ?>

<?= $Album->html() ?>

<div class="container pb-5 clearfix">
	<div class="row">
		<div class="col-lg-6 mb-4">
			<?= $Video->html() ?>
		</div>
		<div class="col-lg-6">
			<?= $News->html() ?>
		</div>
	</div>
</div>