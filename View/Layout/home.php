<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
	<?php require_once LAYOUT."head_tpl.php"; ?>
</head>
<body>
	<?=$Setting['codebody']?>
	<div id="container">
		<header <?= $source!='index' ? 'class="pagein"' : '' ?>>
			<?php include LAYOUT."header_tpl.php"; ?>
		</header>
		<main <?= $source!='index' ? 'class="pagein"' : '' ?> >
			<section id="content">
				<?php include VIEW.$template."_tpl.php"; ?>
			</section>
		</main>
		<footer>
			<?php include LAYOUT."footer_tpl.php"; ?>
		</footer>		
	</div>
	<ul class="vcard d-none">
		<li class="fn"><?= $Setting["shortname_$lang"] ?></li>
		<li class="org"><?= $Setting["name_$lang"] ?></li>
		<li class="adr"><?= $Setting["address_$lang"] ?></li>
		<li class="tel"><?= $Setting['hotline'] ?></li>
		<li class="pricerange">10000 - 1000000</li>
		<li><a class="url" href="<?=$Setting['website']?>"><?= $Setting['website'] ?></a></li>
		<li><img class="photo" src="<?= _upload_hinhanh_l.$Logosite ?>"  alt="<?= $Setting["name_$lang"] ?>"></li>
	</ul>
	<?php require_once LAYOUT."bottom_tpl.php";?>

	<?= $js->backTop() ?>
	<?= $js->cut_copy_paste() ?>
	<?php if($config['rating']==true && $template!='index'){ echo $rating->js(); } ?>
	<?= $Setting['codebottom'] ?>
	<?= $fb->sdk() ?>
</body>
</html>