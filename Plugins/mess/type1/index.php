<div class="supportico clearfix">
  <div class="blockcontent clearfix">
    <div class="item">
      <a target="_blank" href="tel: <?=$Setting['hotline']?>"><i class="ico-phone ico"></i></a>
      <span class="text"><a target="_blank" href="tel: <?=$Setting['hotline']?>">Gọi điện</a></span>
    </div>
    <div class="item">
      <a target="_blank" href="sms: <?=$Setting['hotline']?>"><i class="ico-sms ico"></i></a>
      <span class="text"><a target="_blank" href="sms: <?=$Setting['hotline']?>">Nhắn tin</a></span>
    </div>
    <div class="item">
      <a target="_blank" href="http://zalo.me/<?=  str_replace(' ', '', $Setting['hotline']) ?>"><i class="ico-zalo ico"></i></a>
      <span class="text"><a target="_blank" href="http://zalo.me/<?=  str_replace(' ', '', $Setting['hotline']) ?>">Chat Zalo</a></span>
    </div>
    <div class="item">
      <a target="_blank" href="<?=$Setting['facebook']?>"><i class="ico-fbmessage ico"></i></a>
      <span class="text"><a target="_blank" href="<?=$Setting['facebook']?>">Chat Facebook</a></span>
    </div>
  </div>
</div>