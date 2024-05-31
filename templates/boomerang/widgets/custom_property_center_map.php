<div class="section-title-wr">
<h3 id="hNearProperties" class="section-title left">{lang_Propertylocation}</h3>
</div>

<?php if(!empty($estate_data_gps)): ?>
<div class="places_select" style="display: none;">
    <a class="btn btn-large" type="button" rel="hospital,health"><img src="assets/img/places_icons/hospital.png" /> {lang_Health}</a>
    <a class="btn btn-large" type="button" rel="park"><img src="assets/img/places_icons/park.png" /> {lang_Park}</a>
    <a class="btn btn-large" type="button" rel="atm,bank"><img src="assets/img/places_icons/atm.png" /> {lang_ATMBank}</a>
    <a class="btn btn-large" type="button" rel="gas_station"><img src="assets/img/places_icons/petrol.png" /> {lang_PetrolPump}</a>
    <a class="btn btn-large" type="button" rel="food,bar,cafe,restourant"><img src="assets/img/places_icons/restourant.png" /> {lang_Restourant}</a>
    <a class="btn btn-large" type="button" rel="store"><img src="assets/img/places_icons/store.png" /> {lang_Store}</a>
</div>
<div class="map-property">
    <div id="propertyLocation" style="height: 300px;"></div><!-- /#map-property -->
</div><!-- /.map-property -->
    <script>
 
  <?php if(config_db_item('map_version') =='open_street'):?>
    $(document).ready(function(){
        var property_map;
        if($('#propertyLocation').length){
            property_map = L.map('propertyLocation', {
                center: [{estate_data_gps}],
                zoom: {settings_zoom}+6,
                scrollWheelZoom: scrollWheelEnabled,
            });     
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(property_map);
            var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(property_map);
            var property_marker = L.marker(
                [{estate_data_gps}],
                {icon: L.divIcon({
                        html: '<img src="{estate_data_icon}">',
                        className: 'open_steet_map_marker',
                        iconSize: [31, 46],
                        popupAnchor: [0, -33],
                        iconAnchor: [15, 30],
                    })
                }
            ).addTo(property_map);
        
            property_marker.bindPopup("{estate_data_address}<br />{lang_GPS}: {estate_data_gps}");
        }
    })
   <?php else:?>
 (function(){
    var IMG_FOLDER = "assets/js/dpejes";
    var map;
    $(document).ready(function(){

var map;
        map = $('#propertyLocation').gmap3({
            get: { name:"map" },
         map:{
            options:{
             center: [{estate_data_gps}],
             zoom: {settings_zoom}+6,
             scrollwheel: false
            }
         },
         marker:{
              latLng:[{estate_data_gps}], 
                data:"<?php echo str_replace('"', '\"', $estate_data_address) ;?><br />{lang_GPS}: {estate_data_gps}",
         events:{
          mouseover: function(marker, event, context){
            var map = $(this).gmap3("get"),
              infowindow = $(this).gmap3({get:{name:"infowindow"}});
            if (infowindow){
              infowindow.open(map, marker);
              infowindow.setContent('<div style="width:400px;display:inline;">'+context.data+'</div>');
            } else {
              $(this).gmap3({
                infowindow:{
                  anchor:marker,
                  options:{disableAutoPan: mapDisableAutoPan, content: '<div style="width:400px;display:inline;">'+context.data+'</div>'}
                }
              });
            }
          }
        }
         }});
 <?php if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/js/places.js')): ?>       
        if (typeof swplaces_init_directions == 'function')
        {
            $(".places_select a").click(function(){
                init_places($(this).attr('rel'), $(this).find('img').attr('src'));
            });
            
            var selected_place_type = 4;
            
            swplaces_init_directions();
            directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});

            map_propertyLoc = $("#propertyLocation").gmap3({
                  get: { name:"map" }
              });   

            directionsDisplay.setMap(map_propertyLoc);
            init_places($(".places_select a:eq("+selected_place_type+")").attr('rel'), $(".places_select a:eq("+selected_place_type+") img").attr('src'));
        
        }
    <?php endif;?>
        
    }); 
     <?php if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/js/places.js')): ?>  
    var map_propertyLoc;
    var markers = [];
    var generic_icon;
    
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var placesService;

    function init_places(places_types, icon) {
        var pyrmont = new google.maps.LatLng({estate_data_gps});

        setAllMap_near(null);
        
        generic_icon = icon;

        map_propertyLoc = $("#propertyLocation").gmap3({
            get: { name:"map" }
        });    
        
        var places_type_array = places_types.split(','); 
        
        var request = {
            location: pyrmont,
            radius: 2000,
            types: places_type_array
        };
        
        infowindow = new google.maps.InfoWindow();
        placesService = new google.maps.places.PlacesService(map_propertyLoc);
        placesService.nearbySearch(request, callback);

    }

    function callback(results, status) {
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
          createMarker(results[i]);
        }
      }
    }
    
    function setAllMap_near(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    function calcRoute(source_place, dest_place) {
      var selectedMode = 'WALKING';
      var request = {
          origin: source_place,
          destination: dest_place,
          travelMode: google.maps.TravelMode[selectedMode]
      };
      
      directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        }
      });
    }
    
    function createMarker(place) {
      var placeLoc = place.geometry.location;
      var propertyLocation = new google.maps.LatLng({estate_data_gps});
      
        if(place.icon.indexOf("generic") > -1)
        {
            place.icon = generic_icon;
        }
      
        var image = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

      var marker = new google.maps.Marker({
        map: map_propertyLoc,
        icon: image,
        position: place.geometry.location
      });
      
      markers.push(marker);
      
      var distanceKm = (calcDistance(propertyLocation, placeLoc)*1.2).toFixed(2);
      var walkingTime = parseInt((distanceKm/5)*60+0.5);

      google.maps.event.addListener(marker, 'click', function() {
        
            /*drawing route*/
            calcRoute(propertyLocation, placeLoc);
        
        /* Fetch place details*/
        placesService.getDetails({ placeId: place.place_id }, function(placeDetails, statusDetails){
            

            
            /*open popup infowindow*/
            infowindow.setContent(place.name+'<br />{lang_Distance}: '+distanceKm+'{lang_Km}'+
                                  '<br />{lang_WalkingTime}: '+walkingTime+'{lang_Min}'+
                                  '<br /><a target="_blank" href="'+placeDetails.url+'">{lang_Details}</a>');
            infowindow.open(map_propertyLoc, marker);
        });

      });
    }
    
  /*calculates distance between two points*/
    function calcDistance(p1, p2){
      return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
    }
    <?php endif;?>
 })()  
 
<?php endif;?>    
    </script>
<?php else: ?>

<p class="alert alert-success"><?php _l('Not available'); ?></p>

<?php endif;?>

