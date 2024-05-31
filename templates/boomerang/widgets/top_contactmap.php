<?php
/*
Widget-title: Contact map
Widget-preview-image: /assets/img/widgets_preview/top_contactmap.jpg
 */
?>

<section class="slice no-padding">
    <div id="mapCanvas" class="map-canvas no-margin"></div>
</section>

<script>
var map;
<?php

$color='';
if($this->session->userdata('color'))
    $color=$this->session->userdata('color').'/';
elseif(isset($settings_css_varian) && !empty ($settings_css_varian))
    $color=$settings_css_varian.'/';

?>
    
<?php if(config_db_item('map_version') =='open_street'):?>
var contact_map;
$(document).ready(function(){
if($('#mapCanvas').length){
    contact_map = L.map('mapCanvas', {
        center: [{settings_gps}],
        zoom: 12,
        scrollWheelZoom: scrollWheelEnabled,
    });     
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(contact_map);
    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(contact_map);
    var property_marker = L.marker(
        [{settings_gps}],
        {icon: L.divIcon({
                html: '<img src="assets/img/markers/<?php echo $color;?>house.png">',
                className: 'open_steet_map_marker',
                iconSize: [19, 34],
                popupAnchor: [0, -33],
                iconAnchor: [15, 30],
            })
        }
    ).addTo(contact_map);

    property_marker.bindPopup("{settings_address},<br />{lang_GPS}: {settings_gps}");
}
})
<?php else:?> 
function initialize() {
  var myLatlng = new google.maps.LatLng({settings_gps});
  var mapOptions = {
    zoom: {settings_zoom},
	scrollwheel: false,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
	  animation: google.maps.Animation.DROP,
      title: '',
       icon: 'assets/img/markers/<?php echo $color;?>house.png'
                    
  });
  
  var contentString = '<div class="info-window-content"><h2><?php echo str_replace("'", "\'", $settings_websitetitle) ;?></h2>'+
					  '<p>{lang_Address}: <?php echo str_replace("'", "\'", $settings_address) ;?></p></div>';
					  
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
  
  
  /* additional refreah marker color, when color template changed */
  
  $('.color-switch.color-template a').click(function(){
      marker.setMap(null);
      var color = $(this).attr('color');
      var markerNew = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP,
            title: '',
            icon: 'assets/img/markers/'+color+'/house.png'
        });
    
    var contentString = '<div class="info-window-content"><h2><?php echo str_replace("'", "\'", $settings_websitetitle) ;?></h2>'+
					  '<p>{lang_Address}: <?php echo str_replace("'", "\'", $settings_address) ;?></p></div>';
        google.maps.event.addListener(markerNew, 'click', function() {
            infowindow.open(map,markerNew);
          });

  })
  
  $('#design-reset').click(function(){
      marker.setMap(null);
      var markerNew = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP,
            title: '',
            icon: 'assets/img/markers/house.png'
        });
    
    var contentString = '<div class="info-window-content"><h2><?php echo str_replace("'", "\'", $settings_websitetitle) ;?></h2>'+
					  '<p>{lang_Address}:<?php echo str_replace("'", "\'", $settings_address) ;?></p></div>';
    google.maps.event.addListener(markerNew, 'click', function() {
        infowindow.open(map,markerNew);
    });

  })
  /* end additional refreah marker color */
}

google.maps.event.addDomListener(window, 'load', initialize);

$('a[data-type="gmap"]').on('shown.bs.tab', function (e) {
  initialize();
})
 <?php endif;?>

</script>