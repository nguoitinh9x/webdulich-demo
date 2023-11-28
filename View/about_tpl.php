<div class="container clearfix">
	<?=$breadcrumbs->urls($row_detail)?>  
	<div class="title-style-1"><h1><?=$title_detail?></h1></div>
	<div class="w-100 clearfix">
		<?=$row_detail['content_'.$lang]!='' ? '<article>'.$row_detail['content_'.$lang].'</article>' : '<div class="alert alert-danger w-100" role="alert">'._updating.'</div>';?>
		<?=$fb->share()?>
	</div>
</div>