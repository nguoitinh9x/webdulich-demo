<?php
	$db->bindMore(array("shows"=>1,"type"=>"khachhang"));
	$khachhang = $db->query("select name_$lang,id,slug,thumb,datecreate,photo,description_$lang from #_post where shows=:shows and type=:type order by number,id desc");

	$db->bindMore(array("type"=>"banner2"));
	$banner2 = $db->row("select photo_vi from #_photo where type=:type ");
?>

<div id="khachhang">
	<div class="container">
		<div class="title-style-1"><h2>Ý khách hàng</h2></div>
		<div class="row">
			<div class="col-lg-6">
				<div class="simplyscroll-kh">
					<?php foreach ($khachhang as $key => $value) {?>
						<div class="customer <?php if($key%2==1) echo 'direction';?>">
							<div class="img">
								<a href="khach-hang/<?=$value['slug']?>.html" title="<?=$value['name_'.$lang]?>">
									<img src="<?=_upload_post_l.'125x125x1/'.$value['photo']?>" alt="<?=$value['name_'.$lang]?>"/>
								</a>
							</div>
							<div class="details">
								<h3><a href="khach-hang/<?=$value['slug']?>.html" title="<?=$value['name_'.$lang]?>"><?=$value['name_'.$lang]?></a></h3>
								<p><?=$func->catchuoi($value['description_'.$lang],300)?></p>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="d-none d-lg-block col-lg-6 p-lg-0">
				<div class="itemhover">
					<a class="effect-v4" href="<?=$banner2['link']?>" title="'Banner khách hàng">
						<img class="w-100" src="<?=_upload_hinhanh_l.'570x400x1/'.$banner2['photo_vi']?>" alt="'Banner khách hàng"/>
					</a>
					<i class="i_trai"></i> <i class="i_phai"></i> <i class="i_tren"></i> <i class="i_duoi"></i>
				</div>
			</div>
		</div>
	</div>
</div>