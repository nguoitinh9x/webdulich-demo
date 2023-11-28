<?php
    /**
     * Application Main Page That Will Serve All Requests
     *
     * @package PRO CODE CIP Framework
     * @author  code@cipmedia.vn
     * @version 1.0.0
     * @license http://cipmedia.vn
     */
    defined( 'ROOT' ) ?:  define( 'ROOT', dirname(dirname(__DIR__)));
    defined( 'AJAX' ) ?:  define( 'AJAX', "AJAX" );
    require_once ROOT . '/Library/autoload.php';

    $id_list = $_POST["idl"];
    $id_cat = $_POST["idc"];

    if(isset($id_list)){
        $where ="where shows=1 and highlight=1 and type='tour' and id_list ='".$id_list."' ";
    }
  
    $page_num = 8;
    if(isset($_POST["page"])){
        $paging = new \Library\PagingAjax();
        $paging->class_pagination = "ajax_pagination";
        $paging->class_active = "active";
        $paging->class_inactive = "inactive";
        $paging->class_go_button = "go_button";
        $paging->class_text_total = "total";
        $paging->class_txt_goto = "txt_go_button";
        $paging->per_page = $page_num;
        $paging->page = $_POST["page"];
        $paging->text_sql = "select name_$lang,slug,photo,description_$lang,price,oldprice,datein from #_post $where order by number,id desc";
        $result_pag_data = $paging->GetResult();
        $message = "";
        $paging->data = "" . $message . "";
    }
?>

<?php if($paging->num_row==0): echo '<div class="alert alert-danger w-100" role="alert">'._updating.'</div>'; else: ?>
    <div class="row">
        <?php foreach ($result_pag_data as $value): ?>
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                <div class="items">
                    <div class="img">
                        <a class="imghv d-block" href="<?= 'tour/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>">
                            <img src="<?= _upload_post_l.'220x180x1/'.$value['photo'] ?>" alt="<?= $value["name_$lang"] ?>"/>
                        </a>
                    </div>
                    <div class="details">
                        <h3><a href="<?= 'tour/'.$value['slug'] ?>" title="<?= $value["name_$lang"] ?>"><?= $value["name_$lang"] ?></a></h3>
                        <p class="des"><strong>Hành trình: </strong><?= $func->catchuoi($value["description_$lang"], 140) ?></p>
                        <div class="row">
                            <div class="col-8">
                                <p class="price"><?= $func->giamoicu($value['price'], $value['oldprice']) ?></p>
                                <p class="datein"><strong>Khởi hành: </strong><?= date('d/m/Y', strtotime( $value['datein'] )) ?></p>
                            </div>
                            <div class="col-4 pl-0 d-flex align-items-center">
                                <a class="booktour" href="<?= 'tour/'.$value['slug'] ?>" title="Đặt tour">ĐẶT TOUR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<div class="col-12 clearfix">
    <?php if($paging->num_row > $page_num){echo $paging->Load();}?>
</div>


