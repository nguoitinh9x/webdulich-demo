<?php 
    $Search_list = $db->query("select id,slug,name_$lang from #_cate_list where type='product' and shows=1 order by number desc,id desc");
?>

<form action="tim-kiem/" class="input-group timkiem" id="form_search" method="POST" onsubmit="return false;">
	<div class="input-group-append">
		<select class="form-control" id="listid" required>
			<option value="">Tất cả</option>
			<?php foreach ($Search_list as $value) : ?>
				<option value="<?= $value['id'] ?>"><?= $value["name_$lang"] ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<input class="form-control" type="text" name="keywords" placeholder="Tìm sản phẩm, thương hiệu bạn mong muốn">
	<div class="input-group-append">
		<button type="button" class="input-group-text" onclick="submitsearch(this)" >Tìm kiếm</button>
	</div>
</form>