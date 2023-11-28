<?php 
// echo 1111; die;
error_reporting(E_ALL);
if(! defined('FILE_CACHE_ENABLED') ) define ('FILE_CACHE_ENABLED', TRUE);
if(! defined('FILE_CACHE_DIRECTORY') ) define ('FILE_CACHE_DIRECTORY', 'Upload/thumbnails');
require 'composer/vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as Image;
/**
 * Author: Lam Anh Tran
 * Email: adm.trananh@gmail.com
 * Version: 1.0
 */

class myPhoto extends Image
{
	private $src;
	private $width;
	private $height;
	private $zc;
	private $quant;
	private $type;
	private $dong;
	function __construct($Request)
	{
		if (empty($Request['src'])) {echo 'Source: NULL'; die; } 
		if ($Request['h'] == 0 && $Request['w'] ==0) {echo 'Error: Do not request size value!'; die; } 
		$this -> src    = $Request['src'];
		$this -> width  = isset($Request['w']) && (empty($Request['w']) || $Request['w']<=0) ? null : $Request['w'];
		$this -> height = isset($Request['h']) && (empty($Request['h']) || $Request['h']<=0) ? null : $Request['h'];
		$this -> zc     = isset($Request['zc']) && (empty($Request['zc']) || $Request['zc']<0) ? 1 : $Request['zc'];
		$this -> quant  = isset($Request['q']) && (empty($Request['q']) || $Request['q']<0) ? 100 : $Request['q'];;
		$this -> type   = isset($Request['type']) && empty($Request['type']) ?  $this->getType() : $Request['type'];
		$this -> dong     = isset($Request['d']) && (empty($Request['d']) || $Request['d']<0) ? 0 : $Request['d'];
	}
	//SET VALUE FOR ODP
	public function setW($value){ $this->width  = $value; }
	public function setH($value){ $this->height = $value; }
	public function setZ($value){ $this->zc     = $value; }
	public function setQ($value){ $this->quant  = $value; }
	public function setD($value){ $this->dong  = $value; }
	public function setType($value){ $this->type   = $value; }
	public function setSrc($value){ $this->src   = $value; }
	//GET VALUE FOR ODP
	public function getSrc(){return $this->src; }
	// GET INFOMATION OF IMAGES ROOT
	public function getType(){
		$str = $this->src;
		$docType =  explode('.', $str);
		$docType =  end($docType);
		return $docType;
	}
	public function getWidth(){
		$src_temp = $this->src;
		return Image::make($src_temp)->width();
	}
	public function getHeight(){
		$src_temp = $this->src;
		return Image::make($src_temp)->height();
	}
	public function thumb_simple(){

		$new_w = $this->width;
		$new_h = $this->height;
		// echo '<pre>'; print_r($this->src); echo '</pre>'; die;
		$src_w = $this->getWidth();
		$src_h = $this->getHeight();
		$src_img = Image::make($this->src);

		$src_img->fit($new_w, $new_h, function ($constraint) {
			$constraint->upsize();
		});

		return $src_img;
	}
	public function thumb_ratio(){
		$new_w = $this->width;
		$new_h = $this->height;
		$src_w = $this->getWidth();
		$src_h = $this->getHeight();
		$src_img = Image::make($this->src);
		$src_img->resize($new_w, $new_h, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		});
		return $src_img;
	}
	public function thumb_bgratio(){
		$new_w = $this->width;
		$new_h = $this->height;
		$src_w = $this->getWidth();
		$src_h = $this->getHeight();
		$src_img = Image::make($this->src);
		$src_img->resize($new_w, $new_h, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		});
		$img_thumb = Image::canvas($new_w, $new_h, 'rgba(255,255,255,1)');
		$img_thumb->insert($src_img, 'center');
		return $img_thumb;
	}
	public function runimg($pathto){
		$type = $this->type;
		$quant = $this->quant;
		$zc = $this->zc;
		$dong = $this->dong;

		if ($zc==1) {$IMG = $this->thumb_simple(); }
		if ($zc==2) {$IMG = $this->thumb_bgratio(); }
		if ($zc==3) {$IMG = $this->thumb_ratio(); }

		if($dong == 1){
			$new_w = $this->width;
			$new_h = $this->height;

			$img_thumb = Image::make((__DIR__).'/Upload/watermark.png');

			$img_thumb->resize(round($new_w/2,0), round($new_h/2,0), function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
			$img_thumb->opacity(50);

			$IMG->insert($img_thumb, 'bottom-right', 5, 5);

			$IMG->response($type,$quant);
			$IMG->save($pathto);

		}else{
			$IMG->response($type,$quant);
			$IMG->save($pathto);
		}
		return $IMG;
	}
}
function SetNameImg($get){
	$name = 'w='.$get['w'].'h='.$get['h'].'q='.$get['q'].'zc='.$get['zc'].'type='.$get['type'].'src='.$get['src'];
	if (empty($get['type'])) {$get['type'] =  explode('.', $get['src']); $get['type'] =  end($get['type']); }
	$name = md5($name).'.'.$get['type'];
	return $name;
}
function CheckImg($pathto){
	if(file_exists($pathto)){
		return true;
	} else {
		return false;
	}
}
$NameImg = SetNameImg($_GET);
$pathto = FILE_CACHE_DIRECTORY.'/'.$NameImg;
if(CheckImg($pathto)){
	$handle = fopen($pathto, "rb");
	$contents = fread($handle, filesize($pathto));
	$docType =  explode('.', $pathto);
	$docType =  end($docType);
	fclose($handle);
	header("content-type: image/".$docType);
	echo $contents;
	echo $pathto;
	die;
} else {
	$img = new myPhoto($_GET);
	print($img->runimg($pathto));
	die;
}
/*
	thumb 1: Cut width - heigth in center
	thumb 2: cut width or cut height auto
	thumb 3: auto render width and height
*/
	?>