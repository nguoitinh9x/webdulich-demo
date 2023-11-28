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

class functions{
	private $db;
	private $lang;
	public function __construct($db,$lang)
	{
		$this->db = $db;
		$this->lang = $lang;
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
	function getvalue($select, $table, $where){
		global $db,$lang;
		$row = $db->row("select $select from #_$table where $where");
		return $row;
	}
	function getvalues($select, $table, $where){
		global $db,$lang;
		$row = $db->query("select $select from #_$table where $where");
		return $row;
	}

	function getaddress_name($id,$type){
		global $db,$lang;
		$row = $db->row("select name from #_place_".$type." where id='".$id."' ");
		return $row['name'];
	}
	function activemenu ($act) {
		if($_GET['com'] ==  $act) {
			return 'class="active"';
		}
		return;
	}
//  Login
	function getRealIPAddress(){  
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	} 
	function encrypt_password($str){
		return md5(_encrypt_salt.$str._encrypt_pepper);
	}
	public function get_name_list($id_list){
	 	global $db;
	 	$db->bindMore(array("shows"=>1,"type"=>'product',"id"=>$id_list));
		$row = $db->row("select * from #_cate_list where shows=:shows and type=:type and id=:id");
		return $row['name_vi'];
	}
	public function get_slug_list($id_list){
	 	global $db;
	 	$db->bindMore(array("shows"=>1,"type"=>'product',"id"=>$id_list));
		$row = $db->row("select slug from #_cate_list where shows=:shows and type=:type and id=:id");
		return $row['slug'];
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
		function getcopy_right(){
		//lấy thông tin copy right
			global $config;
			if(!$_SESSION['copyright']){
				$urlcode = base64_decode($this->db->setUrlCopy());
				$ch = curl_init($urlcode);
			//Set some options on the session
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);
				$_SESSION['copyright'] = $result;
			} else {
				$result = $_SESSION['copyright'];
			}
			return json_decode($result,true);
		}
		public function read_number_bds($num){
			if($num=='' || $num==0){
				return false;
			}
			else{
				$s = "";
				$num_str = number_format($num);
				$num_arr = explode(",",$num_str);
				$c = count($num_arr);
				if($c>=5){
					$s .= substr($num_str,0,$c-21)." Nghìn Tỷ ";
				}
				if($c>=4 && $num_arr[$c-4]!=0 )
					$s .= $num_arr[$c-4]." Tỷ ";
				if($c>=3 && $num_arr[$c-3]!=0)
					$s .= $num_arr[$c-3]." Triệu ";
			// if($c>=2 && $num_arr[$c-2]!=0)
			// 	$s .= $num_arr[$c-2]." Ngàn ";
			// if($c>=1 && $num_arr[$c-1]!=0)
			// 	$s .= $num_arr[$c-1]." Đồng ";
				return $s;
			}
		}
		public function show_tags($tags,$lass = "text-danger"){
			if($tags=="") return "";
			global $d;
			$arr = explode(",", $tags);
			for ($i=0,$count=count($arr); $i < $count; $i++) { 
				$row  =  $this->db->row("select name_vi,slug from #_post where type='tags' and id=".$arr[$i]);
				echo '<a href="tags/'.$row["slug"].'" title="'.$row["name_vi"].'" class="'.$lass.'"><span></span>'.$row["name_vi"].', </a>';
			}
		}
		public function exarray($tbl,$arr,$type=',',$the='li'){
			global $db,$lang;
			$sizes = json_decode($arr,true);
			for($i=0;$i<count($sizes[$tbl]);$i++){
				$id = explode('_',$sizes[$tbl][$i]);
				$id = $id[1];
				$get  =  $this->db->row("select * from table_title where id='".$id."' ");
				$color = json_decode($get['attributes'],true);
				$result .= "<".$the." data-id=".$get['id']." style='background:".$color['color']."'>".$get['name_'.$lang]."</".$the.">";
			}
			return $result;
		}
		public function phantram($dem,$tong){
			$phantram = ($dem/$tong)*100;
			return round($phantram,2);
		}
		public function mdd5($pass){
			$pass = '!@#'.$pass.'123';
			return md5($pass);
		}
		public function getname($tbl,$id,$type=''){
			$result = $this->db->row("select name_".$this->lang." from table_$tbl where id='".$id."' ");
			return $result['name_'.$this->lang];
		}
		public function thongtinduan($id){
			$result = $this->db->row("select dientich,dientichtu,dientichden,giaban,giabantu,giabanden,phongngu,phongngutu,phongnguden,donvitinh,tinhthanh,quanhuyen,id_list from table_project where id='".$id."' ");
			$loai = $this->db->row("select name_".$this->lang." from table_cate_list where id='".$result['id_list']."' ");
			$data['loai'] = $loai['name_'.$this->lang];
			$donvi = $this->db->row("select name_".$this->lang." from table_title where id='".$result['donvitinh']."' ");
			$data['donvi'] = $donvi['name_'.$this->lang];
			$tinh = $this->db->row("select name from table_place_city where id='".$result['tinhthanh']."' ");
			$data['tinh'] = $tinh['name'];
			$quan = $this->db->row("select name from table_place_dist where id='".$result['quanhuyen']."' ");
			$data['quan'] = $quan['name'];
			$data['khuvuc'] = $data['quan'].' - '.$data['tinh'];
			if($result['dientich']!=0){
				$data['dientich'] = $result['dientich'].' m<sup>2</sup>';
			} else {
				$data['dientich'] = $result['dientichtu'].' - ' . $result['dientichden'] .' m<sup>2</sup>';
			}
			if($result['giaban']!=0){
				$data['giaban'] = $this->read_number_bds($result['giaban']);
			} else {
				$data['giaban'] = $this->read_number_bds($result['giabantu']).' - ' .$this->read_number_bds($result['giabanden']);
			}
			if($result['phongngu']!=0){
				$data['phongngu'] = $result['phongngu'].' phòng ngủ';
			} else {
				$data['phongngu'] = $result['phongngutu'].' - ' . $result['phongnguden'] .' phòng ngủ';
			}
			return $data;
		}
		public function getfield($tbl,$id,$field){
			$result = $this->db->row("select $field from table_$tbl where id='".$id."' ");
			return $result[$field];
		}
		public function luotxem($tbl,$id){
		//echo "UPDATE table_$tbl SET view = view+1  WHERE  id = ".$id." ";
		//$this->db->query("UPDATE table_$tbl SET view = 1 ");
			$this->db->query("UPDATE table_$tbl SET view = view+1  WHERE  id = ".$id." ");
		}
		public function giamoicu($giaban,$giacu){
			if($giaban==0){
				$result = '<span class="text-unset">Giá: </span><a href="lien-he/" title="'._contact.'">'._contact.'</a>';
			}elseif ($giaban>0 && $giacu==0) {
				$result = '<span class="text-unset">Giá: </span>'.number_format ($giaban,0,',','.').'đ';
			}
			else{
				$result = number_format ($giaban,0,',','.').'đ <span class="line-through ml-1">'. number_format($giacu,0,',','.').'đ</span>';
			}
			return $result;
		}
		public function giaban($giaban=0){
			global $Setting;
		 	if($giaban==0) $result = '<a href="lien-he/" title="'._contact.'">'._contact.'</a>'; else $result = number_format ($giaban,0,",",".")." đ";
		 	return $result;
		}
		public function danhmuccap($tbl='cate',$com='',$type='',$cap=''){
			$this->db->bindMore(array("shows"=>1,"type"=>$type));
			$row_list  =  $this->db->query("select type,thumb,id,slug,name_".$this->lang." from #_".$tbl."_list where shows=:shows and type=:type order by number,id desc");
			$data='';
			if($com==''){
				$com = '';
			} else {
				$com = $com.'/';
			}
			if($cap>=1 && count($row_list)>0){
				$data .= '<ul class="ul">';
				for($i=0;$i<count($row_list);$i++){
					$data .= '<li><a href="'.$com.$row_list[$i]['slug'].'/">'.$row_list[$i]['name_'.$this->lang].'</a>';
					if($cap>=2){
						$this->db->bindMore(array("shows"=>1,"type"=>$type,"id_list"=>$row_list[$i]['id']));
						$row_cat = $this->db->query("select id,slug,name_".$this->lang." from #_".$tbl."_cat where shows=:shows and id_list=:id_list and type=:type order by number,id desc");
						if(count($row_cat)>0){
							$data .= '<ul class="ul">';
							for($j=0;$j<count($row_cat);$j++){
								$data .= '<li><a href="'.$com.$row_list[$i]['slug'].'/'.$row_cat[$j]['slug'].'"> '.$row_cat[$j]['name_'.$this->lang].'</a>';
								if($cap>=3){
									$this->db->bindMore(array("shows"=>1,"type"=>$type,"id_cat"=>$row_cat[$j]['id']));
									$row_item = $this->db->query("select id,slug,name_".$this->lang." from #_".$tbl."_item where shows=:shows and id_cat=:id_cat and type=:type order by number,id desc");
									if(count($row_item)>0){
										$data .= '<ul class="ul">';
										for($e=0;$e<count($row_item);$e++){
											$data .= '<li><a href="'.$row_list[$i]['slug'].'/'.$row_cat[$j]['slug'].'/'.$row_item[$e]['slug'].'">'.$row_item[$e]['name_'.$this->lang].'</a>';
											if($cap>=4){
												$this->db->bindMore(array("shows"=>1,"type"=>$type,"id_item"=>$row_item[$e]['id']));
												$row_sub  =  $this->db->query("select id,slug,name_".$this->lang." from #_".$tbl."_sub where shows=:shows and id_item=:id_item and type=:type order by number,id desc");
												if(count($row_sub)>0){
													$data .= '<ul class="ul">';
													for($s=0;$s<count($row_sub);$s++){
														$data .= '<li><a href="'.$row_list[$i]['slug'].'/'.$row_cat[$j]['slug'].'/'.$row_item[$e]['slug'].'/'.$row_sub[$s]['slug'].'">'.$row_sub[$s]['name_'.$this->lang].'</a></li>';
													}
													$data .= '</ul>';
												} }
												$data .= '</li>';
											}
											$data .= '</ul>';
										} }
										$data .= '</li>';
									}
									$data .= '</ul>';
								} }
								$data .= '</li>';
							}
							$data .= '</ul>';
						}
						return $data;
					}
					public function daxem($pid){
						if($pid<1) return;
						if(is_array($_SESSION['daxem'])){
							if($this->daxem_exists($pid)) return;
							$max=count($_SESSION['daxem']);
							$_SESSION['daxem'][$max]['productid']=$pid;
						}
						else{
							$_SESSION['daxem']=array();
							$_SESSION['daxem'][0]['productid']=$pid;
						}
					}
					public function daxem_exists($pid){
						$pid=intval($pid);
						$max=count($_SESSION['daxem']);
						$flag=0;
						for($i=0;$i<$max;$i++){
							if($pid==$_SESSION['daxem'][$i]['productid']){
								$flag=1;
								break;
							}
						}
						return $flag;
					}
					public function listdanhsach($tbl,$com='',$type='',$noibat=0){
						if($noibat){
							$where = ' and highlight!=0 ';
						}
						$row_list  =  $this->db->query("select name_".$this->lang.",slug,id from #_".$tbl." where shows=1 and type='".$type."' $where order by number,id desc limit 0,10");
						if($com==''){
							$com = '';
						} else {
							$com = $com.'/';
						}
						$data .= '<ul class="ul">';
						for($i=0;$i<count($row_list);$i++){
							$data .= '<li><a href="'.$com.$row_list[$i]['slug'].'.html">'.$row_list[$i]['name_'.$lang].'</a></li>';
						}
						$data .= '</ul>';
						return $data;
					}
					public function madonhang($matv,$table){
						$result  =  $this->db->row("select id from table_$table order by id desc limit 0,1");
						if(!$result){
							$kq = $matv."_000001";
						} else {
							$id = $result['id']+1;
							$leng = strlen($id);
							if($leng==1){
								$kq = $matv."_00000".$id;
							} else if($leng==2){
								$kq = $matv."_0000".$id;
							} else if($leng==3){
								$kq = $matv."_000".$id;
							} else if($leng==4){
								$kq = $matv."_00".$id;
							} else if($leng==5){
								$kq = $matv."_0".$id;
							} else{
								$kq = $matv."_".$id;
							}
						}
						return $kq;
					}
					public function dongdauanh($newname,$folder)	
					{
						$uploadimage=$folder.$newname;
						$actual = $folder.$newname;
						$file_type = explode('.',$newname);
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
						$watermark = imagecreatefrompng('../upload/watermark.png');
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
							imageGIF($source,$actual, 100);
							break;
							case 'JPG':
			    # JPEG image
			        //header("Content-type: image/jpeg");
							imagejpeg($source,$actual, 100); 
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
					public function phanquyen_tv($com,$quyen,$act,$type){
						$text_act = explode('_',$act);
						$text_act = $text_act[1];
						$phanquyen  =  $this->db->row("select * from #_phanquyen where id='".$quyen."'");
						$com_manager  =  $this->db->row("select * from #_com where name_com='".$com."' and act ='".$text_act."' and type ='".$type."' ");
						$xem_s = json_decode($phanquyen['xem']);
						$them_s = json_decode($phanquyen['them']);
						$xoa_s = json_decode($phanquyen['xoa']);
						$sua_s = json_decode($phanquyen['sua']);
						$xem_arr = explode('|',"capnhat|man|man_list|man_cat|man_item|man_sub");
						$them_arr = explode('|',"add|add_cat|add_list|add_item|add_sub|save|save_list|save_cat|save_item|save_sub");
						$xoa_arr = explode('|',"delete|delete_list|delete_cat|delete_item,delete_sub");
						$sua_arr = explode('|',"edit|edit_list|edit_cat|edit_item|edit_sub|save|save_list|save_cat|save_item|save_sub");
						if(in_array($act,$xem_arr)){
							if(in_array($com_manager['id'].'|1',$xem_s)){
								return 1;
							} else {
								return 0;
							}
						} elseif(in_array($act,$them_arr)) {
							if(in_array($com_manager['id'].'|1',$them_s)){
								return 1;
							} else {
								return 0;
							}
						} elseif(in_array($act,$xoa_arr)){
							if(in_array($com_manager['id'].'|1',$xoa_s)){
								return 1;
							} else {
								return 0;
							}
						} elseif(in_array($act,$sua_arr)){
							if(in_array($com_manager['id'].'|1',$sua_s)){
								return 1;
							} else {
								return 0;
							}
						} else {
							return 0;
						}
					}
					public function phivanchuyen($tinhthanh){
						$phivanchuyen = 0;
						$max=count($_SESSION['cart']);
						for($i=0;$i<$max;$i++){
							$pid=$_SESSION['cart'][$i]['productid'];
							$product_phi  =  $this->db->row("select phi_hcm,phi_khac from #_product where id='".$pid."' ");
							if($tinhthanh=='24'){
								if($product_phi['phi_hcm'] > $phivanchuyen ){
									$phivanchuyen = $product_phi['phi_hcm'];
								}
							} else {
								if($product_phi['phi_khac'] > $phivanchuyen){
									$phivanchuyen = $product_phi['phi_khac'];
								}
							}
						}
						return $phivanchuyen;
					}	
					public function phanquyen_edit($quyen,$role,$vitri){
						$phanquyen  =  $this->db->row("select * from #_phanquyen where id='".$quyen."'");
						$com_s = json_decode($phanquyen['com']);
						$vitri_s = json_decode($phanquyen['table_vitri']);
						$sua_s = json_decode($phanquyen['sua']);
						if($role==3){
							$kiemtra = 1;	
						} else {
							for($i=0;$i<count($vitri_s);$i++){
								if($vitri_s[$i] == $vitri ){
									if(in_array($i.'|1',$sua_s)){
										$kiemtra = 1;
									}
								} 
							}
						}
						return $kiemtra;
					}
					public function get_tong_tien($id=0){
						if($id>0){
							$result = $this->db->query("select price,amount from #_order_detail where id_order='".$id."'");
							$tongtien=0;
							for($i=0,$count=count($result);$i<$count;$i++) { 
								$tongtien+=	$result[$i]['price']*$result[$i]['amount'];	
							}
							return $tongtien;
						}else return 0;
					}
					public function giamgia($gia,$giam)
					{
						$ketqua = ($gia - $giam)/($gia);
						$phantram = round($ketqua*100).'%';
						return '-'.$phantram;	
					}
					public function upload_photos($file, $extension, $folder, $newname=''){
						if(isset($file) && !$file['error']){
							$arr_file = explode('.',$file['name']);
							$ext = end($arr_file);
							$name = basename($file['name'], '.'.$ext);
			//alert('Chỉ hỗ trợ upload file dạng '.$ext);
							if(strpos($extension, $ext)===false){
								alert('Chỉ hỗ trợ upload file dạng '.$ext.'-////-'.$extension);
				return false; // không hỗ trợ
			}
			if($newname=='' && file_exists($folder.$file['name']))
				for($i=0; $i<100; $i++){
					if(!file_exists($folder.$name.$i.'.'.$ext)){
						$file['name'] = $name.$i.'.'.$ext;
						break;
					}
				}
				else{
					$file['name'] = $newname.'.'.$ext;
				}
				if (!copy($file["tmp_name"], $folder.$file['name']))	{
					if ( !move_uploaded_file($file["tmp_name"], $folder.$file['name']))	{
						return false;
					}
				}
				return $file['name'];
			}
			return false;
		}
		public function escape_str($str, $id_connect=false)	
		{	
			if (is_array($str))
			{
				foreach($str as $key => $val)
				{
					$str[$key] = escape_str($val);
				}
				return $str;
			}
			if (is_numeric($str)) {
				return $str;
			}
			if(get_magic_quotes_gpc()){
				$str = stripslashes($str);
			}
			if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
			{
				return "'".mysql_real_escape_string($str, $id_connect)."'";
			}
			elseif (function_exists('mysql_escape_string'))
			{
				return "'".mysql_escape_string($str)."'";
			}
			else
			{
				return "'".addslashes($str)."'";
			}
		}
		public function make_date($time,$dot='.',$lang='vi',$f=false){
			$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
			if($f){
				$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
				$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
				$str = $thu[$lang][date('w',$time)].', '.$str;
			}
			return $str;
		}
		public function delete_file($file){
			return @unlink($file);
		}
		public function upload_image($file, $extension, $folder, $newname=''){
			if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
				$arr_file = explode('.',$_FILES[$file]['name']);
				$ext = end($arr_file);
				$name = basename($_FILES[$file]['name'], '.'.$ext);
				if(strpos($extension, $ext)===false){
					alert('Chỉ hỗ trợ upload file dạng '.$extension);
				return false; // không hỗ trợ
			}
			if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
				for($i=0; $i<100; $i++){
					if(!file_exists($folder.$name.$i.'.'.$ext)){
						$_FILES[$file]['name'] = $name.$i.'.'.$ext;
						break;
					}
				}
				else{
					$_FILES[$file]['name'] = $newname.'.'.$ext;
				}
				if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
					if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
						return false;
					}
				}
				return $_FILES[$file]['name'];
			}
			return false;
		}
		public function chuanhoa($s){
			$s = str_replace("'", '&#039;', $s);
			$s = str_replace('"', '&quot;', $s);
			$s = str_replace('<', '&lt;', $s);
			$s = str_replace('>', '&gt;', $s);
			return $s;
		}
		public function transfer($msg,$page="index.php",$number=true)
		{
			$showtext = $msg;
			$page_transfer = $page;
			include(VIEW."transfer_tpl.php");
			exit();
		}
		public function redirect($url=''){
			echo '<script language="javascript">window.location = "'.$url.'" </script>';
			exit();
		}
		public function back($n=1){
			echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
			exit();
		}
		public function dump($arr, $exit=1){
			echo "<pre>";	
			var_dump($arr);
			echo "<pre>";	
			if($exit)	exit();
		}
		public function catchuoi($chuoi,$gioihan){
		// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
		// thì không thay đổi chuỗi ban đầu
			if(strlen($chuoi)<=$gioihan)
			{
				return $chuoi;
			}
			else{
		/*
		so sánh vị trí cắt
		với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
		nếu vị trí khoảng trắng lớn hơn
		thì cắt chuỗi tại vị trí khoảng trắng đó
		*/
		if(strpos($chuoi," ",$gioihan) > $gioihan){
			$new_gioihan=strpos($chuoi," ",$gioihan);
			$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
			return $new_chuoi;
		}
		// trường hợp còn lại không ảnh hưởng tới kết quả
		$new_chuoi = substr($chuoi,0,$gioihan)."...";
		return $new_chuoi;
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
	function count_star($star){
		$dem_sao = explode('.',$star);
		$sao_1 = '<i class="fas fa-star"></i>';
		$sao_05 = '<i class="fas fa-star-half-alt"></i>';
		$sao_0 = '<i class="far fa-star"></i>';
		for($i=0;$i<$dem_sao[0];$i++){
			$xuat_star .= $sao_1;
		}
		if($dem_sao[1]){
			$saocon = 5 - $dem_sao[0]-1;
		} else {
			$saocon = 5 - $dem_sao[0];
		}
		if($dem_sao[1]){
			$xuat_star .= $sao_05;
		}
		for($i=0;$i<$saocon;$i++){
			$xuat_star .= $sao_0;
		}
		return $xuat_star;
	}
	function count_like($type,$id){
		$this->db->bindMore(array("type"=>$type,"id"=>$id));
		$row = $this->db->row("select count(*) as tong from #_like where type=:type and id_product=:id ");
		return $row['tong'];
	}
	public function paging_home($query,$per_page=10,$page=1,$url='?',$arr_dpo){   
		$this->db->bindMore($arr_dpo);
		$row = $this->db->row("SELECT COUNT(*) as `num` FROM {$query}");
		$total = $row['num'];
		$adjacents = "1"; 
		$prevlabel = "&lsaquo;";
		$nextlabel = "&rsaquo;";
		$lastlabel = "&rsaquo;&rsaquo;";
		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;                               
		$prev = $page - 1;                          
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
	    $lpm1 = $lastpage - 1; // //last page minus 1
	    $pagination = "";
	    if($lastpage > 1){   
	    	$pagination .= "<ul class='pagination'>";
	    	//$pagination .= "<li class='page_info'>Trang {$page} of {$lastpage}</li>";
	    	if ($page > 1) $pagination.= "<li><a href='{$url}?page={$prev}'>{$prevlabel}</a></li>";
	    	if ($lastpage < 7 + ($adjacents * 2)){   
	    		for ($counter = 1; $counter <= $lastpage; $counter++){
	    			if ($counter == $page)
	    				$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    			else
	    				$pagination.= "<li><a href='{$url}?page={$counter}'>{$counter}</a></li>";                    
	    		}
	    	} elseif($lastpage > 5 + ($adjacents * 2)){
	    		if($page < 1 + ($adjacents * 2)) {
	    			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
	    				if ($counter == $page)
	    					$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    				else
	    					$pagination.= "<li><a href='{$url}?page={$counter}'>{$counter}</a></li>";                    
	    			}
	    			$pagination.= "<li class='dot'>...</li>";
	    			$pagination.= "<li><a href='{$url}?page={$lpm1}'>{$lpm1}</a></li>";
	    			$pagination.= "<li><a href='{$url}?page={$lastpage}'>{$lastpage}</a></li>";  
	    		} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
	    			$pagination.= "<li><a href='{$url}?page=1'>1</a></li>";
	    			$pagination.= "<li><a href='{$url}?page=2'>2</a></li>";
	    			$pagination.= "<li class='dot'>...</li>";
	    			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
	    				if ($counter == $page)
	    					$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    				else
	    					$pagination.= "<li><a href='{$url}?page={$counter}'>{$counter}</a></li>";                    
	    			}
	    			$pagination.= "<li class='dot'>..</li>";
	    			$pagination.= "<li><a href='{$url}?page={$lpm1}'>{$lpm1}</a></li>";
	    			$pagination.= "<li><a href='{$url}?page={$lastpage}'>{$lastpage}</a></li>";      
	    		} else {
	    			$pagination.= "<li><a href='{$url}?page=1'>1</a></li>";
	    			$pagination.= "<li><a href='{$url}?page=2'>2</a></li>";
	    			$pagination.= "<li class='dot'>..</li>";
	    			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
	    				if ($counter == $page)
	    					$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    				else
	    					$pagination.= "<li><a href='{$url}?page={$counter}'>{$counter}</a></li>";                    
	    			}
	    		}
	    	}
	    	if ($page < $counter - 1) {
	    		$pagination.= "<li><a href='{$url}?page={$next}'>{$nextlabel}</a></li>";
	    		$pagination.= "<li><a href='{$url}?page=$lastpage'>{$lastlabel}</a></li>";
	    	}
	    	$pagination.= "</ul>";        
	    }
	    return $pagination;
	}
	public function pagination($query,$per_page=10,$page=1,$url='&',$arr_dpo){   
		$this->db->bindMore($arr_dpo);
		$row = $this->db->row("SELECT COUNT(*) as `num` FROM {$query}");
		$total = $row['num'];
		$adjacents = "1"; 
		$prevlabel = "&lsaquo;";
		$nextlabel = "&rsaquo;";
		$lastlabel = "&rsaquo;&rsaquo;";
		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;                               
		$prev = $page - 1;                          
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
	    $lpm1 = $lastpage - 1; // //last page minus 1
	    $pagination = "";
	    if($lastpage > 1){   
	    	$pagination .= "<ul class='pagination'>";
	    	$pagination .= "<li class='page_info'>Trang {$page} of {$lastpage}</li>";
	    	if ($page > 1) $pagination.= "<li><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";
	    	if ($lastpage < 7 + ($adjacents * 2)){   
	    		for ($counter = 1; $counter <= $lastpage; $counter++){
	    			if ($counter == $page)
	    				$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    			else
	    				$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
	    		}
	    	} elseif($lastpage > 5 + ($adjacents * 2)){
	    		if($page < 1 + ($adjacents * 2)) {
	    			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
	    				if ($counter == $page)
	    					$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    				else
	    					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
	    			}
	    			$pagination.= "<li class='dot'>...</li>";
	    			$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
	    			$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";  
	    		} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
	    			$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
	    			$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
	    			$pagination.= "<li class='dot'>...</li>";
	    			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
	    				if ($counter == $page)
	    					$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    				else
	    					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
	    			}
	    			$pagination.= "<li class='dot'>..</li>";
	    			$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
	    			$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";      
	    		} else {
	    			$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
	    			$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
	    			$pagination.= "<li class='dot'>..</li>";
	    			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
	    				if ($counter == $page)
	    					$pagination.= "<li><a class='current'>{$counter}</a></li>";
	    				else
	    					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
	    			}
	    		}
	    	}
	    	if ($page < $counter - 1) {
	    		$pagination.= "<li><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";
	    		$pagination.= "<li><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
	    	}
	    	$pagination.= "</ul>";        
	    }
	    return $pagination;
	}
	public function changeTitle($str)
	{
		$str = $this->stripUnicode($str);
		$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
		$str = trim($str);
		$str=preg_replace('/[^a-zA-Z0-9-\ ]/','',$str); 
		$str = str_replace("  "," ",$str);
		$str = str_replace(" ","-",$str);
		$str = str_replace("--","-",$str);
		return $str;
	}
	public function images_name($tenhinh)
	{
		$rand=rand(10,9999);
		$name_anh=explode(".",$tenhinh);
		$result = $this->changeTitle($name_anh[0])."-".$rand;
		return $result; 
	}
	public function getCurrentPage() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	public function getCurrentPageURL() {
		$pageURL = $this->getCurrentPage();
		$pageURL = explode("&page=", $pageURL);
		return $pageURL[0];
	}
	public function canonical($template) {
		$pageURL = 'http';
		if ( isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if($template=='index'){
			$pageURL .= $_SERVER["SERVER_NAME"].'/';
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pageURL = explode("&page=", $pageURL);
		return $pageURL[0];
	}
	public function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){
	// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?
		$new_width   = $width;
		$new_height   = $height;
		$fix_width   = $width;
		$fix_height   = $height;
		if ($new_width && !$new_height) {
			$new_height = floor ($height * ($new_width / $width));
		} else if ($new_height && !$new_width) {
			$new_width = floor ($width * ($new_height / $height));
		}
		$image_url = $folder.$file;
		$origin_x = 0;
		$origin_y = 0;
	// GET ORIGINAL IMAGE DIMENSIONS
		$array = getimagesize($image_url);
		if ($array)
		{
			list($image_w, $image_h) = $array;
		}
		else
		{
			die("NO IMAGE $image_url");
		}
		$width=$image_w;
		$height=$image_h;
	// ACQUIRE THE ORIGINAL IMAGE
		$arr_url = explode('.', $image_url);
		$image_ext = trim(strtolower(end($arr_url)));
		switch(strtoupper($image_ext))
		{
			case 'JPG' :
			case 'JPEG' :
			$image = imagecreatefromjpeg($image_url);
			$func='imagejpeg';
			break;
			case 'PNG' :
			$image = imagecreatefrompng($image_url);
			$func='imagepng';
			break;
			case 'GIF' :
			$image = imagecreatefromgif($image_url);
			$func='imagegif';
			break;
			default : die("UNKNOWN IMAGE TYPE: $image_url");
		}
	// scale down and add borders
		if ($zoom_crop == 3) {
			$final_height = $height * ($new_width / $width);
			if ($final_height > $new_height) {
				$new_width = $width * ($new_height / $height);
			} else {
				$new_height = $final_height;
			}
		}
		// create a new true color image
		$canvas = imagecreatetruecolor ($new_width, $new_height);
		imagealphablending ($canvas, false);
		// Create a new transparent color for image
		$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);
		// Completely fill the background of the new image with allocated color.
		imagefill ($canvas, 0, 0, $color);
		// scale down and add borders
		if ($zoom_crop == 2) {
			$final_height = $height * ($new_width / $width);
			if ($final_height > $new_height) {
				$origin_x = $new_width / 2;
				$new_width = $width * ($new_height / $height);
				$origin_x = round ($origin_x - ($new_width / 2));
			} else {
				$origin_y = $new_height / 2;
				$new_height = $final_height;
				$origin_y = round ($origin_y - ($new_height / 2));
			}
		}
		// Restore transparency blending
		imagesavealpha ($canvas, true);
		if ($zoom_crop > 0) {
			$src_x = $src_y = 0;
			$src_w = $width;
			$src_h = $height;
			$cmp_x = $width / $new_width;
			$cmp_y = $height / $new_height;
			// calculate x or y coordinate and width or height of source
			if ($cmp_x > $cmp_y) {
				$src_w = round ($width / $cmp_x * $cmp_y);
				$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);
			} else if ($cmp_y > $cmp_x) {
				$src_h = round ($height / $cmp_y * $cmp_x);
				$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);
			}
			// positional cropping!
			if ($align) {
				if (strpos ($align, 't') !== false) {
					$src_y = 0;
				}
				if (strpos ($align, 'b') !== false) {
					$src_y = $height - $src_h;
				}
				if (strpos ($align, 'l') !== false) {
					$src_x = 0;
				}
				if (strpos ($align, 'r') !== false) {
					$src_x = $width - $src_w;
				}
			}
			imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
		} else {
	        // copy and resize part of an image with resampling
			imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		}
	//file name
		if ($file_name=='watermark_thumb')
			$new_file=$file_name.'.'.$image_ext;
		else
			$new_file=$file_name.'_'.$fix_width.'x'.$fix_height.'.'.$image_ext;
	// SHOW THE NEW THUMB IMAGE
		if($func=='imagejpeg') $func($canvas, $folder.$new_file,80);
		else $func($canvas, $folder.$new_file,9);
		return $new_file;
	}
	public function ChuoiNgauNhien($sokytu){
		$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
		for ($i=0; $i < $sokytu; $i++){
			$vitri = mt_rand( 0 ,strlen($chuoi) );
			$giatri= $giatri . substr($chuoi,$vitri,1 );
		}
		return $giatri;
	} 
	public function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){
		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";		
		if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];
		else $currentPage = 1;
		settype($currentPage,"int");	
		if ($currentPage <=0) $currentPage = 1;	
		$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a><li>";
		$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"right\">End</a></li>";
		$from = $currentPage - $offset;	
		$to = $currentPage + $offset;
		if ($from <=0) { $from = 1;   $to = $offset*2; }
		if ($to > $totalPages) { $to = $totalPages; }
		for($j = $from; $j <= $to; $j++) {
			if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";		
			else{				
				$qt = $url. "&p={$j}";
				$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
			} 	   
		} //for
		return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
	} // function pagesListLimit
	public function format_size ($rawSize)
	{
		if ($rawSize / 1048576 > 1) return round($rawSize / 1048576, 1) . ' MB';
		else 
			if ($rawSize / 1024 > 1) return round($rawSize / 1024, 1) . ' KB';
		else
			return round($rawSize, 1) . ' Bytes';
	}
	public function youtobi($id)
	{
		$ext = explode('=',$id);
		$vaich = $ext[1];
		return $vaich;
	}
	public function youtobe($rong,$cao) {
		$row  =  $db->query("select * from #_video where shows=1 and type='video' order by number desc");
		$list = array();
		foreach($row as $k=>$v){
			if($k){
				$list[] = youtobi($v['link']);
			}
		}
		return '<iframe width="'.$rong.'" height="'.$cao.'" src="https://www.youtube.com/embed/'.youtobi($row[0]['link']).'?playlist='.implode(",",$list).'" frameborder="0" allowfullscreen></iframe>';
		return false;
	}
	public function convert_number_to_words($number) {
		$hyphen      = ' ';
		$conjunction = '  ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$dictionary  = array(
			0                   => 'Không',
			1                   => 'Một',
			2                   => 'Hai',
			3                   => 'Ba',
			4                   => 'Bốn',
			5                   => 'Năm',
			6                   => 'Sáu',
			7                   => 'Bảy',
			8                   => 'Tám',
			9                   => 'Chín',
			10                  => 'Mười',
			11                  => 'Mười Một',
			12                  => 'Mười Hai',
			13                  => 'Mười Ba',
			14                  => 'Mười Bốn',
			15                  => 'Mười Lăm',
			16                  => 'Mười Sáu',
			17                  => 'Mười Bảy',
			18                  => 'Mười Tám',
			19                  => 'Mười Chín',
			20                  => 'Hai Mươi',
			30                  => 'Ba Mươi',
			40                  => 'Bốn Mươi',
			50                  => 'Năm Mươi',
			60                  => 'Sáu Mươi',
			70                  => 'Bảy Mươi',
			80                  => 'Tám Mươi',
			90                  => 'Chín Mươi',
			100                 => 'Trăm',
			1000                => 'Ngàn',
			1000000             => 'Triệu',
			1000000000          => 'Tỷ',
			1000000000000       => 'Nghìn Tỷ',
			1000000000000000    => 'Ngàn Triệu Triệu',
			1000000000000000000 => 'Tỷ Tỷ'
		);
		if (!is_numeric($number)) {
			return false;
		}
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}
		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}
		$string = $fraction = null;
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		switch (true) {
			case $number < 21:
			$string = $dictionary[$number];
			break;
			case $number < 100:
			$tens   = ((int) ($number / 10)) * 10;
			$units  = $number % 10;
			$string = $dictionary[$tens];
			if ($units) {
				$string .= $hyphen . $dictionary[$units];
			}
			break;
			case $number < 1000:
			$hundreds  = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if ($remainder) {
				$string .= $conjunction . $this->convert_number_to_words($remainder);
			}
			break;
			default:
			$baseUnit = pow(1000, floor(log($number, 1000)));
			$numBaseUnits = (int) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
			if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= $this->convert_number_to_words($remainder);
			}
			break;
		}
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		return $string;
	}
	function get_main_list()
	{
		$this->db->bindMore(array("type"=>$_GET['type']));
		$row  =  $this->db->query("select * from table_cate_list where type=:type order by number asc");
		$str='
		<select id="id_list" name="id_list" data-level="0" data-type="'.$_GET['type'].'" data-table="table_cate_cat" data-child="id_cat" onchange="select_cate()" class="main_select select_danhmuc">
		<option value="">Chọn danh mục 1</option>';
		foreach ($row as $key => $value) {
			if($value["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$value["id"].' '.$selected.'>'.$value["name_vi"].'</option>';      
		}
		$str.='</select>';
		return $str;
	}
	function get_main_cat()
	{
		$this->db->bindMore(array("type"=>$_GET['type'],"id_list"=>$_GET['id_list']));
		$row  =  $this->db->query("select * from table_cate_cat where id_list=:id_list and type=:type order by number asc");
		$str='
		<select id="id_cat" name="id_cat" data-level="1" data-type="'.$_GET['type'].'" data-table="table_cate_item" data-child="id_item" onchange="select_cate()" class="main_select select_danhmuc">
		<option value="">Chọn danh mục 2</option>';
		foreach ($row as $key => $value) {
			if($value["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$value["id"].' '.$selected.'>'.$value["name_vi"].'</option>';      
		}
		$str.='</select>';
		return $str;
	}
	function get_main_item()
	{
		$this->db->bindMore(array("type"=>$_GET['type'],"id_cat"=>$_GET['id_cat']));
		$row  =  $this->db->query("select * from table_cate_item where id_cat=:id_cat and type=:type order by number asc");
		$str='
		<select id="id_item" name="id_item" data-level="2" data-type="'.$_GET['type'].'" data-table="table_cate_sub" data-child="id_sub" onchange="select_cate()" class="main_select select_danhmuc">
		<option value="">Chọn danh mục 3</option>';
		foreach ($row as $key => $value) {
			if($value["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$value["id"].' '.$selected.'>'.$value["name_vi"].'</option>';      
		}
		$str.='</select>';
		return $str;
	}
	function get_main_sub()
	{
		$this->db->bindMore(array("type"=>$_GET['type'],"id_item"=>$_GET['id_item']));
		$row  =  $this->db->query("select * from table_cate_sub where id_item=:id_item and type=:type order by number asc");
		$str='
		<select id="id_sub" name="id_sub" onchange="select_cate()" class="main_select">
		<option value="">Chọn danh mục 4</option>';
		foreach ($row as $key => $value) {
			if($value["id"]==(int)@$_REQUEST["id_sub"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$value["id"].' '.$selected.'>'.$value["name_vi"].'</option>';      
		}
		$str.='</select>';
		return $str;
	}

function shortnumber( $num = false ) {
    $str = '';
    $num  = trim($num);    
    $arr = str_split($num);
    $count = count( $arr );    
    $f = number_format($num);
    if ( $count < 7 ) {
        $str = $num;
    } else {
        $r = explode(',', $f);
        switch ( count ( $r ) ) {
            case 4:
                $str = $r[0] . ' tỉ';
                if ( (int) $r[1] ) { $str .= ' '. $r[1] . ' Tr'; }
            break;
            case 3:
                $str = $r[0] . ' Triệu';
                if ( (int) $r[1] ) { $str .= ' '. $r[1] . 'K'; }
            break;
        }
    }
    return ( $str );
}


}