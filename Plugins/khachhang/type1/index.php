<?php 
	$customers = $db->query("select name_$lang,description_$lang, photo,slug,attributes from #_post where shows=1 and type='khach-hang' order by number,id desc");
?>

<?php if(count($customers)>0):?>
	<div class="Customers clearfix">
		<div class="container">
			<div class="title-style-1"><h2>Ý kiến khách hàng</h2></div>
			<div class="boxing mt-3">
				<div class="OwlCustomers">
					<?php foreach ($customers as $key => $value): $thongtin = json_decode($value['attributes'],true); ?>
						<div class="items text-center">
							<div class="boximg ">
								<img src="<?= _upload_post_l.'150x150x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>">
							</div>
							<div class="name  ">
								<p class="h4"><?= $func->catchuoi($value["description_$lang"],180) ?></p>
								<p class="quote"><i class="fas fa-quote-left"></i></p>
								<h3><?= $value["name_$lang"] ?></h3>
								<span><?= $thongtin['address'] ?></span>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>	
		</div>
	</div>
<?php endif ?>