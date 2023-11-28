<?php
	$db->bindMore(array("type"=>'lienhe'));
	$row_detail  =  $db->row("select * from #_info where type=:type");
	$title_detail .= $title_com;

	if(!empty($_POST)){
		if (isset($_POST['g-recaptcha-response'])) {
			$secretKey ='6LfzH3YUAAAAAO3fS-Irvr0xwebj_9-xrZcxioeu';
			$recaptcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
			if($recaptcha==='') {		
				$func->transfer("Bạn cần xác nhận không là Robot!", _BASEURL_."lien-he/",false);
			}
			$ip = $_SERVER['REMOTE_ADDR'];
			$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$recaptcha."&remoteip=".$ip);
			$responseKeys = json_decode($response,true);
			if(intval($responseKeys["success"]) != 1 ) {$func->transfer("Lỗi bảo mật xảy ra! Vui lòng thao tác lại!", _BASEURL_."lien-he/",false); die; }
		}

		$file_name = $func->images_name($_FILES['file']['name']);
		if($file_att = $func->upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|xlsx|jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh_l,$file_name)){
			$data['photo'] = $file_att;
		}
		include_once LIB."phpMailer/class.phpmailer.php";	
		$mail = new PHPMailer();
			
		$mail->Host       = 'localhost'; // tên SMTP server
		$mail->SMTPAuth   = false; // Sử dụng đăng nhập vào account
		$mail->Port 	  = 25; // SMTP account username

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom(C_EMAIL,$Setting['name_'.$lang]);
		$mail->AddAddress($Setting['email'],$Setting['name_'.$lang]);
		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
		*=====================================*/

		//Thiết lập tiêu đề
		$mail->Subject    = $_POST['title'];
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	
		$body = '<table>';
		$body .= '
		<tr> 
		<th colspan="2">&nbsp;</th>
		</tr>
		<tr>
		<th colspan="2">Thư liên hệ từ website <a href='._BASEURL_.'>'._BASEURL_.'</a></th>
		</tr>
		<tr>
		<th colspan="2">&nbsp;</th>
		</tr>
		<tr>
		<th>Tiêu đề :</th><td>'.$_POST['title'].'</td>
		</tr>
		<tr>
		<th>Họ tên :</th><td>'.$_POST['name'].'</td>
		</tr>
		<tr>
		<th>Điện thoại :</th><td>'.$_POST['phone'].'</td>
		</tr>
		<tr>
		<th>Email :</th><td>'.$_POST['email'].'</td>
		</tr>
		<tr>
		<th>Địa chỉ :</th><td>'.$_POST['address'].'</td>
		</tr>
		<tr>
		<th>Nội dung :</th><td>'.$_POST['content'].'</td>
		</tr>';
		$body .= '</table>';

		$data['title'] = $_POST['title'];
		$data['name'] = $_POST['name'];
		$data['phone'] = $_POST['phone'];
		$data['email'] = $_POST['email'];
		$data['address'] = $_POST['address'];
		$data['content'] = $_POST['content'];
		$data['type'] = 'contact';
		$data['number'] = 1;
		$data['view'] = 0;
		$data['datecreate'] = date('Y-m-d H:i:s');
		$db->setTable("contact");
		$db->insert($data);
		$mail->Body = $body;

		if($mail->Send()){	
			$func->transfer("Thông tin liên hệ được gửi . Cảm ơn.", "./" );
		} else {
			$func->transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", _BASEURL_."lien-he/",false);
		}
	}
