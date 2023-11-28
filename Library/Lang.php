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
class Lang{

	public function __construct()
    {
       if(isset($_GET['lang']) && $_GET['lang']!=''){
			$_SESSION['lang']=$_GET['lang'];
			header("location:".$_SESSION['links']);
		} else {
			$_SESSION['links']=Lang::getCurrentPageURL();
		}
    }

    static public function getCurrentPageURL() {
	    $pageURL = 'http';
	    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	    $pageURL .= "://";
	    if ($_SERVER["SERVER_PORT"] != "80") {
	        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	    } else {
	        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	    }
		$pageURL = explode("&page=", $pageURL);
	    return $pageURL[0];
	}

	public function lang(){
		if(!isset($_SESSION['lang']))
		{
			$_SESSION['lang']='vi';
		}
			$lang=$_SESSION['lang'];
		return $lang;
	}
	public function langadmin(){
		if(!isset($_SESSION['langadmin']))
		{
			$_SESSION['langadmin']='vi';
		}
			$lang=$_SESSION['langadmin'];
		return $lang;
	}

}
?>