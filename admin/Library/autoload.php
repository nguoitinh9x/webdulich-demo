<?php
namespace Library;
	/**
	* Application Main Page That Will Serve All Requests
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
	defined( 'ASSETS' ) ?:  define( 'ASSETS', ROOT.DS.'assets'.DS );
	$login_name = 'Administrator';
	require_once ROOT."/../Library/Config.php";
	require dirname(dirname(__DIR__)).'/composer/vendor/autoload.php';

	error_reporting(E_ERROR | E_PARSE);

	class autoload
	{
		public function __construct()
		{
			spl_autoload_register(array($this,'_autoload'));
		}
		private function _autoload($file){
			$file = ROOT.'/../'.str_replace("\\","/",trim($file,'\\')).'.php';
			if(file_exists($file)){
				require_once $file;
			}
		}
	}
	
	new autoload();
	$db = new ClassPDO($config);
	$clg = new Lang();
	$lang = $clg->lang();
	$func = new functions($db,$lang);
	$getPost = new GetPost($db,$lang);
	new Model($db,$func,$lang);
	$url_tk = ROOT."/../Upload/lang/lang_".$lang.".json";
	$myfile = fopen($url_tk, "r") or die("Unable to open file!");
	$json_lang = json_decode(fgets($myfile), true);
	foreach ($json_lang as $key => $value) {
		@define($key,$value);
	}
	if(!defined('AJAX')){
		require_once LIB."type.php";
		require_once LIB."Controller.php";
		if (!(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true))): 
			require_once  VIEW.'login_tpl.php';
	else:
		require_once VIEW."home.php";
	endif;
} else {
	if(!isset($_SESSION[$login_name]) && $_REQUEST['act']!='login'){ DIE("You have no permission to here ! ");}
}
//CSRF
// if (isset($_POST)) {
// 	$csrt_token = $_SERVER['HTTP_X_CSRF_TOKEN'];
// 	if($_SESSION['crsf_enc']!== $func->encrypt_password($csrt_token)) DIE("You have no permission to here ! ");
// }