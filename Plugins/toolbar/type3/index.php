<?php
$id_fanpage = explode("com/", $Setting['facebook']);
?> 

<div class="ppocta-ft-fix">
    <div id="messengerButton"> <a href="//fb.com/msg/<?= $id_fanpage[1] ?>" target="_blank" class="ui-link"><i></i></a> </div>
    <div id="zaloButton"> <a href="//zalo.me/<?= preg_replace('/[^0-9]/','', $Setting['zalo'] )?>" target="_blank" class="ui-link"><i></i></a> </div>
    <a id="registerNowButton" href="sms:<?= preg_replace('/[^0-9]/','', $Setting['hotline'] )?>" class="ui-link"><i></i></a>
    <div id="callNowButton"> <a href="tel:<?= preg_replace('/[^0-9]/','', $Setting['hotline'] )?>" class="ui-link"><i></i></a> <a href="tel:<?= preg_replace('/[^0-9]/','', $Setting['hotline'] )?>" class="txt ui-link"><span>Gọi ngay</span></a> </div>
</div>