<?php
  $db->bindMore(array("shows"=>1,"type"=>"chinhanh"));
  $chinhanh  =  $db->query("select * from #_title where shows=:shows and type=:type order by number,id desc");
  $thongtin_defaut = json_decode($chinhanh[0]['thongtin'],true);

?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD5Mevy_rl8U4ZyBB8i5jmdxfvb9Cg5UoE&sensor=false"></script>
<script type="text/javascript">
var map;
var markers = [];
var lastinfowindow;
var locIndex;

//Credit: MDN
if ( !Array.prototype.forEach ) {
  Array.prototype.forEach = function(fn, scope) {
    for(var i = 0, len = this.length; i < len; ++i) {
      fn.call(scope, this[i], i, this);
    }
  }
}

/*
This is the data as a JS array. It could be generated by CF of course. This
drives the map and the div on the side.
*/
var data = [
<?php for($i=0;$i<count($chinhanh);$i++){
    $thongtin = json_decode($chinhanh[$i]['thongtin'],true);
    $toado = explode(',',$thongtin['toado']);
    if($toado[0]!='' && $toado[1]!=''){
?>
{toadox:<?=$toado[0]?>,toadoy:<?=$toado[1]?>,address:'<?=$thongtin['diachi'][$lang]?>',email:'<?=$thongtin['email']?>',dienthoai:'<?=$thongtin['dienthoai']?>',title:'<?=$chinhanh[$i]['ten_'.$lang]?>',type:'lab'}<?php if(($i+1)!=count($chinhanh)){ echo ',';}?>
<?php } } ?>
];

//A utility function that translates a given type to an icon
function initialize_multi() {
    var latlng = new google.maps.LatLng(<?=$thongtin_defaut['toado']?>);
    var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas_bt"),myOptions);
    
    geocoder = new google.maps.Geocoder();
    
    data.forEach(function(mapData,idx) {
        geocoder.geocode( { 'address': mapData.address}, function(results, status) {
                    latlngset = new google.maps.LatLng(mapData.toadox,mapData.toadoy)
                   var marker = new google.maps.Marker({
                        map: map, 
                        position: latlngset,
                        title: mapData.title,
                        icon:'images/icon/micon.png'
                    });
                    var contentHtml = "<div style='width:300px;'><h3>"+mapData.title+"</h3><p><?=_diachi?> : "+mapData.address+"</p><p>Email : "+mapData.email+"</p><p><?=_dienthoai?>: "+mapData.dienthoai+"</p></div>";
                    var infowindow = new google.maps.InfoWindow({
                        content: contentHtml
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map,marker);
                    });
                    marker.locid = idx+1;
                    marker.infowindow = infowindow;
                    markers[markers.length] = marker;

                    var sideHtml = '<p class="loc" data-locid="'+marker.locid+'">'+mapData.title+'</p>';
                        $("#locs").append(sideHtml); 

               
            });

    });

    $(document).on("click",".loc",function() {
        var thisloc = $(this).data("locid");
        for(var i=0; i<markers.length; i++) {
            if(markers[i].locid == thisloc) {
                //get the latlong
                if(lastinfowindow instanceof google.maps.InfoWindow) lastinfowindow.close();
                map.panTo(markers[i].getPosition());
                markers[i].infowindow.open(map, markers[i]);
                lastinfowindow = markers[i].infowindow;
            }
        }
    });
}
$(document).ready(function() {
    initialize_multi();
});

</script>
<div class="multimap">
    <div id="locs"></div>
    <div id="map_bottom">
        <div id="map_canvas_bt"></div>
    </div>
</div>