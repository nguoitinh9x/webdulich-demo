<?php 
	$result_cityship = $db->query("select id,name from #_place_city order by name asc");
	$result_banking = $db->query("select name_vi,photo,attributes from #_title where type='bank' and shows=1 order by id,number desc");
?>

<div class="container clearfix">
	<?=$breadcrumbs->urls($row_detail)?>

	<div class="title-style-1"><h1><?=_giohang?></h1></div>
	<div class="cart-shopee clearfix">
		<div class="row">
			<div class="col-lg-6">
				<div class="cartleft clearfix">
					<div class="title clearfix"><h2>ĐIỀN THÔNG TIN NHẬN HÀNG</h2></div>

					<div class="blockcontent clearfix">
						<label>Họ tên <span class="text-danger">(*)</span></label>
						<input type="text" name="name">
						<div class="clearfix"></div>
						<label>Điện thoại <span class="text-danger">(*)</span></label>
						<input type="text" name="phone">
						<div class="clearfix"></div>
						<div class="clearfix">
							<label>Tỉnh/thành <span class="text-danger">(*)</span></label>
							<div class="blockselect clearfix">
								<select name="ship_tinhthanh" id="ship_tinhthanh" class="js_select2w">
									<option value="">Chọn tỉnh/thành</option>    
									<?php foreach ($result_cityship as $key => $value): ?>
										<option value="<?=$value['id']?>"><?=$value['name']?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="clearfix">
							<label>Quận/huyện <span class="text-danger">(*)</span></label>
							<div class="blockselect clearfix">
								<select name="ship_quan" id="ship_quan" class="js_select2w">
									<option value="">Chọn quận/huyện</option>    
								</select>
							</div>
						</div>
						<label>Địa chỉ <span class="text-danger">(*)</span></label><input type="text" name="address" id="diachiship">	
						<div class="clearfix"></div>
						<label>Email <span class="text-danger">(*)</span></label><input type="text" name="email">
						<div class="clearfix"></div>
						<label>Nội dung</label>
						<textarea name="content"><?=$_POST['content']?></textarea>
						<div class="clearfix"></div>
					</div>
					<div class="choosepay clearfix">
						<div class="title clearfix"><h2>LỰA CHỌN HÌNH THỨC THANH TOÁN</h2></div>
						<div class="clearfix"></div>
						<div class="choosepay-content clearfix">
							<ul class="ul clearfix">
								<li class="clearfix">
									<input type="radio" name="htthanhtoan" id="thanhtoankhinhanhang" data-tttype="tm" value="Thanh toán khi nhận hàng (COD)" ><label for="thanhtoankhinhanhang">Thanh toán khi nhận hàng</label>
								</li>
								<li class="clearfix d-none">
									<input type="radio" name="htthanhtoan" id="thanhtoanchuyenkhoan" data-tttype="ck" value="Thanh toán Chuyển khoản"><label for="thanhtoanchuyenkhoan">Thanh toán qua chuyển khoản</label>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="block-banking clearfix">
							<div class="title clearfix"><h2>Thông tin chuyển khoản</h2></div>
							<div class="clearfix"></div>
							<div class="bankingcontent clearfix">
								<ul class="ul clearfix">
									<?php foreach ($result_banking as $key => $value): 
										$thongtin = json_decode($value['attributes'],true);?>
										<li class="clearfix">
											<div class="img" data-key="<?=$key?>">
												<img src="<?=_upload_hinhanh_l.'150x100x2/'.$value['photo']?>" alt="<?=$value['name_vi']?>">
											</div>
											<ul class="ul details hidden detail-<?=$key?>">
												<li><span>Tên ngân hàng: </span><b><?=$value['name_vi']?></b></li>
												<li><span>Tên chủ tài khoản: </span><b><?=$thongtin['tentk']?></b></li>
												<li><span>Số tài khoản: </span><b><?=$thongtin['sotk']?></b></li>
												<li><span>Chi nhánh: </span><b><?=$thongtin['chinhanh']?></b></li>
											</ul>
										</li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="cartright blockcart clearfix">
					<div class="title clearfix">
						<h2>Giỏ hàng</h2>
						<a class="a-editorcart" href="gio-hang/">Sửa giỏ hàng</a>
					</div>
					<div class="clearfix"></div>
					<div class="blockcontent clearfix">
						<ul class="ul cart_productlist clearfix" id="style-5">
							<?php if(is_array($_SESSION['cart'])){
								foreach ($_SESSION['cart'] as $key => $value): 
									$pid = $value['productid'];
									$q = $value['qty'];
									$pinfo = $cart->get_product_info($pid);?>
									<li class="clearfix">
										<div class="img">
											<img src="Upload/product/<?=$pinfo['thumb']?>"/>
										</div>
										<div class="details">
											<h3><?=$pinfo['name_'.$lang]?></h3>
											<p class="detailsinfo">Giá : <span class="text-danger"><?=number_format($pinfo['price'],0, ',', '.')?> đ</span></p>
										</div>
									</li>
								<?php endforeach;?>
							<?php }else{ echo '<div class="alert alert-danger w-100 clearfix">Giỏ hàng chưa được khỏi tạo !</div>'; }?>
						</ul>
						<div class="billtotal content_payment clearfix">
							<ul class="ul">
								<li>
									<label for="">Tiền hàng: </label>
									<input type="text" value="<?=number_format($cart->get_order_total(),0, ',', '.')?> đ" disabled="" id="pay_tienhang">
								</li>
								<li class="d-none">
									<label for="">Phí vận chuyển: </label>
									<input type="text" value="0" disabled="" id="pay_phivc">
								</li>
								<li class="d-none">
									<label for="">Thời gian dự toán: </label>
									<input type="text" value="0" disabled="" id="pay_thoigian">
								</li>
								<li class=" totalpay">
									<label for="">Tổng thanh toán: </label>
									<input type="text" value="<?=number_format($cart->get_order_total(),0, ',', '.')?> đ" disabled="" id="pay_tongtt">
								</li>							
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="btnbar clearfix">
			<button id="btn_booking">Hoàn thành</button>
		</div>
	</div>
</div>