<?php 
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	
	$lang_config = array();
	#=================================================================bài viết
	$lang_config[0]['name'] = 'baiviet';
	
	$lang_config[0]['value'][0]['name'] = 'name';
	$lang_config[0]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[0]['value'][1]['name'] = 'discription';
	$lang_config[0]['value'][1]['type'] = 'TEXT';

	$lang_config[0]['value'][2]['name'] = 'content';
	$lang_config[0]['value'][2]['type'] = 'TEXT';
	#=================================================================sản phẩm
	$lang_config[1]['name'] = 'product';
	
	$lang_config[1]['value'][0]['name'] = 'name';
	$lang_config[1]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[1]['value'][1]['name'] = 'discription';
	$lang_config[1]['value'][1]['type'] = 'TEXT';

	$lang_config[1]['value'][2]['name'] = 'content';
	$lang_config[1]['value'][2]['type'] = 'TEXT';
	#=================================================================info
	$lang_config[2]['name'] = 'info';
	
	$lang_config[2]['value'][0]['name'] = 'name';
	$lang_config[2]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[2]['value'][1]['name'] = 'discription';
	$lang_config[2]['value'][1]['type'] = 'TEXT';

	$lang_config[2]['value'][2]['name'] = 'content';
	$lang_config[2]['value'][2]['type'] = 'LONGTEXT';
	#=================================================================info
	$lang_config[3]['name'] = 'baiviet_list';
	
	$lang_config[3]['value'][0]['name'] = 'name';
	$lang_config[3]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[3]['value'][1]['name'] = 'discription';
	$lang_config[3]['value'][1]['type'] = 'TEXT';
	#=================================================================list
	$lang_config[4]['name'] = 'product_list';
	
	$lang_config[4]['value'][0]['name'] = 'name';
	$lang_config[4]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[4]['value'][2]['name'] = 'shortname';
	$lang_config[4]['value'][2]['type'] = 'VARCHAR(255)';

	$lang_config[4]['value'][1]['name'] = 'discription';
	$lang_config[4]['value'][1]['type'] = 'TEXT';
	#=================================================================cat
	$lang_config[5]['name'] = 'product_cat';
	
	$lang_config[5]['value'][0]['name'] = 'name';
	$lang_config[5]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[5]['value'][1]['name'] = 'discription';
	$lang_config[5]['value'][1]['type'] = 'TEXT';
	#=================================================================item
	$lang_config[6]['name'] = 'product_item';
	
	$lang_config[6]['value'][0]['name'] = 'name';
	$lang_config[6]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[6]['value'][1]['name'] = 'discription';
	$lang_config[6]['value'][1]['type'] = 'TEXT';
	#=================================================================sub
	$lang_config[7]['name'] = 'product_sub';
	
	$lang_config[7]['value'][0]['name'] = 'name';
	$lang_config[7]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[7]['value'][1]['name'] = 'discription';
	$lang_config[7]['value'][1]['type'] = 'TEXT';
	#=================================================================gia
	$lang_config[8]['name'] = 'video';
	
	$lang_config[8]['value'][0]['name'] = 'name';
	$lang_config[8]['value'][0]['type'] = 'VARCHAR(255)';
	#=================================================================setting
	$lang_config[9]['name'] = 'setting';
	
	$lang_config[9]['value'][0]['name'] = 'name';
	$lang_config[9]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[9]['value'][1]['name'] = 'slogan';
	$lang_config[9]['value'][1]['type'] = 'VARCHAR(255)';

	$lang_config[9]['value'][2]['name'] = 'address';
	$lang_config[9]['value'][2]['type'] = 'VARCHAR(255)';

	$lang_config[9]['value'][3]['name'] = 'shortname';
	$lang_config[9]['value'][3]['type'] = 'VARCHAR(255)';

	#=================================================================lang
	$lang_config[10]['name'] = 'lang';
	$lang_config[10]['value'][0]['name'] = 'type';
	$lang_config[10]['value'][0]['type'] = 'VARCHAR(255)';

	#=================================================================gia
	$lang_config[11]['name'] = 'photo';
	
	$lang_config[11]['value'][0]['name'] = 'photo';
	$lang_config[11]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[11]['value'][1]['name'] = 'thumb';
	$lang_config[11]['value'][1]['type'] = 'VARCHAR(255)';

	$lang_config[11]['value'][2]['name'] = 'name';
	$lang_config[11]['value'][2]['type'] = 'VARCHAR(255)';

	#=================================================================gia
	$lang_config[12]['name'] = 'album_list';
	
	$lang_config[12]['value'][0]['name'] = 'name';
	$lang_config[12]['value'][0]['type'] = 'VARCHAR(255)';

	#=================================================================gia
	$lang_config[13]['name'] = 'album';
	
	$lang_config[13]['value'][0]['name'] = 'name';
	$lang_config[13]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[13]['value'][1]['name'] = 'discription';
	$lang_config[13]['value'][1]['type'] = 'TEXT';

	$lang_config[13]['value'][2]['name'] = 'content';
	$lang_config[13]['value'][2]['type'] = 'LONGTEXT';

	#=================================================================gia
	$lang_config[14]['name'] = 'lkweb';
	
	$lang_config[14]['value'][0]['name'] = 'name';
	$lang_config[14]['value'][0]['type'] = 'VARCHAR(255)';
	#=================================================================gia
	$lang_config[15]['name'] = 'download';
	
	$lang_config[15]['value'][0]['name'] = 'name';
	$lang_config[15]['value'][0]['type'] = 'VARCHAR(255)';
	#=================================================================gia
	$lang_config[16]['name'] = 'tags';
	
	$lang_config[16]['value'][0]['name'] = 'name';
	$lang_config[16]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[16]['value'][1]['name'] = 'discription';
	$lang_config[16]['value'][1]['type'] = 'TEXT';
	#=================================================================gia
	$lang_config[17]['name'] = 'tieude';
	
	$lang_config[17]['value'][0]['name'] = 'name';
	$lang_config[17]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[17]['value'][1]['name'] = 'discription';
	$lang_config[17]['value'][1]['type'] = 'TEXT';

	$lang_config[17]['value'][2]['name'] = 'content';
	$lang_config[17]['value'][2]['type'] = 'LONGTEXT';

	#=================================================================info
	$lang_config[18]['name'] = 'baiviet_cat';
	
	$lang_config[18]['value'][0]['name'] = 'name';
	$lang_config[18]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[18]['value'][1]['name'] = 'discription';
	$lang_config[18]['value'][1]['type'] = 'TEXT';
	#=================================================================info
	$lang_config[19]['name'] = 'baiviet_item';
	
	$lang_config[19]['value'][0]['name'] = 'name';
	$lang_config[19]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[19]['value'][1]['name'] = 'discription';
	$lang_config[19]['value'][1]['type'] = 'TEXT';
	#=================================================================info
	$lang_config[20]['name'] = 'baiviet_sub';
	
	$lang_config[20]['value'][0]['name'] = 'name';
	$lang_config[20]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[20]['value'][1]['name'] = 'discription';
	$lang_config[20]['value'][1]['type'] = 'TEXT';



	#=================================================================create lang
	foreach ($config['lang'] as $key => $value) {
		$lang = $key;
		for ($i=0,$c=count($lang_config); $i < $c; $i++) { 
			$table = $lang_config[$i]['name'];
			for ($j=0,$cc=count($lang_config[$i]['value']); $j < $cc; $j++) { 
				$column  = $lang_config[$i]['value'][$j]['name'];
				$type = $lang_config[$i]['value'][$j]['type'];
				$db->query("SHOW COLUMNS FROM table_".$table." LIKE '".$column."_".$lang."'");
				$row = $d->fetch_array();
				if($row==null){
					$db->query("ALTER TABLE table_".$table." ADD ".$column."_".$lang." $type CHARACTER SET utf8 COLLATE utf8_unicode_ci ");	
				}
			}
		}
	}
	#=================================================================function delete lang
	if(!function_exists("delete_lang")){
		function delete_lang($lang = 'ci'){
			global $lang_config,$d;
			for ($i=0,$c=count($lang_config); $i < $c; $i++) { 
				$table = $lang_config[$i]['name'];
				for ($j=0,$cc=count($lang_config[$i]['value']); $j < $cc; $j++) { 
					$column  = $lang_config[$i]['value'][$j]['name'];
					$db->query("SHOW COLUMNS FROM table_".$table." LIKE '".$column."_".$lang."'");
					$row = $d->fetch_array();
					if($row!=null){
						$db->query("ALTER TABLE table_$table DROP ".$column."_".$lang);
					}
				}
			}
		}
	}
	
	//delete_lang('cn');
	?>