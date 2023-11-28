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
	 
class Counter extends ClassPDO{

    public function __construct($db)
    {
    	$this->db = $db;
        $this->counter();
    }
    public function index(){
    	return "ah";
    }
    
	function counter(){	     
	    $locktime        =  15; 
	    $initialvalue    =    1; 
	    $records        =    1000000; 
	     
	    $s_today        =    1; 
	    $s_yesterday    =    1; 
	    $s_all            =    1; 
	    $s_week            =    1; 
	    $s_month        =    1; 
	     
	    $s_digit        =    1; 
	    $disp_type        =     'Mechanical'; 
	     
	    $widthtable        =    '60'; 
	    $pretext        =     ''; 
	    $posttext        =     ''; 
	    $locktime        =    $locktime * 60; 
	    // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable. 
	    $day             =    date('d'); 
	    $month             =    date('n'); 
	    $year             =    date('Y'); 
	    $daystart         =    mktime(0,0,0,$month,$day,$year); 
	    $monthstart         =  mktime(0,0,0,$month,1,$year); 
	    // weekstart 
	    $weekday         =    date('w'); 
	    $weekday--; 
	    if ($weekday < 0)    $weekday = 7; 
	    $weekday         =    $weekday * 24*60*60; 
	    $weekstart         =    $daystart - $weekday; 

	    $yesterdaystart     =    $daystart - (24*60*60); 
	    $now             =    time(); 
	    $ip                 =    $this->get_ip(); 
	     
	    $t  =  $this->db->row("SELECT MAX(id) AS total FROM table_counter ");
	    $all_visitors     =    $t['total']; 
	     
	    if ($all_visitors !== NULL) { 
	        $all_visitors += $initialvalue; 
	    } else { 
	        $all_visitors = $initialvalue; 
	    } 
	     
	    // Delete old records 
	    $temp = $all_visitors - $records; 
	     
	    if ($temp>0){ 
	        $this->db->query("DELETE FROM table_counter WHERE id<'".$temp."'");
	    } 

	    //$quocgia = $this->get_nation();
	    $trinhduyet = $this->get_browser_name();
	    $dentu =  $this->get_fromto();
	    $web =  $this->get_web();
	    $thietbi = $this->get_device();
	    $hdh = $this->get_hdh();
	    $hdh2 = $this->get_hdh2();
	     
	    $vip  =  $this->db->row("SELECT COUNT(*) AS visitip FROM table_counter WHERE ip='$ip' AND (tm+'$locktime')>'$now'");
	    $items  =    $vip['visitip']; 
	     
	    if (empty($items)) 
	    { 
	        $this->db->query("INSERT INTO table_counter (id, tm, ip,nation,browser,fromto,device,osdetail,website,os) VALUES ('', '$now', '$ip','$quocgia','$trinhduyet','$dentu','$thietbi','$hdh','$web','$hdh2')");
	    } else {
	        $this->db->query("UPDATE table_counter SET pageview = pageview+1 WHERE ip='$ip' AND (tm+'$locktime')>'$now'"); 
	    } 

	}

	function get_counter(){

		$day             =    date('d'); 
	    $month             =    date('n'); 
	    $year             =    date('Y'); 
	    $daystart         =    mktime(0,0,0,$month,$day,$year); 
	    $yesterdaystart     =    $daystart - 86400; 
	    $monthstart         =  mktime(0,0,0,$month,1,$year);

	    $weekday         =    date('w'); 
	    $weekday--; 
	    if ($weekday < 0)    $weekday = 7; 
	    $weekday         =    $weekday * 24*60*60; 
	    $weekstart         =    $daystart - $weekday;  
	    $tonline         =    time() - 60*10;  

	    $online  =  $this->db->row("SELECT COUNT(*) AS onlinerecord FROM table_counter WHERE tm>'$tonline'");
	    $result['online']     =    $online['onlinerecord']; 

		$todayrc  =  $this->db->row("SELECT COUNT(*) AS todayrecord FROM table_counter WHERE tm>'$daystart'");
	    $result['today']     =    $todayrc['todayrecord']; 
	     
	    $yesrec  =  $this->db->row("SELECT COUNT(*) AS yesterdayrec FROM table_counter WHERE tm>'$yesterdaystart' and tm<'$daystart'");
	    $result['yesterday']     =    $yesrec['yesterdayrec']; 
	         
	    $weekrec  =  $this->db->row("SELECT COUNT(*) AS weekrec FROM table_counter WHERE tm>='$weekstart'");
	    $result['week']     =    $weekrec['weekrec']; 

	    $monthrec  =  $this->db->row("SELECT COUNT(*) AS monthrec FROM table_counter WHERE tm>='$monthstart'"); 
	    $result['month']     =    $monthrec['monthrec'];  
	    
	    $t  =  $this->db->row("SELECT MAX(id) AS total FROM table_counter ");
	    $all_visitors     =    $t['total']; 
	    $result['totalaccess'] =  $all_visitors;

	    return $result;
	}

	function get_ip(){
		if (isset($_SERVER['HTTP_CLIENT_IP']))
	    {
	        $real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
	    }

	    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	    {
	        $real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	        $real_ip_adress = $_SERVER['REMOTE_ADDR'];
	    }

	    return $cip = $real_ip_adress;
	}

	function get_nation(){

		$ip = $this->get_ip();
		$iptolocation = 'http://ipinfo.io/'.$ip.'/country';
		if($_SERVER['SERVER_NAME']!='localhost'){
			return $creatorlocation = file_get_contents($iptolocation);
		}

	}

	function get_browser_name()
    {
    	$user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';
    }

    function get_fromto(){
		$form = $_SERVER['HTTP_REFERER'];
		$form = explode('//',$form);
		$form = explode('/',$form[1]);
		$domain = $_SERVER["SERVER_NAME"];
		if($form[0]!=$domain){
			return $form[0];
		} else {
			return '';
		}
	}

	function get_web(){
		$web = $this->get_fromto();
		if($web){
			$catchuoi = explode('.',$web);
			if($catchuoi[0]=='m' || $catchuoi[0]=='www'){
					return $catchuoi[1];
			} else {
					return $catchuoi[0];
			}
		}
	}

	function get_device(){
		$detect = new \Library\Mobile_Detect;
		if($detect->isMobile())
	    {
	        if ($detect->isTablet())
	        {
	            return "Tablet";
	        }
	        else
	        {
	        	return "Phone";    
	        }  
	    }
	    else
	    {
	        return "Computer";
	    }
	}

	function get_hdh(){
		    $result = 'Other';
		    $os = array(
		        '/windows nt 10.0/i' => 'Windows 10',
		        '/windows nt 6.3/i' => 'Windows 8.1',
		        '/windows nt 6.2/i' => 'Windows 8',
		        '/windows nt 6.1/i' => 'Windows 7',
		        '/windows nt 6.0/i' => 'Windows Vista',
		        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
		        '/windows nt 5.1/i' => 'Windows XP',
		        '/windows xp/i' => 'Windows XP',
		        '/windows nt 5.0/i' => 'Windows 2000',
		        '/windows me/i' => 'Windows ME',
		        '/win98/i' => 'Windows 98',
		        '/win95/i' => 'Windows 95',
		        '/win16/i' => 'Windows 3.11',
		        '/macintosh|mac os x/i' => 'Mac OS X',
		        '/mac_powerpc/i' => 'Mac OS 9',
		        '/linux/i' => 'Linux',
		        '/ubuntu/i' => 'Ubuntu',
		        '/iphone/i' => 'iPhone',
		        '/ipod/i' => 'iPod',
		        '/ipad/i' => 'iPad',
		        '/android/i' => 'Android',
		        '/blackberry/i' => 'BlackBerry',
		        '/webos/i' => 'Mobile'
		    );
		    $user_agent = $_SERVER['HTTP_USER_AGENT'];
		    foreach($os as $regex => $value) {
		        if(preg_match($regex, $user_agent)) {
		            $result = $value;
		            break;
		        }
		    }
		    return $result;
	}

	function get_hdh2(){
		    $result = 'Other';
		    $os = array(
		        '/windows nt 10.0/i' => 'Windows',
		        '/windows nt 6.3/i' => 'Windows',
		        '/windows nt 6.2/i' => 'Windows',
		        '/windows nt 6.1/i' => 'Windows',
		        '/windows nt 6.0/i' => 'Windows',
		        '/windows nt 5.2/i' => 'Windows',
		        '/windows nt 5.1/i' => 'Windows',
		        '/windows xp/i' => 'Windows',
		        '/windows nt 5.0/i' => 'Windows',
		        '/windows me/i' => 'Windows',
		        '/win98/i' => 'Windows',
		        '/win95/i' => 'Windows',
		        '/win16/i' => 'Windows',
		        '/macintosh|mac os x/i' => 'Mac OS',
		        '/mac_powerpc/i' => 'Mac OS',
		        '/linux/i' => 'Linux',
		        '/ubuntu/i' => 'Linux',
		        '/iphone/i' => 'IOS',
		        '/ipod/i' => 'IOS',
		        '/ipad/i' => 'IOS',
		        '/android/i' => 'Android',
		        '/blackberry/i' => 'BlackBerry',
		        '/webos/i' => 'Mobile'
		    );
		    $user_agent = $_SERVER['HTTP_USER_AGENT'];
		    foreach($os as $regex => $value) {
		        if(preg_match($regex, $user_agent)) {
		            $result = $value;
		            break;
		        }
		    }
		    return $result;
	}


}
?>