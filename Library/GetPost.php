<?php
/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
namespace Library;
use \Library\App;
use Intervention\Image\ImageManagerStatic as Image;

class GetPost extends Image{
	private $db;
	private $lang;
	public function __construct($db,$lang)
	{
		$this->db = $db;
		$this->lang = $lang;
	}
	function curl_get_contents($url){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	function replacestr($text){
		$text = str_replace('','', $text);
		return $text;
	}
	public function changeImage($src,$name)
	{
		$str = $this->stripUnicode($name);
		$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
		$str = trim($str);
		$str = str_replace("  "," ",$str);
		$str = str_replace(" ","-",$str);
		$str = preg_replace('/[^A-Za-z0-9\-]/','', $str);
		$duoi = explode('.',$src);
		return $str.'.'.end($duoi);
	}
	function replacedes($text){
      /* 		$text = str_replace('Wiki Cách Làm', 'Wikici', $text);
		$text = str_replace('wiki cách làm', 'Wikici', $text);
		$text = str_replace('mẫu','kiễu', $text);
		$text = str_replace('Mẫu','Kiễu', $text);
		$text = str_replace('quan tâm','chú ý', $text);
		$text = str_replace('nhiều người','mọi người', $text);
		$text = str_replace('sở thích','xu hướng', $text);
		$text = str_replace('mũm mĩm','mập', $text);
		$text = str_replace('Tư vấn','Tham khảo', $text);
		$text = str_replace('tư vấn','tham khảo', $text);
		$text = str_replace('Những','Các', $text);
		$text = str_replace('những','các', $text);
		$text = str_replace('biến đổi','thay đổi', $text);
		$text = str_replace('hiện nay','ngày nay', $text);
		$text = str_replace('src=""','', $text);
		$text = str_replace('wikicachlam','wikici', $text);
		$text = str_replace('Wikicachlam','Wikici', $text);
		$text = str_replace('(adsbygoogle = window.adsbygoogle || []).push({});','', $text);  */
		return $text;
	}
	function replaceimg($text){
	 	//$text = $this->changeImage($text);
		return $text;
	}
	function strip_word_html($text,$name_odd,$setURL=null)
	{
		mb_regex_encoding('UTF-8');
		$allowable_atts = array('href','src','cellpadding','border','style','alt','title','data-layzr','id','name','class','controls','controlslist','poster');
		$search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
		$replace = array('\'', '\'', '"', '"', '-');
		$text = preg_replace($search, $replace, $text);
		$text = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $text);
		$text = str_replace('\'', '', $text);
		if(mb_stripos($text, '/*') !== FALSE){
			$text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
		}
		$allowed_tags = '<ul><li><b><i><sup><sub><em><u><br><br/><br /><p><h1><h2><h3><h4><h5><h6><table><tr><td><th><pre><figure><figcaption><img><hr><a><ol><div><span><b><strong><video>';
		$text = strip_tags($text,$allowed_tags);
		$text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
		$text = $this->stripAttributes($text,$allowable_atts);
		$text = $this->GetImageContent($text,$name_odd);
		$text = $this->replacedes($text);
		$text = str_replace('href="#', 'href="'.$setURL.'#', $text);
		return $text;
	}
	function stripAttributes($s, $allowedattr = array()) {
		if (preg_match_all("/<[^>]*\\s([^>]*)\\/*>/msiU", $s, $res, PREG_SET_ORDER)) {
			foreach ($res as $r) {
				$tag = $r[0];
				$attrs = array();
				preg_match_all("/\\s.*=(['\"]).*\\1/msiU", " " . $r[1], $split, PREG_SET_ORDER);
				foreach ($split as $spl) {
					$attrs[] = $spl[0];
				}
				$newattrs = array();
				foreach ($attrs as $a) {
					$tmp = explode("=", $a);
					if (trim($a) != "" && (!isset($tmp[1]) || (trim($tmp[0]) != "" && !in_array(strtolower(trim($tmp[0])), $allowedattr)))) {
					} else {
						$newattrs[] = $a;
					}
				}
				$attrs = implode(" ", $newattrs);
				$rpl = str_replace($r[1], $attrs, $tag);
				$s = str_replace($tag, $rpl, $s);
			}
		}
		return $s;
	}
	function grab_image($url,$saveto){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$raw=curl_exec($ch);
		curl_close ($ch);
		if(file_exists($saveto)){
			unlink($saveto);
		}
		$fp = fopen($saveto,'x');
		fwrite($fp, $raw);
		fclose($fp);
	}
	function GetImageContent($html,$name_old) {
		global $func;
		$text = explode('src="',$html);
		if(count($text)>1){
			$html = $text[0];
			for($i=1;$i<count($text);$i++){
				$src = explode('"',$text[$i]);
				$srcs = $src[0];
				$src = $src[0];
				$domain = explode('/', $src);
				$name = end($domain);
				$name = explode('?', $name);
				$name = $name[0];
				$new_name = $name;
				$new_d = explode('.', $new_name);
				$pathto = dirname(__DIR__).'/Upload/images/download/'.$new_name;
				$pathto_new = dirname(__DIR__).'/Upload/images/download/'.$this->changeTitle($name_old).'-'.$i.'.jpeg';
				$linkto = _BASEURL_.'Upload/images/download/'.$this->changeTitle($name_old).'-'.$i.'.jpeg';
				if($domain[2]!=$_SERVER["SERVER_NAME"]){
					$this->grab_image($src,$pathto);
					$html .= 'src="'.$linkto.str_replace($srcs,'',$text[$i]);
					$img = Image::make($pathto);
					$img->resize(800,600, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
			    	/*	
			    	$img_thumb = Image::canvas(500,500, 'rgba(255,255,255,1)');
					$img_thumb->insert($img, 'center');
					and insert a watermark for example
					finally we save the image as a new file
					$img_thumb->response('jpg',100);
					$img_thumb->save($pathto_new);
					$img_thumb = Image::make(dirname(ROOT).'/Upload/watermark.png');
					$img_thumb->opacity(50);
					$img->insert($img_thumb, 'bottom-right', 5, 5);
					*/
					$img->save($pathto_new);
					$func->delete_file($pathto);	
				} else {
					$html .= 'src="'.$text[$i];
				}
			}
		}
		return $html;
	}
	public function runimg($pathto){
		$type = $this->type;
		$quant = $this->quant;
		$zc = $this->zc;
		if ($zc==1) {$IMG = $this->thumb_simple(); }
		if ($zc==2) {$IMG = $this->thumb_bgratio(); }
		if ($zc==3) {$IMG = $this->thumb_ratio(); }
		$IMG->response($type,$quant);
		$IMG->save($pathto);
		return $IMG;
	}
	public function raw_json_encode($input, $flags = 0) {
		$fails = implode('|', array_filter(array(
			'\\\\',
			$flags & JSON_HEX_TAG ? 'u003[CE]' : '',
			$flags & JSON_HEX_AMP ? 'u0026' : '',
			$flags & JSON_HEX_APOS ? 'u0027' : '',
			$flags & JSON_HEX_QUOT ? 'u0022' : '',
		)));
		$pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
		$callback = function ($m) {
			return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
		};
		return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
	}
	function downloadFile ($url, $path) {
		$newfname = $path;
		$file = fopen ('https:'.$url, "rb");
		if ($file) {
			$newf = fopen ($newfname, "wb");
			if ($newf)
				while(!feof($file)) {
					fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
				}
			}
			if ($file) {
				fclose($file);
			}
			if ($newf) {
				fclose($newf);
			}
		}
		public function stripUnicode($str){
			if(!$str) return false;
			$unicode = array(
				'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
				'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
				'd'=>'đ',
				'D'=>'Đ',
				'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
				'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
				'i'=>'í|ì|ỉ|ĩ|ị',	  
				'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
				'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
				'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
				'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
				'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
				'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
				'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
			);
			foreach($unicode as $khongdau=>$codau) {
				$arr=explode("|",$codau);
				$str = str_replace($arr,$khongdau,$str);
			}
			return $str;
	}// Doi tu co dau => khong dau
	public function dongdauanh($src)	
	{
		$uploadimage=$src;
		$actual = $src;
		$file_type = explode('.',$src);
		  // Load the mian image
		switch(strtoupper($file_type[1])) {
			case 'GIF':
			       # GIF image
			$source = imageCreateFromGIF($uploadimage);
			break;
			case 'JPG':
			       # JPEG image
			$source = imagecreatefromjpeg($uploadimage);
			break;
			case 'PNG':
			       # PNG image
			$source = imageCreateFromPNG($uploadimage);
			break;
			default :
			       # JPEG image
			$source = imageCreateFromJPEG($uploadimage);
			break;
		}
		  // load the image you want to you want to be watermarked
		$watermark = imagecreatefrompng(dirname(ROOT).'/Upload/watermark.png');
		$size = getimagesize($uploadimage);  
		  // get the width and height of the watermark image
		$water_width = imagesx($watermark);
		$water_height = imagesy($watermark);
		  // get the width and height of the main image image
		$main_width = imagesx($source);
		$main_height = imagesy($source);
		  // Set the dimension of the area you want to place your watermark we use 0
		  // from x-axis and 0 from y-axis 
		$dime_x = ($size[0] - $water_width)/2;  
		$dime_y = ($size[1] - $water_height)/2;
		  // copy both the images
		imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);
		  // Final processing Creating The Image
		  //header('Content-type: image/png');
		switch(strtoupper($file_type[1])) {
			case 'GIF':
			    # GIF image
			        //header("Content-type: image/gif");
			imageGIF($source,$actual,70);
			break;
			case 'JPG':
			    # JPEG image
			        //header("Content-type: image/jpeg");
			imagejpeg($source,$actual,70); 
			break;
			case 'PNG':
			    # PNG image
			        // header("Content-type: image/png");
			        // imagePNG($source);
			imagePNG($source,$actual, 0, NULL);
			break;
		}
		imagesavealpha($source, true);
		   //imagepng($source, $actual, 100);
	}
	public function changeTitle($str)
	{
		$str = $this->stripUnicode($str);
		$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
		$str = trim($str);
		$str = preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
		$str = str_replace("  "," ",$str);
		$str = str_replace(" ","-",$str);
		return $str;
	}
}