<script type="text/javascript">
$(document).ready(function() {
  $('.SearchTable select').change(function(event) {
      var wrap = $(this);
      timkiem(wrap);
  });
  $('.timkiem button').click(function(event) {
     var wrap = $('.timkiem input');
     timkiem(wrap);
  });
  $("#id_cat").change(function(event) {
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "Ajax/ajax.php",
      data:{
        act: 'getPro',
        id: id
      },
      success:function(data){
        $('#id_product').html(data);
      }
    });
  });


  $("#id_product").change(function(event) {
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "Ajax/ajax.php",
      data:{
        act: 'getDetail',
        id: id
      },
      success:function(data){
        $('#load_tbl').html(data);

      }
    });
  });


  $("#timnap").click(function(event) {
    var id = $('#id_product').val();
    var noidung = $('#noidung').val();
    $.ajax({
      type: "POST",
      url: "Ajax/ajax.php",
      data:{
        act: 'savedetail',
        noidung: noidung,
        id: id
      },
      success:function(data){
        $('#load_tbl').html(data);
        $('#noidung').val('');
      }
    });
  });

  // $('#load_tbl').click(function(event) {
  //   /* Act on the event */
  //   var link = $(this).html();
  //   alert(link);
  //   //window.open('view-source:'+link, '_blank');
  // });

});
</script>

<form action="" method="post" accept-charset="utf-8">
  <div><?=$func->get_main_list()?></div>
  <div><?=$func->get_main_cat()?></div>
  <div class="">
    <select id="id_product" name="id_product" class="main_select select_danhmuc">
        <option value="">Chọn sản phẩm</option></select>
  </div>

  <div id="load_tbl"></div>
  <textarea style="width:1000px; height:500px" name="noidung" id="noidung"></textarea>
  <button id="timnap" type="button">nap vao data</button>
</form>
<div class="paging"><?=$paging?></div>