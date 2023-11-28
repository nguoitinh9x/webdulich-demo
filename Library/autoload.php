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
	session_start();
	defined( 'DS' ) ?:  define( 'DS', DIRECTORY_SEPARATOR );
	defined( 'LIB' ) ?:  define( 'LIB', ROOT.DS.'Library'.DS );
	defined( 'MODEL' ) ?:  define( 'MODEL', ROOT.DS.'Model'.DS );
	defined( 'VIEW' ) ?:  define( 'VIEW', ROOT.DS.'View'.DS );
	defined( 'LAYOUT' ) ?:  define( 'LAYOUT', VIEW.'Layout'.DS );
	defined( 'ADDON' ) ?:  define( 'ADDON', LAYOUT.'Addon'.DS );
	defined( 'ASSETS' ) ?:  define( 'ASSETS', ROOT.DS.'Assets'.DS );
	require_once LIB."Config.php";
	class autoload
	{
		public function __construct()
		{
			spl_autoload_register(array($this,'_autoload'));
		}
		private function _autoload($file){
			$file = ROOT.DS.str_replace("\\","/",trim($file,'\\')).'.php';
			if(file_exists($file)){
				require_once $file;
			}
		}
	}
	new autoload();
	$db = new ClassPDO($config);
	$Counter = new \Library\Counter($db);
	$clg = new Lang;
	$lang = $clg->lang();
	$func = new functions($db,$lang);
	$fb= new facebook($db,$lang);
	$js= new script($db,$lang);
	$json= new JsonsChema($db,$func);
	$cart = new \Library\Cart($db,$func,$lang);
	$url_tk = ROOT.DS."Upload/lang/lang_".$lang.".json";
	$myfile = fopen($url_tk, "r") or die("Unable to open file!");
	$json_lang = json_decode(fgets($myfile), true);
	$breadcrumbs = new Breadcrumbs();
	$plugin_css = '';
	$plugin_jsfile ='';
	$plugin_js = '';
	$get_nows = $func->getCurrentPageURL();
	if($config['rating']==true){
		$rating = new Rating($db,$func);
		$plugin_css .= $rating->css();
	}
	foreach ($json_lang as $key => $value) {
		@define($key,$value);
	}
	if(!defined('AJAX')){
		require_once LIB."Controller.php";
		require_once LAYOUT."home.php";
	} else {
		if(!isset($_SESSION['ONWEB'])){ DIE("You have no permission to here ! ");}
	}
?>