<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
		get_items();			
		$template = "database/items";
		break;	
	default:
		$template = "index";
}
function get_items(){
	global $d,$mess;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['idtable'];
		$count=count($id_array);
		if($multi=='analyze'){
			for($i=0;$i<$count;$i++){
				$d->query("ANALYZE TABLE ".$id_array[$i]);	
			}
			echo $mess="Analyze complete!";
		}
		if($multi=='repair'){
			for($i=0;$i<$count;$i++){
				$d->query("REPAIR TABLE ".$id_array[$i]);			
			}
				$mess="Repair complete!";	
		}
		if($multi=='optimize'){
			for($i=0;$i<$count;$i++){
				$d->query("OPTIMIZE TABLE ".$id_array[$i]);						
			}
				$mess="Optimize complete!";	
		}
								
	}
					
	
}

?>