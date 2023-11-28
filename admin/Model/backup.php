<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "backup_file":					
		backup_file();
		$template = "backup/backup_file";
		break;	
	case "backup_database":					
		backup_database();
		$template = "backup/backup_database";
		break;		
	default:
		$template = "index";
}



function backup_file(){
	global $list_file_bakup,$archive;	
	$dir = 'db_backup/data';
	define('DIR_BACKUP', '../upload');
	
	//Tiến hành backup
	if(!empty($_POST)){
		$filename = stripUnicode($_POST['filename']);
   		if($filename!=''){
			$file = "./db_backup/data/" . $filename . ".zip";
			$archive = new PclZip($file);
			$v_list = $archive->create(DIR_BACKUP);
			 if ($v_list == 0) {
    	  		die("Error : " . $archive->errorInfo(true));
    		}
	   	 $mess = "Backup file " . $filename . ".zip Success !!!!";   	
   		 transfer($mess, "index.php?com=backup&act=backup_file");
		}
	
	}
	
	//Xóa file backup
	if(@$_REQUEST['sub']!=''){
		$sub=$_REQUEST['sub'];
		if($sub=='del'){
			$filename = $_GET['f'];
			$file = $dir .'/'. $filename;
			if (file_exists($file)) {
			  @unlink($file);
			  $mess = "Xóa File " . $filename . " thành công!";
			} else {
			  $mess = "File " . $filename . " không tồn tại!";
			}
			transfer($mess, "index.php?com=backup&act=backup_file");
		}
	  }
  
  	//Lấy danh sách file backup
	if ($handle = opendir($dir)) {
		  while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != "thumb.db" && $file != "index.html") {
			  $lastupdate = filemtime($dir . "/" . $file);
			  $tmpFiles[] = array(
				$file , 
				$lastupdate);
			}
		  }
		}
		
		foreach ($tmpFiles as $key) {
		  $arr_file[] = $key[0];
		}
		for ($i = 0; $i < count($arr_file); $i ++) {
		  $entry = $arr_file[$i];
		  if (($entry != ".") && ($entry != "..") && ($entry != "index.html")) {
			$datebackup = date("h:i - d/m/Y", filemtime($dir . "/" . $entry));
			if ($f_size = @filesize("{$dir}/{$entry}"))
			  $size = format_size($f_size);
			else
			  $size = 0;
			$list_file_bakup .= "<tr><td>".($i+1)."</td>
						<td >{$entry}</td>
						<td >{$datebackup}</td>
						<td align=center>{$size}</td>
						 <td class=\"actBtns\"><a href=\"./db_backup/data/$entry\" title=\"\" class=\"smallButton tipS\" original-title=\"Download file backup\"  ><img src=\"./images/icons/dark/save.png\" alt=\"Download file \"></a> <a href=\"index.php?com=backup&act=backup_file&sub=del&f={$entry}\" onClick=\"return confirm('Bạn có chắc muốn xóa file này?');\" title=\"\" class=\"smallButton tipS\" original-title=\"Delete file backup\"><img src=\"./images/icons/dark/close.png\" alt=\"Download file sql\"></a></td></tr>";
		  }
		}		
}

function backup_database(){
	global $d,$list_database_bakup,$config,$table_select;
	
	//Xóa file backup
	if(@$_REQUEST['sub']!=''){
		$sub=$_REQUEST['sub'];
		if($sub=='del'){
			$f = $_GET['f'];			
			if ($f != 0) {
			  $err = 0;
			  $filenamesql = "db_backup/exports/" . $config['database']['database'] . "." . $f . ".sql";
			  $fnamesql = $config['database']['database'] . "." . $f . ".sql";
			  $filenameinfo = "db_backup/exports/" . $config['database']['database'] . "." . $f . ".info";
			  $fnameinfo = $config['database']['database'] . "." . $f . ".info";
			  if (! @unlink($filenamesql))
				$err = 1;
			  if (! @unlink($filenameinfo))
				$err = 1;				
			  if ($err == 1) {
				$mess = "Fille Not Found !!!";
			  } else {
				$mess = "Deltele Backup Successfull";
			  }
					 
			}
			transfer($mess, "index.php?com=backup&act=backup_database");
		}
	  }
	  
	  //Download file backup
	if(@$_REQUEST['sub']!=''){
		$sub=$_REQUEST['sub'];
		if($sub=='down'){
			$f = $_GET['f'];			
			if ($f != 0) {
			  $err = 0;
			  $filename = "db_backup/exports/" . $config['database']['database'] . "." . $f . ".sql";
			  if (file_exists($filename)) {
			  $fname = $config['database']['database'] . "." . $f;
			  @ob_start();
			  @ob_implicit_flush(0);
			  header('Content-Type: text/x-delimtext; name="' . $fname . '.sql.gz"');
			  header('Content-disposition: attachment; filename=' . $fname . '.sql.gz');
			  header("Pragma: no-cache");
			  header("Expires: 0");
			  echo @readfile($filename);
			  $gzip_contents = ob_get_contents();
			  ob_end_clean();
			  $gzip_size = strlen($gzip_contents);
			  $gzip_crc = crc32($gzip_contents);
			  $gzip_contents = gzcompress($gzip_contents, 9);
			  $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
			  echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
			  echo $gzip_contents;
			  echo pack('V', $gzip_crc);
			  echo pack('V', $gzip_size);
			} else {
			  $mess = "Fille Not Found !!!";
			}

					 
			}
			transfer($mess, "index.php?com=backup&act=backup_database");
		}
	  }
	  
	  
	//Tiến hành backup
	if(!empty($_POST)){
		$time = time();
		$now = mktime();
		$a_table = $_POST["db_tables"];
		
		$file_sql = "db_backup/exports/" . $config['database']['database'] . "." . $time . ".sql";
		$file_info ="db_backup/exports/" . $config['database']['database'] . "." . $time . ".info";
		do_backup($file_sql, $a_table);
		$backup_size = @filesize($file_sql);
		// Write Info to file
		$fp = fopen($file_info, "w");
		fwrite($fp, "$time|{$config['database']['database']}|$backup_size");
		fclose($fp);
		// Write  to file last.dat
		$fp = @fopen("db_backup/last.dat", "w");
		fwrite($fp, $now);
		fclose($fp);
		chmod($file_sql, 0777);
		chmod($file_info, 0777);
			
			//insert adminlog
		//$func->insertlog("Backup", $_GET['act'], $id);
				
		// End write
		$mess = "Backup Successfull !";
		
		transfer($mess, "index.php?com=backup&act=backup_database");
	}
	
	//Lay danh sach table
	
	  
	$table_select = "<select name=\"db_tables[]\" size=\"10\" multiple class='select' style='width:90%'>\n";
    $result = $d->query("SHOW tables");
    while ($row = mysql_fetch_array($result)) {   
	  $table_select .= "<option value=\"" . $row[0] . "\"";
      
        $table_select .= " selected";
     
      $table_select .= ">" . $row[0] . "</option>\n";
    }
    $table_select .= "</select>\n";	
	
	
	//Lay danh sach file
	$list_arr = array();
    $totals = 0;
    $handle = opendir('db_backup/exports');
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != "..") {
        //check if it is a sql file, and it is in the correct format
        $file_info_arr = explode(".", $file);
        $filtype = $file_info_arr[2];
        if ($filtype == "sql") {
          $fileinfo = $file_info_arr[0] . "." . $file_info_arr[1] . ".info";
          $list_arr[$totals]['file'] = "db_backup/exports/" . $file;
          $list_arr[$totals]['info'] = "db_backup/exports/" . $fileinfo;
          $totals ++;
        }
      }
    }
    rsort($list_arr);
    for ($i = 0; $i < $totals; $i ++) {
      $file_info_arr = explode(".", $list_arr[$i]['file']);
      $fileinfo = $list_arr[$i]['info'];
      $f = fopen($fileinfo, "r");
      $fullinfo = fgets($f, 4096);
      fclose($f);
      $info_arr = explode("|", $fullinfo);
      $size = $info_arr[2];
      $s1 = ($size - ($size % 1024)) / 1024;
      $s2 = (($size * 10 - (($size * 10) % 1024)) / 1024) % 10;
      $size = $s1 . "." . $s2;
      $d = getdate($info_arr[0]);
      $time = "{$d['hours']}:{$d['minutes']}:{$d['seconds']} - {$d['mday']}/{$d['mon']}/{$d['year']}";
      $list .= "<tr class='row0'><td>".($i+1)."</td><td >{$info_arr[1]}</td><td >{$time}</td>
				<td align=center>{$size} KB</td>
				<td class=\"actBtns\"><a href=\"index.php?com=backup&act=backup_database&sub=down&f={$info_arr[0]}\" title=\"\" class=\"smallButton tipS\" original-title=\"Download file backup\"  ><img src=\"./images/icons/dark/save.png\" alt=\"Download file \"></a> <a href=\"index.php?com=backup&act=backup_database&sub=del&f={$info_arr[0]}\" onClick=\"return confirm('Bạn có chắc muốn xóa file này?');\" title=\"\" class=\"smallButton tipS\" original-title=\"Delete file backup\"><img src=\"./images/icons/dark/close.png\" alt=\"Download file sql\"></a></td></tr>";
    }	
	$list_database_bakup= $list;				
}


/**
 * function do_dump 
 *  
 **/
function do_dump ($table, $fp = 0)
{
  global $d;
  //		if (in_array(substr($table, strlen($conf['prefix'])), $GLOBALS['exclude'])) return;
  $tabledump = "\n";
  $tabledump .= "DROP TABLE IF EXISTS $table;\n";
  $rows = $d->query("SHOW CREATE TABLE $table");
  $data = mysql_fetch_array($rows);
  //$tabledump .= preg_replace('/\r|\n|\t/', '', $data[1]).";\n";
  $tabledump .= preg_replace('/\r|\n|\t/', '', $data[1]) . ";\n";
  if ($fp)
    fwrite($fp, $tabledump);
  else
    echo $tabledump;
  $rows = $d->query("SELECT * FROM $table");
  $numfields = $d->num_fields($rows);
  $dump = array();
  $length = 0;
  while ($row = mysql_fetch_array($rows)) {
    $data = '(';
    for ($i = 0; $i < $numfields; $i ++) {
      if ($i != 0)
        $data .= ',';
      $data .= isset($row[$i]) ? "'" . mysql_escape_string($row[$i]) . "'" : 'NULL';
    }
    $dump[] = $data . ')';
    $length += strlen($data) + 1;
    if ($length > 100000) {
      $tabledump = "INSERT INTO $table VALUES " . implode(', ', $dump) . ";\n";
      $dump = array();
      $length = 0;
      if ($fp)
        fwrite($fp, $tabledump);
      else
        echo $tabledump;
    }
  }
  mysql_free_result($rows);
  if ($length > 0) {
    $tabledump = "INSERT INTO $table VALUES " . implode(', ', $dump) . ";\n";
    if ($fp)
      fwrite($fp, $tabledump);
    else
      echo $tabledump;
  }
}

/**
 * function do_backup 
 *  
 **/
function do_backup ($filename = "databse.sql", $a_table = "")
{
  global $d,$config;
  $fp = fopen($filename, "w");
  // Header
  $header = "#----------------------------------------\n";
  $header .= "# Backup Web Database \n";
  $header .= "# Version 1.0 by Gaconlonton  \n";
  $header .= "# http://nina.vn  \n";
  $header .= "# DATABASE:  " . $config['database']['database']. "\n";
  $header .= "# Date/Time:  " . date("l dS  F Y H:i:s") . "\n";
  $header .= "#----------------------------------------\n";
  fwrite($fp, $header);
  $tablesbackup = $d->query("SHOW tables");
  $nums = $d->num_rows($tablesbackup);
  //echo "Dumping ($nums tables): ";flush();$i=0;
  while ($tablebackup = mysql_fetch_array($tablesbackup)) {
    if (is_array($a_table)) {
      if (in_array($tablebackup[0], $a_table)) {
        do_dump($tablebackup[0], $fp);
      }
    } else {
      do_dump($tablebackup[0], $fp);
    }
    //echo ++$i%10;
    flush();
  }
  fclose($fp);  
}
?>