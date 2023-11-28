<?php 
	$slider = $db->query("select photo_$lang as photo,name_$lang as name,link from #_photo where shows=1 and type='slider' order by number,id desc");
    $listTour = $db->query("select id,name_$lang from #_cate_list where shows=1 and type='tour' order by number,id desc");
?>

<div id="slider" class="clearfix">
	<div class="owl-slider clearfix">
		<?php foreach ($slider as $value): ?>
			<div class="items">
				<a rel="noreferrer" href="<?= $value["link"]=='' ? 'javascript:;' : $value["link"].'"target="_blank' ?>" title="<?= $value['name'] ?>">
					<img src="<?=_upload_hinhanh_l.'1366x493x1/'.$value['photo']?>" alt="<?= $value['name'] ?>"/>
				</a>
			</div>
		<?php endforeach ?>
	</div>
	<div class="container">
		<div id="search">
			<div class="row">
				<div class="col-md-3 mb-3 mb-md-0">
					<label>Tìm tour theo tên</label>
					<form method="post" action="tim-kiem/" class="input-group" enctype="multipart/form-data">
						<input class="form-control" type="text" name="name" required placeholder="Tên tour">
						<div class="input-group-append">
							<button class="input-group-text"><i class="fas fa-search"></i></button>
						</div>
					</form>
				</div>
				<div class="col-md-9">
					<label>Tìm tour theo điểm khởi hành</label>
					<form method="post" action="tim-kiem/" enctype="multipart/form-data">
						<div class="form-row align-items-center">
							<div class="form-group col-md-3">
								<input class="form-control" type="text" name="diemkhoihanh" required placeholder="Điểm khởi hành">
							</div>
							<div class="form-group col-md-3">
								<input class="form-control" type="text" name="diemden" required placeholder="Điểm đến">
							</div>
							<div class="form-group col-md-3">
								<select class="form-control" name="idl" required>
									<option value="">Loại tour</option>
									<?php foreach ($listTour as $value) : ?>
										<option value="<?= $value['id'] ?>"><?= $value["name_$lang"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<div class="input-group-append">
									<button class="input-group-text px-4 mx-md-0 mx-auto"><i class="fas fa-search mr-2"></i>TÌM TOUR</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>