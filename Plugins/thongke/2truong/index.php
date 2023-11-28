<?php
	$counter = new Library\Counter($db);
	$row_thongke = $counter->get_counter();
?>

<ul class="thongke ul">
	<li>Online : <?=$row_thongke['online']?><span>|</span></li>
	<li>Trong tháng : <?=$row_thongke['month']?><span>|</span></li>
	<li>Tổng truy cập : <?=$row_thongke['totalaccess']?></li>
</ul>
