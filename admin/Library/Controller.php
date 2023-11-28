<?php
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
 
	$com = (isset($_GET['com'])) ? addslashes($_GET['com']) : "";
	$act = (isset($_GET['act'])) ? addslashes($_GET['act']) : "";
	$type = (isset($_GET['type'])) ? addslashes($_GET['type']) : "";
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$arr_act = explode('_', $act);
	$fact = isset($arr_act[1]) ? $arr_act[1] : '';
	if(!$com){ $com = 'index';}
	if ($page <= 0) $page = 1;

	if($act=='createlang'){	
		include_once LIB."lang_arr.php";
	}
			
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		$func->redirect(_BASEURL_."admin/index.html?com=user&act=login");
	}

	if($arr_act[0] == 'man' || $arr_act[0]=='capnhat'){
	    $_SESSION['links_re'] = $func->getCurrentPage();
	}
	if(isset($_SESSION['login']) && $_SESSION['login']){
		if($_SESSION['login']['role']==2 && $_GET['com']!='' && $_GET['act']!='logout' && $_GET['act']!='login'){
			if($func->phanquyen_tv($_GET['com'],$_SESSION['login']['quyen'],$_GET['act'],$_GET['type'])==0){
				$_SESSION['edit']['quyen'] = 'false';
				$func->transfer("Bạn Không có quyền vào đây !","index.html");
			} else {
				$_SESSION['edit']['quyen'] = 'true';
			}
		}
	}

	require_once MODEL.$com.'.php';