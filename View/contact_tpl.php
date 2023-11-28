<div class="container">		 
	<?=$breadcrumbs->urls($row_detail)?>
	<div class="title-style-1 clearfix"><h1><?=$title_detail?></h1></div>

	<div class="row">
		<div class="col-lg-6 mb-4">
			<?php if($row_detail['content_'.$lang]!=''){?>
				<div class="modal-content border-0 mb-3"><?=$row_detail['content_'.$lang]?></div>
			<?php }?>
			<div id="map_canvas"><?= $Setting['location_map'] ?></div>
		</div>

		<div class="col-lg-6">
			<div class="contact-form-body">
				<form method="post" action="lien-he/" enctype="multipart/form-data">
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-user"></i></div>
						</div>
						<input class="form-control" type="text" name="name" required placeholder="<?=_hoten?> *">
					</div>
					<div class="form-row ">
						<div class="form-group input-group col-lg-6">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-at"></i></div>
							</div>
							<input class="form-control" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required name="email" placeholder="Email *">
						</div>
						<div class="form-group input-group col-lg-6">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
							</div>
							<input class="form-control" type="text" required name="phone" pattern=".{10}" title="10 số" onkeypress="return isNumberKey(event)" placeholder="<?=_dienthoai?> *">
						</div>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>
						</div>
						<input class="form-control" type="text" name="address" required placeholder="<?=_diachi?> *">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-ribbon"></i></div>
						</div>
						<input class="form-control" type="text" name="title" required placeholder="<?=_tieude?> *">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="content" required placeholder="<?=_noidung?> *"></textarea>
					</div>
					<div class="form-group">
						<div id="captcha-wrap">
							<div class="boxrecapcha"><div id="recaptcha"></div></div>
						</div>
						<button class="btn btn-danger btn-color px-4 py-2">Gửi</button>
					</div>
				</form>
			</div>
		</div> 
	</div>
	
</div>