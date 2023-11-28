<?php
	$db->bindMore(array("shows"=>1,"type"=>"khachhang"));
	$khachhang  =  $db->query("select name_$lang,id,slug,photo,datecreate,photo,description_$lang from #_post where shows=:shows and type=:type order by number,datecreate desc");
?>

<div id="khachhang" class="clearfix">
	<div class="container">
		<div class="title-style-1 mb-lg-5 clearfix">
			<h2><span>PHỤ HUYNH VÀ</span> HỌC VIÊN NÓI VỀ MQA</h2>
		</div>

		<div class="owl-customer">
			<?php foreach ($khachhang as $key => $value) { ?>
				<div class="customer">
					<div class="img">
						<div class="hexagon" style="background-image: url(<?=_upload_post_l.'170x190x1/'.$value['photo']?>);">
							<div class="hexTop"></div>
							<div class="hexBottom"></div>
						</div>
					</div>
					<div class="details">
						<h3><?=$value['name_'.$lang]?></h3>
						<p><?=$func->catchuoi($value['description_'.$lang],200)?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>


