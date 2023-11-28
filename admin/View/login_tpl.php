<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<base href="<?=  _BASEURL_.'admin/' ?>">
	<meta name="csrf-token"content="<?=  $_SESSION['crsf_inc'] ?>">
	<link rel="shortcut icon"href="favicon.ico"type="image/x-icon">
	<link rel="icon"href="favicon.ico"type="image/x-icon">
	<title>ĐĂNG NHẬP HỆ THỐNG QUẢN TRỊ WEBSITE - CIP MEDIA,
	.JSC</title>
	<meta name="robots"content="noindex,nofollow"/>
	<meta name="google"content="notranslate"/>
	<meta name='revisit-after'content='1 days'/>
	<meta name="ICBM"content=" ">
	<!-- DNS Prefetch -->
	<meta http-equiv="x-dns-prefetch-control"content="on">
	<link rel="dns-prefetch"href="//www.google-analytics.com"/>
	<link rel="dns-prefetch"href="//cdnjs.cloudflare.com"/>
	<link rel="dns-prefetch"href="//maxcdn.bootstrapcdn.com"/>
	<link rel="dns-prefetch"href="//code.jquery.com"/>
	<link rel="dns-prefetch"href="//fonts.googleapis.com"/>
	<!-- DNS Prefetch -->
	<meta http-equiv="X-UA-Compatible"content="IE=edge"/>
	<meta name="viewport"content="width=device-width, initial-scale=1"/>
	<!-- CDN -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800&amp;subset=vietnamese"rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		body,
		html{font-size:14px;}
		body#loginsite{position:relative;max-width:100%;width:100%;overflow:hidden;background:url(Assets/images/vector.png);background-size:cover;}
		body#loginsite canvas{width:100%;height:100%;}
		body#loginsite header#header{position:absolute;top:0;left:0;width:100%;height:auto;background:#000;z-index:9999;}
		body#loginsite header#header .contents a{padding:.5em 1em;display:inline-block;background:#f15829;color:#fff;border-left:1px solid rgba(255,255,255,.25);border-right:1px solid rgba(255,255,255,.25);transition:all .5s;}
		body#loginsite header#header .contents a:hover{text-decoration:none;background: orange;}
		body#loginsite footer#footer{position:fixed;bottom:0;left:0;width:100%;height:auto;background:#000;padding:.75em 0;color:#fff;}
		section#section{position:relative;height:100vh;display:flex;align-items:center;}
		section#section .blocklogin{align-items:center;}
		section#section .blocklogin .blocklbl{font-family:Montserrat;text-align:center;}
		section#section .blocklogin .blocklbl .titles{white-space:nowrap;text-align:center;display:inline-block;}
		section#section .blocklogin .blocklbl .titles h2{font-weight:200;font-size:1.5em;padding:0;margin:0;line-height:1;color:#fff;margin-top:.5em;}
		section#section .blocklogin .blocklbl .titles h1{position:relative;color:#fff;font-weight:100;padding:0;margin:0;line-height:1;text-shadow:0 0 10px #f15829,0 0 20px #f15829,0 0 30px #f15829,0 0 40px #f15829,0 0 70px #f15829,0 0 80px #f15829,0 0 100px #f15829,0 0 150px #f15829;font-size:2.5em;margin-top:.75em;font-weight:700;}
		section#section .blocklogin #eyespassword{position:absolute;top:50%;right:15px;font-size:1.25em;-webkit-transform:translateY(-50%);transform:translateY(-50%);color:#ccc;transition:all .3s;cursor:pointer;}
		section#section .blocklogin #eyespassword:hover{color:#21112a;}
		.form-signin{width:100%;}
		.form-signin .btn{font-size:80%;border-radius:5rem;letter-spacing:.1rem;font-weight:700;padding:1rem;transition:all .2s;}
		.form-label-group{position:relative;margin-bottom:1rem;}
		.form-label-group input{height:auto;border-radius:2rem;}
		.form-label-group>input,
		.form-label-group>label{padding:var(--input-padding-y) var(--input-padding-x);}
		.form-label-group>label{position:absolute;top:0;left:0;display:block;width:100%;margin-bottom:0;line-height:1.5;color:#495057;border:1px solid transparent;border-radius:.25rem;transition:all .1s ease-in-out;}
		.form-label-group input::-webkit-input-placeholder{color:transparent;}
		.form-label-group input:-ms-input-placeholder{color:transparent;}
		.form-label-group input::-ms-input-placeholder{color:transparent;}
		.form-label-group input::placeholder{color:transparent;}
		.form-label-group input:not(:placeholder-shown){padding-top:calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));padding-bottom:calc(var(--input-padding-y)/ 3);}
		.form-label-group input:not(:placeholder-shown)~label{padding-top:calc(var(--input-padding-y)/ 3);padding-bottom:calc(var(--input-padding-y)/ 3);font-size:12px;color:#777;}
		.btn-google{color:#fff;background-color:#ea4335;}
		.btn-facebook{color:#fff;background-color:#3b5998;}
		#loginsite .blockform .contentblock{padding:2em;background:#b72200;border-radius:10px;box-shadow:2px 2px 10px #771700;text-align:center;}
		#loginsite .blockform .contentblock h2{color:#fff;font-size:1.5em;margin-bottom:1em;}
		#loginsite .blockform .contentblock .form-signin input{padding:.5em 1em;font-size:1.5em;padding-top:.85em;transition:all .25s;text-align:center;outline:0;border:1px solid #fff;font-weight:500;color:black;}
		#loginsite .blockform .contentblock .form-signin label{font-size:1.25em;height:100%;padding-top:.5em;pointer-events:none;}
		#loginsite .blockform .contentblock .form-signin button{font-size:1em;background:#252327;border:1px solid #252327;transition:all .5s;}
		#loginsite .blockform .contentblock .form-signin button:hover{background:#000;}
		#loginsite .blockform .contentblock .form-signin input:not(:placeholder-shown)~label{padding-top:0;font-size:.95em;transition:all .25s;}
		#loginsite .blockform .contentblock .form-signin input:focus~label{padding-top:0;font-size:.95em;transition:all .25s;}
		#loginsite .blockform .contentblock .notification{margin-top:1em;text-align:left;min-height:1em;color:#fff;text-align:center;}
		#loginsite .blockform .contentblock .notification span.warning{position:relative;padding-left:2em;color:#ffab0c;font-size:1.05em;}
		#loginsite .blockform .contentblock .notification span.error{position:relative;padding-left:2em;color:#f10000;font-size:1.05em;}
		#loginsite .blockform .contentblock .notification span.warning:before{    content: ''; position: absolute; top: -.25em; left: 0; width: 28px; height: 28px; background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAcCAMAAAA3HE0QAAACrFBMVEUAAADcAADiEADjJBXmWF3dAADfBADcAgDnPDTcEwDrVUfgFgDfGgDwWErpRDPeFwDgKRn0ZFnkWl7gJSffGBzpbmzqa1/nZmLpbmvaCADtdGftX1XveW/lRjbaGADdFQDuTUDnKxboJRDoOirwa1/mFgDpOSPkOB/paFjlEgDeDwDmRC/jSDXfGgbcFgDsaFrqSTr3ysPoaFjwDgD4vrb//wDkPgD//xv//xH//wz//xf//wbXAAAAAAD//2///zz//zT//ybaAAD//3z//1H//0n//0L//zD//yT//yH//5P//4n//4P//1///1r//zn//yz//yr//xPeGACDg5qQkIqBgYFycoHsdX3vhXl2dnX5v3JWVm3pYmxqamrvgmb//2X82GVdXV/oUVn//1XnVlD//0wsLEn//0XcBRX+/hL7/QLvjADqZQDmRQDhOgDiNgDhJwDdCwDBwZ7q7J20tJJ4eJDZ4o53d4374YuKiontg4jU1Ib1sYbyoIVjY4WSkn7qe373yny1u3pvb3n//3j98ndqanf//3ZbW3bzp3T63XOurnPte3JxcXHqbnHoZ3H1/232wGvwjmuNjWn192jPz2jlYGZISGaxsWBZWWDs7F74zF5HR1zR0VfmT1dublVBQVXvilRKSlRSUlH75U/ug0/iQk/w8E2QkErmTkj74Edvb0fhOkbxl0DkQkAjIz+8vD4ZGT6ZmTzfKjv//DrwjjcqKjTj4zMPDzPmSzLCwjHeHzH++y/zrCozMynlQigGBijr6ybcFCTzph5YWB0rKx3oWBz4yxTmSg7bCg3T0wbJyQX3xQTqbQP+8wD86gD86QD73gD50gC3wQD1twD1tgCoswCdnQCOkwDvkgBycgD/bABjaAD/ZgDnXQDtRgBFRQDoQQAcHABnqcrNAAAANXRSTlMAybId/PnY1sSomZGAdFZWDAb26efj4dfVxLuvrq6to5yQiIaDbWtkTUVCQD8wLCopHxkWChqtWckAAAHiSURBVCjPYkAFJlyyhgz4gFRqqpggHnm+5EmJycq45QVFI+3sJk83wKlAJaLJubW7XxqXvH5jnbe3j3PXBD4cCmSqK728vH3aesWxy2tE1HqVFJfWOEfH8mJVIBHpUx4SUlbfbBfPwoxFnjc22jm0IrQqvH1iIosCpryRULxdR0N4WFhL31TfRct1MBRwzZ+TYNfTGRUVM8XXb+kqDnR57bXLUnwTpsXExc2Y6efium6LGpoCjvWr01L8ZifNSpo7z8XVbesuYQEUecDU92yzz0hzcVmwcPGSFa5u9g77DisiywuIHNjrYO+W4boyPX2Nm72/Q6DH8UxdJAVKmUccA9wd/O03bti02d/BPdDD/MQpJoS8ntNJK3NPoBL3Hdt37g4IdPQ0D7I8Z8MPV8DkdNYyCKjEw9Fx/8FDHp7mVhaWpheC2WDy/Da5pqbWICXm5kePmVsBpa1NTU1v2fBAFbAFXwTygUosLCyysixA0mBQwAqJEh6bHFMosLY+fSbbFAau2XCC5JlZC0zh4Iat7W0E776TJlCBvM1VhNBDW9vHCN6lIkYGBi2nXFMEuGlrexeJm+OkysBZdNkUCVy5no3EO18oycAdnGcGB/mP7t15kI/g5xUCg5ObnREnYJczBgCa4KfqESMLUQAAAABJRU5ErkJggg=='); background-size: 100% 100%; background-repeat: no-repeat;} #loginsite .blockform .contentblock .notification span.error:before{content:'\f05e';font-family:'Font Awesome 5';font-weight:900;margin-right:.5em;position:absolute;top:-.25em;left:0;font-size:1.5em;}
		.boxrecapcha{display:inline-block;}
		@media (max-width:500px){
			section#section .blocklogin .blocklbl{display: none }
			.boxrecapcha{max-width: 100%}
			#loginsite .blockform .contentblock h2{font-size: 1em}
			#loginsite .blockform .contentblock{padding: 1em}
			.mbx{margin-bottom: 0}
		}
		@media (max-width:350px){
			#recaptcha{transform:scale(0.775);transform-origin:0 0;}
			section#section .blocklogin .blocklbl .titles h2{font-size: 1em }
			section#section .blocklogin .blocklbl .titles h1{font-size: 1.5em }
		}
	</style>
</head>
<body id="loginsite">
	<header id="header"class="clearfix">
		<div class="container pad0">
			<div class="text-right contents">
				<a href="../"><i class="fas fa-globe"></i> Về trang chính</a>
			</div>
		</div>
	</header>
	<section id='section'>
		<div class="container">
			<div class="blocklogin row clearfix">
				<div class="blocklbl col-lg-6 col-md-6 col-sm-12 mb-md-0 mb-4">
					<div class="titles">
						<?php /*?> <a href="https://cipmedia.vn"><img src="Assets/images/logo2.png"alt="logo"></a> <?php */?>
						<h1>ĐĂNG NHẬP</h1>
						<h2>HỆ THỐNG QUẢN TRỊ WEBSITE</h2>
					</div>
				</div>
				<div class="blockform col-lg-5 col-md-6 col-sm-12 ">
					<div class="contentblock clearfix"data-wow-duration="1s"data-wow-delay="0.5s"> 
						<h2>THÔNG TIN ĐĂNG NHẬP</h2>
						<form class="form-signin"action="index.php?com=user&act=login"id="validate"class="form"method="post">
							<div class="form-label-group">
								<input type="text"id="username"class="form-control"placeholder="Email address"required autocomplete="off">
								<label for="inputEmail">Username</label>
							</div>
							<div class="form-label-group">
								<input type="password"id="inputPassword"class="form-control"name="password"placeholder="Password"required autocomplete="off">
								<label for="inputPassword">Password</label>
								<span class="eyes"id="eyespassword"data-is="hind"><i class="fas fa-eye-slash"></i></span>
							</div>
							<?php /*?> <div class="form-label-group mbx fullscreen text-center">
								<div class="boxrecapcha"><div id="recaptcha"></div></div>
							</div> <?php */?>
							<button class="btn btn-lg btn-primary btn-block text-uppercase"type="submit"id="logMeIn">ĐĂNG NHẬP</button>
						</form>
						<div class="notification clearfix"id='loginError'>
						</div>
					</div>
				</div>
			</div>  
		</div>  
	</section>
	<footer id="footer"class="clearfix">
		<div class="container pad0">
			<div class="text-center contents">
				Copyright @ <?=  date('Y',time()) ?>. 
				<?php /*?> <a href="https://cipmedia.vn"target="_blank">CIP Media, .JSC</a> <?php */?>
			</div>
		</div>
	</footer>
</body>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-3.1.0.min.js"integrity="sha256-ycJeXbll9m7dHKeaPbXBkZH8BuP99SmPm/8q5O+SbBc="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit&hl=vi"defer></script>
<script>
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	$(document).ready(function() {
		$("#loginsite #eyespassword").click(function(a) {
			if ("hind" == $(this).attr("data-is")) {
				$(this).attr("data-is", "show");
				$(this).html('<i class="fas fa-eye"></i>'), $("#loginsite #inputPassword").attr("type", "text")
			} else {
				$(this).attr("data-is", "hind");
				$(this).html('<i class="fas fa-eye-slash"></i>'), $("#loginsite #inputPassword").attr("type", "password")
			}
		}), $(".forgot-pwd").click(function() {
			return $("#loginForm").hide(), $("#forgotForm").show(), !1
		}), $(".back-login").click(function() {
			return $("#loginForm").show(), $("#forgotForm").hide(), !1
		});
		var baseurl = "",
		recaptcha = jQuery("#g-recaptcha-response").val();
		jQuery("#logMeIn").click(function() {
			var email = jQuery("#username").val(),
			pass = jQuery("#inputPassword").val();
			recaptcha = jQuery("#g-recaptcha-response").val();
			return !email || !pass || (jQuery.ajax({
				type: "POST",
				url: baseurl + "ajax.php?do=admin&act=login",
				data: {
					pass: pass,
					email: email,
					recaptcha: recaptcha
				},
				success: function(data) {
					var myObject = eval("(" + data + ")");
					$(".ajaxloader").css("display", "none"), myObject.page ? window.location = myObject.page : myObject.mess && (jQuery("#loginError").css("display", "block"), jQuery("#loginError").html('<span class="warning">' + myObject.mess + "</span>"), grecaptcha.reset())
				}
			}), !1)
		})
	});
	if($('#recaptcha').length){
		var recaptcha;
		var myCallBack = function() {
			recaptcha = grecaptcha.render('recaptcha', {
          'sitekey' : '6LfzH3YUAAAAACpJhQk9MyMXyU7RUvLCpQ6RFtwB', //Replace this with your Site key
          'theme' : 'light',
          'callback': 'verifyCapt'  // optional
      });
		};
		var verifyCapt = function( response ) {
			console.log( 'g-recaptcha-response: ' + response );
		};
	}
</script>
</html>