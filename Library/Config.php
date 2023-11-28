<?php 

	/**

	 * Application Main Page That Will Serve All Requests

	 *

	 * @package PRO CODE CIP Framework

	 * @author  code@cipmedia.vn

	 * @version 1.0.0

	 * @license http://cipmedia.vn

	 */



	$Scheme = !empty($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'https';

	defined( '_SITEURL_' ) ?:  define( '_SITEURL_', $Scheme.'://'.$_SERVER["SERVER_NAME"] ).':801/sharecode/happydaystour';

	defined( '_BASEURL_' ) ?:  define( '_BASEURL_', $Scheme.'://'.$_SERVER["SERVER_NAME"].':801/sharecode/happydaystour/' );



	error_reporting(E_ERROR | E_PARSE);//E_WARNING

	//error_reporting(E_ERROR | E_WARNING | E_PARSE);



//Email

	defined( 'C_EMAIL' ) ?:  define( 'C_EMAIL', 'no-reply@happydaystour.com' );

	defined( 'C_PASS' ) ?:  define( 'C_PASS', 'cipmedia' );

	defined( 'C_IP' ) ?:  define( 'C_IP', 'localhost' );



 //CK finder

	$_SESSION['BASE'] = _BASEURL_;

	$_SESSION['folder_ckfinder']  = _SITEURL_.'/Upload/';

	$_SESSION['ckfinder_license'] = 'demo0.thietkewebcip.com';

	$_SESSION['ckfinder_key']     = 'DW8WFGSM15LV82LVAE69YWBQNTPDJ';



// Config Database

	$config['servername'] = 'localhost';

	$config['username'] = 'root';

	$config['password'] = '';

	$config['database'] = 'sharecode_happydaystour';

	$config['refix'] = 'table_';



// Config site

	$config['debug']=0;

	$config['lang']=array("vi"=>"Tiếng việt");//,"en"=>"Tiếng anh"

	$config['activelang'] = 'vi';

	$config['ip'] = $_SERVER['REMOTE_ADDR'];

	$config['rating'] = true;



// CONFIG ENCRYPTION

	@define(_encrypt_salt, '@NUW215rt2@[e^');

	@define(_encrypt_pepper, '^B[4qrdf7*b#@');

	$config['login']['attempt'] = 3;

	$config['login']['delay'] = 3;





// CRSF CONFIG

	$strent= time();

	if(!isset($_SESSION['crsf_inc']) || isset($_SESSION['crsf_inc'])=='') $_SESSION['crsf_inc'] = sha1($strent);

	if(!isset($_SESSION['crsf_enc']) || isset($_SESSION['crsf_enc'])=='') $_SESSION['crsf_enc'] = md5(_encrypt_salt.sha1($strent)._encrypt_pepper);



// 

	$config['setup']['dongdau']['active'] = 'false';

	$config['setup']['dongdau']['loai'] = 'admin';

	$config['setup']['responsive'] = 'true';

	$config['setup']['mobile'] = 'false';

	$config['setup']['amp'] = 'false';

	$config['setup']['cart'] = 'false';



	@define ( _updating , "Đang cập nhật thông tin . . ." );

	

	@define ( _upload_download , '../Upload/download/' );

	@define ( _upload_download_l , 'Upload/download/' );



	@define ( _upload_project , '../Upload/project/' );

	@define ( _upload_project_l , 'Upload/project/' );

	

	@define ( _upload_hinhanh , '../Upload/hinhanh/' );

	@define ( _upload_hinhanh_l , 'Upload/hinhanh/' );

	

	@define ( _upload_product , '../Upload/product/' );

	@define ( _upload_product_l , 'Upload/product/' );

	

	@define ( _upload_post , '../Upload/post/' );

	@define ( _upload_post_l , 'Upload/post/' );



	@define ( _upload_album , '../Upload/album/' );

	@define ( _upload_album_l , 'Upload/album/' );



	@define ( _upload_cate , '../Upload/cate/' );

	@define ( _upload_cate_l , 'Upload/cate/' );



	@define ( _upload_video , '../Upload/video/' );

	@define ( _upload_video_l , 'Upload/video/' );

?>