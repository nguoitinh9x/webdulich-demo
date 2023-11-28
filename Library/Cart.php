<?php
	namespace Library;
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
class Cart { 

	public $lang;

	public function __construct($db,$func,$lang)
    {  
    	$this->db = $db;
    	$this->func = $func;
    	$this->lang = $lang;
    }

	public function get_product_info($pid){
		$this->db->bindMore(array("id"=>$pid));
    	$row = $this->db->row("select * from #_product where id=:id");
		return $row;
	}
	
	public function get_price($pid){
		$this->db->bindMore(array("id"=>$pid));
    	$row  =  $this->db->row("select price from table_product where id=:id");
		return $row['price'];
	}
	function get_weight($pid){
		$this->db->bindMore(array("id"=>$pid));
    	$row  =  $this->db->row("select mass from table_product where id=:id");
		return $row['mass'];
	}
	public function getsize($pid){
		$this->db->bindMore(array("id"=>$pid));
    	$row  =  $this->db->row("select name_".$this->lang." from table_title where id=:id");
		return $row['name_'.$this->lang];
	}

	public function getmausac($pid){
		$this->db->bindMore(array("id"=>$pid));
    	$row  =  $this->db->row("select name_".$this->lang.",id,attributes from table_title where id=:id ");
    	$attr = json_decode($row['attributes'],'true');
		return "<button class='mausac' style='background:".$attr['color']."' rel='".$row['id']."'>".$row['name_'.$this->lang]."</button>";
	}
		
	public function get_thumb($pid){
		$this->db->bindMore(array("id"=>$pid));
    	$row  =  $this->db->row("select thumb from table_product where id=:id");
		return $row['thumb'];
	}
	public function remove_product($pid,$size,$mausac){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid'] && $size==$_SESSION['cart'][$i]['size'] && $mausac==$_SESSION['cart'][$i]['mausac']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	public function remove_pro_thanh($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
		redirect('thanh-toan.html');
	}
	public function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=$this->get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	public function addtocart($pid,$q,$size='',$mausac=''){
		if($pid<1 or $q<1) return;
		
		if(is_array($_SESSION['cart'])){
			if(self::product_exists($pid,$q,$size,$mausac)) return 0;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['size']=$size;
			$_SESSION['cart'][$max]['mausac']=$mausac;
			return count($_SESSION['cart']);
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['size']=$size;
			$_SESSION['cart'][0]['mausac']=$mausac;
			return count($_SESSION['cart']);	
		}
	}
	static public function product_exists($pid,$q,$size,$mausac){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid'] && $size==$_SESSION['cart'][$i]['size'] && $mausac==$_SESSION['cart'][$i]['mausac']){
				$_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty'] + $q;
				$flag=1;
				break;
			}
		}
		return $flag;
	}
}
?>