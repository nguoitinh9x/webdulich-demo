<?php
    $tagss = $db->query("select name_$lang,slug from #_post where shows=1 and type='tags' and highlight=1 order by number,id desc");
?>

<div class="boxTags">
	<h6>Tags</h6>
	<ul>
		<?php foreach ($tagss as $value): ?>
			<li><a href="tags/<?=$value['slug']?>" title="<?=$value['name_'.$lang]?>"><?=$value['name_'.$lang]?>, </a></li>
		<?php endforeach ?>
	</ul>
</div>
