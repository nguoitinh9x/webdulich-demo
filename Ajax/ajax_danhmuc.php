<?php 
	session_start();
	@define ( '_lib' , '../libraries/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	
	if($_POST["type"]==''){
		$level = $_POST["level"];
		$table = $_POST["table"];
		$id=$_POST["id"];
		switch ($level) {
			case '0':{

				$d->reset();
				$sql = "select id from #_place_city where tenkhongdau='".$id."' ";
				$d->query($sql);
				$list_id = $d->fetch_array();
				$id = $list_id['id'];

				$id_temp= "id_city";
				$tilte = 'Quận / Huyện';
				break;
			}
			case '1':{

				$d->reset();
				$sql = "select id from #_place_dist where tenkhongdau='".$id."' ";
				$d->query($sql);
				$list_id = $d->fetch_array();
				$id = $list_id['id'];

				$id_temp= "id_dist";
				$tilte = 'Phường / Xã';
				break;
			}
			case '2':{

				$d->reset();
				$sql = "select id from #_place_ward where tenkhongdau='".$id."' ";
				$d->query($sql);
				$list_id = $d->fetch_array();
				$id = $list_id['id'];

				$id_temp= "id_ward";
				$tilte = 'Phường / Xã';
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		
		$sql="select * from ".$table." where $id_temp=".$id."  order by ten asc ";
		$stmt=mysql_query($sql);
		$str='<option value="0">Chọn '.$tilte.'</option>';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$id_select)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["tenkhongdau"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		echo  $str;
	}

?>
