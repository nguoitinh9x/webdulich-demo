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
	$lang_config[0]['name'] = 'post';
	
	$lang_config[0]['value'][0]['name'] = 'name';
	$lang_config[0]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[0]['value'][1]['name'] = 'description';
	$lang_config[0]['value'][1]['type'] = 'TEXT';

	$lang_config[0]['value'][2]['name'] = 'content';
	$lang_config[0]['value'][2]['type'] = 'TEXT';
	#=================================================================sản phẩm
	$lang_config[1]['name'] = 'product';
	
	$lang_config[1]['value'][0]['name'] = 'name';
	$lang_config[1]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[1]['value'][1]['name'] = 'description';
	$lang_config[1]['value'][1]['type'] = 'TEXT';

	$lang_config[1]['value'][2]['name'] = 'content';
	$lang_config[1]['value'][2]['type'] = 'TEXT';
	#=================================================================info
	$lang_config[2]['name'] = 'info';
	
	$lang_config[2]['value'][0]['name'] = 'name';
	$lang_config[2]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[2]['value'][1]['name'] = 'description';
	$lang_config[2]['value'][1]['type'] = 'TEXT';

	$lang_config[2]['value'][2]['name'] = 'content';
	$lang_config[2]['value'][2]['type'] = 'LONGTEXT';
	#=================================================================list
	$lang_config[3]['name'] = 'cate_list';
	
	$lang_config[3]['value'][0]['name'] = 'name';
	$lang_config[3]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[3]['value'][2]['name'] = 'shortname';
	$lang_config[3]['value'][2]['type'] = 'VARCHAR(255)';

	$lang_config[3]['value'][1]['name'] = 'description';
	$lang_config[3]['value'][1]['type'] = 'TEXT';
	#=================================================================cat
	$lang_config[4]['name'] = 'cate_cat';
	
	$lang_config[4]['value'][0]['name'] = 'name';
	$lang_config[4]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[4]['value'][1]['name'] = 'description';
	$lang_config[4]['value'][1]['type'] = 'TEXT';
	#=================================================================item
	$lang_config[5]['name'] = 'cate_item';
	
	$lang_config[5]['value'][0]['name'] = 'name';
	$lang_config[5]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[5]['value'][1]['name'] = 'description';
	$lang_config[5]['value'][1]['type'] = 'TEXT';
	#=================================================================sub
	$lang_config[6]['name'] = 'cate_sub';
	
	$lang_config[6]['value'][0]['name'] = 'name';
	$lang_config[6]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[6]['value'][1]['name'] = 'description';
	$lang_config[6]['value'][1]['type'] = 'TEXT';
	#=================================================================gia
	$lang_config[7]['name'] = 'video';
	
	$lang_config[7]['value'][0]['name'] = 'name';
	$lang_config[7]['value'][0]['type'] = 'VARCHAR(255)';
	#=================================================================setting
	$lang_config[8]['name'] = 'setting';
	
	$lang_config[8]['value'][0]['name'] = 'name';
	$lang_config[8]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[8]['value'][1]['name'] = 'slogan';
	$lang_config[8]['value'][1]['type'] = 'VARCHAR(255)';

	$lang_config[8]['value'][2]['name'] = 'address';
	$lang_config[8]['value'][2]['type'] = 'VARCHAR(255)';

	$lang_config[8]['value'][3]['name'] = 'shortname';
	$lang_config[8]['value'][3]['type'] = 'VARCHAR(255)';

	#=================================================================lang
	$lang_config[9]['name'] = 'lang';
	$lang_config[9]['value'][0]['name'] = 'type';
	$lang_config[9]['value'][0]['type'] = 'VARCHAR(255)';

	#=================================================================gia
	$lang_config[10]['name'] = 'photo';
	
	$lang_config[10]['value'][0]['name'] = 'photo';
	$lang_config[10]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[10]['value'][1]['name'] = 'thumb';
	$lang_config[10]['value'][1]['type'] = 'VARCHAR(255)';

	$lang_config[10]['value'][2]['name'] = 'name';
	$lang_config[10]['value'][2]['type'] = 'VARCHAR(255)';

	#=================================================================gia
	$lang_config[11]['name'] = 'album';
	
	$lang_config[11]['value'][0]['name'] = 'name';
	$lang_config[11]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[11]['value'][1]['name'] = 'description';
	$lang_config[11]['value'][1]['type'] = 'TEXT';

	$lang_config[11]['value'][2]['name'] = 'content';
	$lang_config[11]['value'][2]['type'] = 'LONGTEXT';

	#=================================================================gia
	$lang_config[12]['name'] = 'link';
	
	$lang_config[12]['value'][0]['name'] = 'name';
	$lang_config[12]['value'][0]['type'] = 'VARCHAR(255)';
	
	#=================================================================gia
	$lang_config[13]['name'] = 'tags';
	
	$lang_config[13]['value'][0]['name'] = 'name';
	$lang_config[13]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[13]['value'][1]['name'] = 'description';
	$lang_config[13]['value'][1]['type'] = 'TEXT';
	#=================================================================gia
	$lang_config[14]['name'] = 'title';
	
	$lang_config[14]['value'][0]['name'] = 'name';
	$lang_config[14]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[14]['value'][1]['name'] = 'description';
	$lang_config[14]['value'][1]['type'] = 'TEXT';

	#=================================================================create lang
	foreach ($config['lang'] as $key => $value) {
		$lang = $key;
		for ($i=0,$c=count($lang_config); $i < $c; $i++) { 
			$table = $lang_config[$i]['name'];
			for ($j=0,$cc=count($lang_config[$i]['value']); $j < $cc; $j++) { 
				$column  = $lang_config[$i]['value'][$j]['name'];
				$type = $lang_config[$i]['value'][$j]['type'];
				$row = $db->row("SHOW COLUMNS FROM table_".$table." LIKE '".$column."_".$lang."'");
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
					$row = $db->row("SHOW COLUMNS FROM table_".$table." LIKE '".$column."_".$lang."'");
					if($row!=null){
						$db->query("ALTER TABLE table_$table DROP ".$column."_".$lang);
					}
				}
			}
		}
	}
	
	//delete_lang('cn');
	?>