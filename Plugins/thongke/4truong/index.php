<?php
	$counter = new Library\Counter($db);
	$row_thongke = $counter->get_counter();
?>

<ul class="thongke ul">
	<li><?=_dangonline?> : <span><?=$row_thongke['online']?></span></li>
	<li>Online trong tuần : <span><?=$row_thongke['week']?></span></li>
	<li>Online trong tháng : <span><?=$row_thongke['month']?></span></li>
	<li><?=_tongtruycap?> : <span><?=$row_thongke['totalaccess']?></span></li>
</ul>
