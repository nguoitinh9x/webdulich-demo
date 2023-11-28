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

    $idl = $_POST["idl"];

    if(isset($idl)){
        $where =" where shows=1 and highlight=1 and type='project' and id_list = $idl ";
    }
  
    $page_num = 2;
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
        $paging->text_sql = "select name_$lang,slug,photo from #_post $where order by number,id desc";
        $result_pag_data = $paging->GetResult();
        $message = "";
        $paging->data = "" . $message . "";
    }

?>

<div class="row" data-idl="<?=$idl?>">
    <?php if($paging->num_row==0): echo '<div class="alert alert-danger w-100" role="alert">'._updating.'</div>';else:
        foreach ($result_pag_data as $value): ?>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="items">
                    <div class="img">
                        <a class="imghv d-block" href="du-an/<?=$value['slug']?>" title="<?=$value["name_$lang"]?>">
                            <img src="<?=_upload_post_l.'380x270x1/'.$value['photo']?>" alt="<?=$value["name_$lang"]?>"/>
                        </a>
                    </div>
                    <div class="details">
                        <h3><?=$value["name_$lang"]?></h3>
                        <p><?=$value["description_$lang"]?></p>
                    </div>
                </div>
            </div>
        <?php endforeach?>
    <?php endif?>

    <div class="col-12 clearfix">
        <?php if($paging->num_row > $page_num){echo $paging->Load();}?>
    </div>
</div>


