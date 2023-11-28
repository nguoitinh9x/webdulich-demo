<?php
    $quytrinh = $db->query("select number,name_vi,description_vi,photo,color from #_post where shows=1 and type='quytrinh' order by number,datecreate desc");
?>

<div class="container my-5">
    <div class="quytrinh">
        <div class="title-style-1"><h2>Quy trình thu mua</h2></div>
        <ul class="owl-quytrinh ul">
        <?php foreach ($quytrinh as $key => $value) {?>
            <li>
            <div class="details" style="background-color: <?=$value['color']?>;">
                <span>B<?=$value['number']?></span>
                <h3><?=$value['name_vi']?></h3>
                <p><?=$value['description_vi']?></p>
            </div>
            <div class="canvas">
                <div class="img">
                    <img src="<?=_upload_post_l.$value['photo']?>" alt="<?=$value['name_vi']?>" style="border-color:<?=$value['color']?>;">
                </div>
                <?php if ($key<count($quytrinh) - 1): ?>
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="149px" height="106px" viewBox="0 0 149 106" enable-background="new 0 0 149 106" xml:space="preserve">
                <path fill="<?=$value['color']?>" d="M146.106,63.188c-1.222,0-2.269,0.747-2.711,1.809H81.973v0.309c-0.164-21.246-16.891-38.597-37.879-39.797
                V5.654c1.07-0.439,1.825-1.488,1.825-2.716C45.919,1.315,44.604,0,42.981,0s-2.938,1.315-2.938,2.938
                c0,1.281,0.825,2.359,1.969,2.761v21.758h1.04v0.011c20.465,0.676,36.909,17.524,36.909,38.151c0,21.054-17.13,38.183-38.184,38.183
                c-20.683,0-37.566-16.534-38.155-37.077c1.29-0.31,2.252-1.464,2.252-2.849c0-1.622-1.315-2.938-2.938-2.938S0,62.253,0,63.875
                c0,1.137,0.653,2.112,1.599,2.601c0.459,21.771,18.3,39.345,40.18,39.345c22.065,0,40.027-17.869,40.194-39.895v0.887h61.285
                c0.312,1.289,1.465,2.25,2.849,2.25c1.622,0,2.938-1.315,2.938-2.938S147.729,63.188,146.106,63.188z"/>
                </svg>
                <?php else: ?>
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="149px" height="106px" viewBox="0 0 149 106" enable-background="new 0 0 149 106" xml:space="preserve">
                <path fill="<?=$value['color']?>" d="M44.094,25.507V5.654c1.07-0.439,1.825-1.488,1.825-2.716C45.919,1.315,44.604,0,42.981,0
                s-2.938,1.315-2.938,2.938c0,1.281,0.825,2.359,1.969,2.761v21.758h1.04v0.011c20.465,0.676,36.909,17.524,36.909,38.151
                c0,21.054-17.13,38.183-38.184,38.183c-20.683,0-37.566-16.534-38.155-37.077c1.29-0.31,2.252-1.464,2.252-2.849
                c0-1.622-1.315-2.938-2.938-2.938S0,62.253,0,63.875c0,1.137,0.653,2.112,1.599,2.601c0.459,21.771,18.3,39.345,40.18,39.345
                c22.168,0,40.202-18.035,40.202-40.202C81.98,44.229,65.186,26.714,44.094,25.507z"/>
                </svg>
                <?php endif ?>
            </div>
            </li>
        <?php } ?>
        </ul>
    </div>
</div>