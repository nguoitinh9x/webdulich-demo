<ul class="listul">
	<li class="d-flex align-items-center"><span><i class="fas fa-map-marker-alt"></i></span> <?= $Setting["address_$lang"] ?></li>
	<li><span><i class="fas fa-phone-volume"></i></span> <?= $Setting['hotline']?> <?= $Setting['phone']!='' ? ' - '.$Setting['phone'] : '' ?></li>
	<li><span><i class="far fa-envelope"></i></span> <?= $Setting['email'] ?></li>
	<li><span><i class="fas fa-globe"></i></span> <?= $Setting['website'] ?></li>
</ul>
