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
class Breadcrumbs{
	
	public function urls($row_detail=array(),$setcom='')	
	{	
		global $title_com,$com,$lang,$db;
		@$idc =  $_GET['idc'];
		@$idl =  $_GET['idl'];
		@$idi =  $_GET['idi'];
		@$ids =  $_GET['ids'];
		@$id =  $_GET['id'];

		$html .= '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
	    $html .= '<li class="breadcrumb-item"><a href="">'._trangchu.'</a></li>';
	    $html .= '<li class="breadcrumb-item"><a href="'.$com.'/">'.$title_com.'</a></li>';
	    if($setcom == 'nocom'){
	    	$comin = '';
	    } else {
	    	$comin = $com.'/';
	    }
		//print_r($comin);
		if($row_detail){
	        if($row_detail['id_list']){
	        	$list  =  $db->row("select slug,name_$lang from #_cate_list where id=".$row_detail['id_list']);
	        	$html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/">'.$list['name_'.$lang].'</a></li>';
	        }
	        if($row_detail['id_cat']){
	        	$cat  =  $db->row("select slug,name_$lang from #_cate_cat where id=".$row_detail['id_cat']);
	        	$html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/'.$cat['slug'].'">'.$cat['name_'.$lang].'</a></li>';
	        }
	        if($row_detail['id_item']){
	        	$items  =  $db->row("select slug,name_$lang from #_cate_item where id=".$row_detail['id_item']);
	        	$html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/'.$cat['slug'].'/'.$items['slug'].'">'.$items['name_'.$lang].'</a></li>';
	        }
	        if($row_detail['id_sub']){
	        	$sub  =  $db->row("select slug,name_$lang from #_cate_sub where id=".$row_detail['id_sub']);
	        	$html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/'.$cat['slug'].'/'.$items['slug'].'/'.$sub['slug'].'">'.$sub['name_'.$lang].'</a></li>';
	        }
		}
		if($idl){ $html .= '<li class="breadcrumb-item"><a href="'.$comin.$idl.'/">'.$row_detail['name_'.$lang].'</a></li>'; }
		if($idc){ $html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/'.$idc.'">'.$row_detail['name_'.$lang].'</a></li>'; }
		if($idi){ $html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/'.$cat['slug'].'/'.$idi.'">'.$row_detail['name_'.$lang].'</a></li>'; }
		//if($ids){ $html .= '<li class="breadcrumb-item"><a href="'.$comin.$list['slug'].'/'.$cat['slug'].'/'.$items['slug'].'/'.$ids.'">'.$row_detail['name_'.$lang].'</a></li>';; }
		if($id){ $html .= '<li class="breadcrumb-item"><a href="'.$com.'/'.$id.'">'.$row_detail['name_'.$lang].'</a></li>'; }
        $html .= '</ol></nav>';
        return $html;
	}

}
?>