<?php 
    $db->bindMore(array("type"=>"product","shows"=>1,"highlight"=>1));
    $product_list = $db->query("select id,slug,name_$lang from #_cate_list where shows=:shows and highlight=:highlight and type=:type order by number,id desc");
?>

<?php foreach ($product_list as $key => $value) :
    $db->bindMore(array("type"=>"product","id_list"=>$value['id']));
    $product = $db->query("select id from #_product where shows=1 and highlight=1 and id_list=:id_list and type=:type order by number,id desc");
    if(count($product)): ?>
        <div class="showproduct mt-4" data-idl="<?= $value['id'] ?>">
            <div class="container">
                <div class="title-style-1"><h2><?= $value['name_'.$lang] ?></h2></div>
                <div class="mt-4">
                    <div id="danhmuc_<?= $value['id'] ?>" rel="<?= $value['id'] ?>"></div>
                </div>
            </div>
        </div>
<?php endif; endforeach ?>