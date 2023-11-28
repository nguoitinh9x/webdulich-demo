<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	defined( 'ROOT' ) ?:  define( 'ROOT', dirname(__DIR__));
	defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );
	require_once ROOT . '/Library/autoload.php';

	$row_setting = $db->row("select * from #_setting limit 0,1");

	$ten_input=$_POST['name'];
	$diachi_input=$_POST['address'];
	$dienthoai_input=$_POST['phone'];
	$email_input=$_POST['email'];
	$noidung_input=$_POST['content'];
	$phuongthuc_input=$_POST['phuongthuc'];
	$tinhthanh=$_POST['tinhthanh'];
	$phivanchuyen=$_POST['phivanchuyen'];
	$quanhuyen=$_POST['quanhuyen'];
	$diachigiaohang=$_POST['diachigiaohang'];
	$thoigiangiao=$_POST['thoigiangiao'];

	$mahoadon=$func->madonhang('DH','order');
	$ngaydangky=date('Y-m-d H:i:s');
	$tonggia=$cart->get_order_total();
	$mathanhvien=$_SESSION['login']['mathanhvien'];

	if($_POST['phivanchuyen']==0) $phi_vc = 'Miển phí'; else $phi_vc = number_format($_POST['phivanchuyen'],0,",",",").' đ';

	include_once LIB."phpMailer/class.phpmailer.php";	
		$mail = new PHPMailer();

		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = 'smtp.mailgun.org'; // tên SMTP server
		$mail->SMTPAuth   = true;                // Sử dụng đăng nhập vào account
		$mail->Port   = 587;
		$mail->Username   = 'postmaster@mailer.thietkewebcip.vn'; // SMTP account username
		$mail->Password   = '5d7dc23c799c12aa464bddcdd9411169-5645b1f9-a90c0598'; 

		/*		
		$mail->Host       = 'localhost'; // tên SMTP server
		$mail->SMTPAuth   = false;                  // Sử dụng đăng nhập vào account
		$mail->Port 	  = 25; // SMTP account username
		*/

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom(C_EMAIL,$row_setting['name_'.$lang]);
		
		$mail->AddAddress($row_setting['email'],$row_setting['name_'.$lang]);	
		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
 		*=====================================*/
		//Thiết lập tiêu đề
		$mail->Subject = $_POST['name'];
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	
		$body = '<p>Xin chào <b>'.$ten_input.' !</b><br />Cảm ơn quý khách đã mua hàng tại '.$row_setting['name_vi'].'!<br />
		Đơn hàng mới của quý khách vừa được tạo vào lúc <span style="line-height: 20.7999992370605px;"><strong>'.$ngaydangky.'</strong> với thông tin như sau:</span><br />
		&nbsp;</p>';
		$body .= '
		<div class="block clearfix">
		<table class="rows2" style="margin-bottom:2px;width:100%;border:1px solid rgb(245, 245, 245);padding:5px;border-collapse: collapse;">
		<tbody>
		<tr>
		<td>
		<table>
		<tbody>
		<tr>
		<td width="200px"><span style="line-height: 20.7999992370605px; text-align: -webkit-center;">Mã đơn hàng</span></td>
		<td width="800px">:&nbsp;<strong><span style="line-height: 20.7999992370605px;">'.$mahoadon.'</span></strong></td>
		</tr>
		<tr>
		<td>Tên khách hàng</td>
		<td>: <strong>'.$ten_input.'</strong></td>
		</tr>
		<tr>
		<td>Điện thoại</td>
		<td>: '.$dienthoai_input.'</td>
		</tr>
		<tr>
		<td>Email</td>
		<td>: '.$email_input.'</td>
		</tr>
		<tr>
		<td>Địa chỉ</td>
		<td>: '.$diachi_input.', '.$func->getaddress_name($quanhuyen,'dist').', '.$func->getaddress_name($tinhthanh,'city').'</td>
		</tr>
		<tr>
		<td>Hình thức thanh toán</td>
		<td>: '.$phuongthuc_input.'</td>
		</tr>

		<tr>
		<td>Ghi chú đơn hàng</td>
		<td>: '.$noidung_input.'</td>
		</tr>
		<tr>
		<td><span style="color:#ff0000;"><span style="font-size:16px;"><strong>Tổng thanh toán</strong></span></span></td>
		<td><span style="color:#ff0000;"><span style="font-size:16px;"><strong>: </strong></span><span style="font-size:18px;"><strong>'. number_format($cart->get_order_total()+$phivanchuyen,0, ',', '.') .' đ</strong></span></span></td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		<hr />
		';

		$body .='<div style="text-align: center;"><span style="color:null;"><span style="font-size:18px;"><strong>THÔNG TIN CHI TIẾT ĐƠN HÀNG</strong></span></span></div>';
		$body .='
		<table align="center" border="0" cellpadding="10" cellspacing="1" style="width: 100%;">
		<caption>&nbsp;</caption>
		<thead style="background: #ccc">
		<tr>
		<th scope="col" width="5%">STT</th>
		<th scope="col" witdh="15%">HÌNH ẢNH</th>
		<th scope="col" witdh="40%">TÊN SẢN PHẨM</th>
		<th scope="col" witdh="15%">ĐƠN GIÁ</th>
		<th scope="col" witdh="10%">SỐ LƯỢNG</th>
		<th scope="col" witdh="15%">THÀNH TIỀN</th>
		</tr>
		</thead>
		<tbody>';
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$pinfo = $cart->get_product_info($pid);
			if ($q==0) {continue; } // Bỏ sản phẩm số lượng bằng 0
			$body .= '<tr style="border-bottom: 1px solid #ccc">
			<td style="text-align: center;">'.$stt.'</td>';
			$body .= '<td style="text-align: center;"><a href="'._SITEURL_.'/san-pham/'.$pinfo['slug'].'" target="_blank"><img src="'._SITEURL_.'/Upload/product/'.$pinfo['thumb'].'" width="70" /></a></td>';
			$body .= '<td><strong><a href="'._SITEURL_.'/san-pham/'.$pinfo['slug'].'" target="_blank">'.$pinfo['name_'.$lang].'</a></strong></td>';
			$body .= '<td style="text-align: right;"><strong>'.number_format($pinfo['price'],0, ',', '.').' đ</strong></td>';
			$body .= '<td style="text-align: center;">'.$q.'</td>';
			$body .= '<td style="text-align: right;"><span style="font-size:14px;"><span style="color:#cc0000;"><strong>'.number_format($pinfo['price']*$q,0, ',', '.').' đ</strong></span></span></td>';
		}
		$body .= '
		<tr>
		<td colspan="5" style="text-align: center;"><span style="font-size:16px;"><strong><span style="color:#cc0000;">Tổng tiền hàng</span></strong></span></td>
		<td style="text-align: right;"><span style="font-size:16px;"><span style="color:#cc0000;"><strong>'. number_format($cart->get_order_total(),0, ',', '.') .' đ</strong></span></span></td>
		</tr>
				<tr>
		<td colspan="5" style="text-align: center;"><span style="font-size:16px;"><span style="color:#000099;"><strong>Phí vận chuyển</strong></span></span></td>
		<td style="text-align: right;"><span style="font-size:16px;"><span style="color:#000099;"><strong>'. number_format($phivanchuyen,0, ',', '.') .' đ</strong></span></span></td>
		</tr>
		<tr>
		<td colspan="5" style="text-align: center;"><span style="font-size:18px;"><span style="color:#ff0000;"><b>TỔNG THANH TOÁN</b></span></span></td>
		<td style="text-align: right;"><span style="font-size:18px;"><span style="color:#ff0000;"><strong>'. number_format($cart->get_order_total()+$phivanchuyen,0, ',', '.') .' đ</strong></span></span></td>
		</tr>
		</tbody>
		</table>
		';

		$body .='
		<hr />
		<p><span style="font-size:20px;"><strong><span style="color:#ff0000;">'.$row_setting['name_'.$lang].'</span></strong></span><br />
		ADD: <strong>'.$row_setting['address_'.$lang].'</strong><br />
		PHONE:<strong> '.$row_setting['phone'].'</strong><br />
		HOTLINE: <strong>'.$row_setting['hotline'].'</strong><br />
		EMAIL: <strong>'.$row_setting['email'].'</strong><br />
		&nbsp;</p>
		<p>Đây là email được gửi tự động từ website <span style="line-height: 20.7999992370605px;">'._SITEURL_.'</span>, vui lòng không trả lời email này vì chúng tôi sẽ không nhận được email của bạn. Nếu không hiểu về nội dung email này hãy đơn giản xóa nó khỏi hòm thư của bạn. Chân thành cảm ơn!</p>
		</div>
		';

		$db->query("INSERT INTO  table_order(order_code,view,name,phone,address,email,type_payment,totalprice,content,datecreate,status,city,district,shiping_price,member_code)  VALUES ('$mahoadon','0','$ten_input','$dienthoai_input','$diachi_input','$email_input','$phuongthuc_input','$tonggia','$noidung_input','$ngaydangky','1','$tinhthanh','$quanhuyen','$phivanchuyen','$mathanhvien')");

		$id_order = $db->InsertId();
		for($i=0;$i<$max;$i++){
			$pid = $_SESSION['cart'][$i]['productid'];
			$q = $_SESSION['cart'][$i]['qty'];
			$pinfo = $cart->get_product_info($pid);
			if($q==0) continue;

			$data['id_product'] = $pid;
			$data['id_order'] = $id_order;
			$data['name'] = $pinfo['name_'.$lang];
			$data['price'] = $pinfo['price'];
			$data['amount'] = $q;
			$db->setTable('order_detail');
			$db->insert($data);
		}
		$mail->Body = $body;
		if($mail->Send()){
			echo 1;
			unset($_SESSION['cart']);			
		}
		else echo 0;
?>