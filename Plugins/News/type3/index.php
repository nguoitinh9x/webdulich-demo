<?php
	$db->bindMore(array("shows"=>1,"type"=>"nhan-vien","highlight"=>1));
	$nhanvien = $db->query("select name_$lang,slug,photo,description_$lang from #_post where shows=:shows and type=:type and highlight=:highlight order by number,id desc");
?>

<div id="boxMember" class="clearfix">
	<div class="container py-lg-3">
		<div class="title-style-1 text-lg-left">
			<p>Đội ngũ</p>
			<h2>Nhân viên công ty</h2>
		</div>
		<div class="owl-member">
			<?php foreach ($nhanvien as $value) {?>
				<div class="member">
					<div class="img">
						<a class="imghv d-block" href="nhan-vien/<?=$value['slug']?>" title="<?=$value['name_'.$lang]?>">
							<img src="<?=_upload_post_l.'280x380x1/'.$value['photo']?>" alt="<?=$value['name_'.$lang]?>">
						</a>
					</div>
					<div class="details">
						<h3><?=$value['name_'.$lang]?></h3>
						<p><?=$value['description_'.$lang]?></p>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</div>
