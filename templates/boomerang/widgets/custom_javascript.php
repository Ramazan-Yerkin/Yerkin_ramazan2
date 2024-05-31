<?php 
        if(!empty($settings_css_variant) && !preg_match('/styles.css$/', $settings_css_variant)){
           $_color= substr($settings_css_variant, strrpos($settings_css_variant, 'assets/css/styles_')+strlen('assets/css/styles_') );
           $_color= explode('.', $_color);
           $color= $_color[0].'/';
        }else {
           $color='';
        }
?>

<?php cache_file('big_js_cus.js', 'assets/js/modernizr.custom.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/bootstrap/js/bootstrap.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/bootstrap-select.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/typeahead.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.mousewheel-3.0.6.pack.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.easing.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.metadata.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.hoverup.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.hoverdir.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.stellar.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.placeholder.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/blueimp-gallery.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/boomerang.js'); ?>

<?php cache_file('big_js_cus.js', 'assets/libraries/responsive-mobile-nav/js/jquery.dlmenu.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/responsive-mobile-nav/js/jquery.dlmenu.autofill.js'); ?>

<?php cache_file('big_js_cus.js', 'assets/libraries/ui-kit/js/jquery.powerful-placeholder.min.js'); ?> 
<?php cache_file('big_js_cus.js', 'assets/libraries/ui-kit/js/cusel.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/sky-forms/js/jquery.form.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/sky-forms/js/jquery.validate.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/sky-forms/js/jquery.maskedinput.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/sky-forms/js/jquery.modal.js'); ?>

<?php cache_file('big_js_cus.js', 'assets/libraries/hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/page-scroller/jquery.ui.totop.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/mixitup/jquery.mixitup.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/mixitup/jquery.mixitup.init.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/fancybox/jquery.fancybox.pack.js?v=2.1.5'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/waypoints/waypoints.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/milestone-counter/jquery.countTo.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/easy-pie-chart/js/jquery.easypiechart.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/social-buttons/js/rrssb.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/nouislider/js/jquery.nouislider.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/owl-carousel/owl.carousel.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/bootstrap/js/tooltip.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/libraries/bootstrap/js/popover.js'); ?>

<?php cache_file('big_js_cus.js', 'assets/js/jquery.cookie.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/wp.switcher.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/wp.ga.js'); ?>

<?php cache_file('big_js_cus.js', 'assets/js/jquery.helpers.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.number.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/jquery.h5validate.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/bootstrap-datetimepicker.min.js'); ?>
<?php cache_file('big_js_cus.js', 'assets/js/wp.app.js'); ?>


<!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
<![endif]-->



<!-- jquery.cookiebar -->
<!-- url  http://www.primebox.co.uk/projects/jquery-cookiebar/ -->
<?php if(config_item('cookie_warning_enabled') === TRUE): ?>
<script>
 $('document').ready(function(){
    $.cookieBar({
    message: "<p><?php _l('Accept cookiebar');?></p><br>",
    acceptText: "<?php _l('I Agree');?>",
    /*declineText: "<?php _l('I dont agree');?>",*/
});
}); 

</script>
<?php endif;?>
<!--end jquery.cookiebar -->

<?php if(file_exists(APPPATH.'controllers/admin/swin_reviews.php')): ?>
    <?php cache_file('big_js_cus.js', 'assets/js/ratings/bootstrap-rating-input.min.js'); ?>
<?php endif; ?>
<?php cache_file('big_js_cus.js', NULL, false); ?>

<script>
    $('document').ready(function(){
        if ( ! Modernizr.objectfit && false ) {
          $('.object-fit-container').each(function () {
            var $container = $(this),
                imgUrl = $container.find('img').prop('src');
            if (imgUrl) {
              $container
                .css('background-image', 'url("'+imgUrl+'")')
                .addClass('compat-object-fit');
            }  
          });
        };
    });
var ad_galleries;
var firstSet = false;
var mapRefresh = true;
var loadOnTab = true;
var zoomOnMapSearch = 9;
var clusterConfig = null;
var markerOptions = null;
var mapDisableAutoPan = false;
var mapStyle = [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}];
var rent_inc_id = '55';
var scrollWheelEnabled = false;
var myLocationEnabled = true;
var rectangleSearchEnabled = true;
var mapRefresh = true;
var map_main;
var styles;
var timerMap;
var firstSet = false;
var selectorResults = '.results_conteiner';
var markers = [];
var map = '';
<?php if(config_db_item('map_version') =='open_street'):?>
scrollWheelEnabled = true;
var clusters ='';
clusters = L.markerClusterGroup({spiderfyOnMaxZoom: true, showCoverageOnHover: false, zoomToBoundsOnClick: true});
var jpopup_customOptions =
{
'maxWidth': 'initial',
'width': 'initial',
'className' : 'popupCustom'
};
<?php endif;?>
<?php if(config_db_item('map_version') !='open_street'):?>
var c_mapTypeId = "style1"; 
var c_mapTypeIds = ["style1",
                    google.maps.MapTypeId.ROADMAP,
                    google.maps.MapTypeId.HYBRID];   
<?php endif;?>         
            clusterConfig = {
              radius: 60,
              5: {
                content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
                width: 53,
                height: 52
              },
              20: {
                content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
                width: 56,
                height: 55
              },
              50: {
                content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
                width: 66,
                height: 65
              },
              events: {
                click:function(cluster, event, object) {
                    try {
                        var same_address = true;
                        var adr = '';
                        $.each(object.data.markers, function(item) {
                            
                            if(adr == '')
                                adr = object.data.markers[item].adr;
                            
                            if(adr != object.data.markers[item].adr)
                                same_address = false;
                        });
                        
                        if(same_address)
                        {
                            cluster.main.map.panTo(object.data.latLng);
                            cluster.main.map.setZoom(19);
                        }
                        else
                        {
                            cluster.main.map.panTo(object.data.latLng);
                            cluster.main.map.setZoom(cluster.main.map.getZoom()+1);
                        }
                    }
                    catch(err) {
                        cluster.main.map.panTo(object.data.latLng);
                        cluster.main.map.setZoom(cluster.main.map.getZoom()+1);
                    }
                }
              }
            };

$(document).ready(function() {
            $(".checkbox_am").click((function(){
                var option_id = $(this).attr('option_id');
                
                if($(this).prop('checked'))
                {
                    $("#search_option_"+option_id).prop('checked', true);
                }
                else
                {
                    $("#search_option_"+option_id).prop('checked', false);
                }
            }));
            $(".input_am").focusout((function(){
                var option_id = $(this).attr('option_id');
                $("#search_option_"+option_id).val($(this).val());
            }));
            $(".input_am_from").focusout((function(){
                var option_id = $(this).attr('option_id');
                $("#search_option_"+option_id+"_from").val($(this).val());
            }));
            $(".input_am_to").focusout((function(){
                var option_id = $(this).attr('option_id');
                
                $("#search_option_"+option_id+"_to").val($(this).val());
            }));
            <?php if(empty($_GET['search']) && empty($search_query)): ?>
            $(".checkbox_am, .search-form .advanced-form-part label.checkbox input").prop('checked', false);
            $(".input_am, .input_am_from, .input_am_to, .search-form input[type=text], .search-form select").val('');
            <?php endif; ?>
            $('.search-form select.selectpicker').selectpicker('render');
            $("button.refresh_filters").click(function () { 
                manualSearch(0);
                return false;
            });
            showCounters([]);
        $("#search-save").click(function(){
            manualSearch(0, '#content-block', true);
            return false;
        });
            $('#search_option_smart').typeahead({
                minLength: 1,
                source: function(query, process) {
                    $.post('{typeahead_url}/smart', { q: query, limit: 8 }, function(data) {
                        process(JSON.parse(data));
                    });
                }
            });
            $('.twitter-typeahead input:first-child').attr('style', 'position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1');
            $('#search_option_smart').attr('style', 'position: relative; vertical-align: top;');
            /* Search start */
            $('.menu-onmap li a').click(function () { 
              if(!$(this).parent().hasClass('list-property-button'))
              {
                  $(this).parent().parent().find('li').removeClass("active");
                  $(this).parent().addClass("active");
                  if(loadOnTab) manualSearch(0);
                  return false;
              }
            });
            <?php if(config_item('all_results_default') !== TRUE): ?>
            if($('.menu-onmap li.active').length == 0)
            {
                if(!$('.menu-onmap li:first').hasClass('list-property-button'))
                    $('.menu-onmap li:first').addClass('active');
            }
            <?php else: ?>
            if($('.menu-onmap li.active').length == 0)
            {
                $('.menu-onmap li.all-button').addClass('active');
            }
            <?php endif; ?>
            
            $('#search-start').click(function () { 
              manualSearch(0);
              return false;
            });
            /* Search end */
            <?php $dates_list = ''; if(isset($available_dates) && file_exists(APPPATH.'controllers/admin/booking.php')): ?>
            var dates_list = [];
            <?php foreach($available_dates as $date_format => $unix_format): ?>
            <?php
                $dates_list.='"'.$date_format.'", ';
            ?>
            <?php endforeach; ?>
            <?php
                if($dates_list != '')
                    $dates_list = substr($dates_list, 0, -2);
            ?>dates_list = [<?php echo $dates_list; ?>];
            <?php endif; ?>
            
            /* Date picker */
            var translated_cal = {
    			days: ["{lang_cal_sunday}", "{lang_cal_monday}", "{lang_cal_tuesday}", "{lang_cal_wednesday}", "{lang_cal_thursday}", "{lang_cal_friday}", "{lang_cal_saturday}", "{lang_cal_sunday}"],
    			daysShort: ["{lang_cal_sun}", "{lang_cal_mon}", "{lang_cal_tue}", "{lang_cal_wed}", "{lang_cal_thu}", "{lang_cal_fri}", "{lang_cal_sat}", "{lang_cal_sun}"],
    			daysMin: ["{lang_cal_su}", "{lang_cal_mo}", "{lang_cal_tu}", "{lang_cal_we}", "{lang_cal_th}", "{lang_cal_fr}", "{lang_cal_sa}", "{lang_cal_su}"],
    			months: ["{lang_cal_january}", "{lang_cal_february}", "{lang_cal_march}", "{lang_cal_april}", "{lang_cal_may}", "{lang_cal_june}", "{lang_cal_july}", "{lang_cal_august}", "{lang_cal_september}", "{lang_cal_october}", "{lang_cal_november}", "{lang_cal_december}"],
    			monthsShort: ["{lang_cal_jan}", "{lang_cal_feb}", "{lang_cal_mar}", "{lang_cal_apr}", "{lang_cal_may}", "{lang_cal_jun}", "{lang_cal_jul}", "{lang_cal_aug}", "{lang_cal_sep}", "{lang_cal_oct}", "{lang_cal_nov}", "{lang_cal_dec}"]
    		};
            if(typeof(DPGlobal) != 'undefined'){
                DPGlobal.dates = translated_cal;
            }
            if($(selectorResults).length <= 0)
                selectorResults = '.wrap-content .container';
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            $('.datetimepicker_standard').datepicker().on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });
            var checkin = $('#datetimepicker1').datepicker({
                onRender: function(date) {
                    var dd = date.getDate();
                    var mm = date.getMonth()+1;/*January is 0!`*/
                    var yyyy = date.getFullYear();
                    if(dd<10){dd='0'+dd}
                    if(mm<10){mm='0'+mm}
                    var today_formated = yyyy+'-'+mm+'-'+dd;
                    if(date.valueOf() < now.valueOf()) /*Just for performance*/
                    {
                        return 'disabled';
                    }
                    <?php if(file_exists(APPPATH.'controllers/admin/booking.php')): ?>
                    else if(dates_list.indexOf(today_formated )>= 0)
                    {
                        return '';
                    }
                    
                    return 'disabled red';
                    <?php else: ?>
                    return '';
                    <?php endif;?>
                }
            }).on('changeDate', function(ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date);
                    newDate.setDate(newDate.getDate() + 7);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('#datetimepicker2')[0].focus();
            }).data('datepicker');
                var checkout = $('#datetimepicker2').datepicker({
                onRender: function(date) {
                    var dd = date.getDate();
                    var mm = date.getMonth()+1;
                    var yyyy = date.getFullYear();
                    if(dd<10){dd='0'+dd}
                    if(mm<10){mm='0'+mm}
                    var today_formated = yyyy+'-'+mm+'-'+dd;
                    if(date.valueOf() <= checkin.date.valueOf())
                    {
                        return 'disabled';
                    }                    
                    <?php if(file_exists(APPPATH.'controllers/admin/booking.php')): ?>
                    else if(dates_list.indexOf(today_formated )>= 0)
                    {
                        return '';
                    }
                    
                    return 'disabled red';
                    <?php else: ?>
                    return '';
                    <?php endif;?>
            }
            }).on('changeDate', function(ev) {
                checkout.hide();
            }).data('datepicker');
        <?php if(file_exists(APPPATH.'controllers/admin/booking.php')): ?>
            /* Search booking form */
            var checkin_booking = $('#booking_date_from').datepicker({
                place: function(){
                    var element = this.component ? this.component : this.element;
                    element.after(this.picker);
		},   
                onRender: function(date) {
                    var dd = date.getDate();
                    var mm = date.getMonth()+1;
                    var yyyy = date.getFullYear();
                    if(dd<10){dd='0'+dd}
                    if(mm<10){mm='0'+mm}
                    var today_formated = yyyy+'-'+mm+'-'+dd;
                    if(date.valueOf() < now.valueOf())
                    {
                        return 'disabled';
                    }
                    return '';
                }
            }).on('changeDate', function(ev) {
                if (ev.date.valueOf() > checkout_booking.date.valueOf()) {
                    var newDate = new Date(ev.date);
                    newDate.setDate(newDate.getDate() + 7);
                    checkout_booking.setValue(newDate);
                }
                checkin_booking.hide();
                $('#booking_date_to')[0].focus();
            }).data('datepicker');
                var checkout_booking = $('#booking_date_to').datepicker({
                place: function(){
                    var element = this.component ? this.component : this.element;
                    element.after(this.picker);
		},   
                onRender: function(date) {
                    var dd = date.getDate();
                    var mm = date.getMonth()+1;
                    var yyyy = date.getFullYear();
                    if(dd<10){dd='0'+dd;}
                    if(mm<10){mm='0'+mm;}
                    var today_formated = yyyy+'-'+mm+'-'+dd;
                    if(date.valueOf() <= checkin_booking.date.valueOf())
                    {
                        return 'disabled';
                    }
                    
                    return '';
            }
            }).on('changeDate', function(ev) {
                checkout_booking.hide();
            }).data('datepicker');
            <?php endif;?>
            
            $('a.available.selectable').click(function(){
                $('#datetimepicker1').val($(this).attr('ref'));
                $('#datetimepicker2').val($(this).attr('ref_to'));
                $('div.property-form form input:first').focus();
                
                var nowTemp = new Date($(this).attr('ref'));
                var date_from = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                
                checkin.setValue(date_from);
                date_from.setDate(date_from.getDate() + 7);
                checkout.setValue(date_from);
            });
            
            /* Date picker end */
            {has_extra_js}
            loadjQueryUpload();
            
            $('.zoom-button').bind("click touchstart", function()
            {
                var myLinks = new Array();
                var current = $(this).attr('href');
                var curIndex = 0;
                
                $('.files-list-u .zoom-button').each(function (i) {
                    var img_href = $(this).attr('href');
                    myLinks[i] = img_href;
                    if(current == img_href)
                        curIndex = i;
                });
    
                options = {index: curIndex}
                
                blueimp.Gallery(myLinks, options);
                
                return false;
            });
            
            /* [Edit property] */
            <?php if(config_db_item('map_version') =='open_street'):?>
            var edit_map_marker;
            var edit_map
            if($('#mapsAddress').length){
                if($('#inputGps').length && $('#inputGps').val() != '')
                {
                    savedGpsData = $('#inputGps').val().split(", ");

                    edit_map = L.map('mapsAddress', {
                        center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        zoom: {settings_zoom}+1,
                    });     
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(edit_map);
                    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(edit_map);
                    edit_map_marker = L.marker(
                        [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        {draggable: true}
                    ).addTo(edit_map);

                    edit_map_marker.on('dragend', function(event){
                        var marker = event.target;
                        var location = marker.getLatLng();
                        var lat = location.lat;
                        var lon = location.lng;
                        $('#inputGps').val(lat+', '+lon);
                      });

                    firstSet = true;
                }
                else
                {
                    edit_map = L.map('mapsAddress', {
                        center: [{settings_gps}],
                        zoom: {settings_zoom}+1,
                    });     
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(edit_map);
                    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(edit_map);
                    edit_map_marker = L.marker(
                        [{settings_gps}],
                        {draggable: true}
                    ).addTo(edit_map);

                    edit_map_marker.on('dragend', function(event){
                        var marker = event.target;
                        var location = marker.getLatLng();
                        var lat = location.lat;
                        var lon = location.lng;
                        $('#inputGps').val(lat+', '+lon);
                    });
                    firstSet = true;
                }
                $('#inputAddress').keyup(function (e) {
                clearTimeout(timerMap);
                timerMap = setTimeout(function () {
                    $.get('https://nominatim.openstreetmap.org/search?format=json&q='+$('#inputAddress').val(), function(data){
                        if(data.length && typeof data[0]) {
                            edit_map_marker.setLatLng([data[0].lat, data[0].lon]).update(); 
                            edit_map.panTo(new L.LatLng(data[0].lat, data[0].lon));
                            $('#inputGps').val(data[0].lat+', '+data[0].lon);
                        } else {
                            ShowStatus.show('<?php echo str_replace("'", "\'", lang_check('Address not found!')); ?>');
                            return;
                        }
                    });
                }, 2000);
                
            });
            }
            <?php else:?>
            if($('#inputGps').length && $('#inputGps').val() != '')
            {
                savedGpsData = $('#inputGps').val().split(", ");
                $("#mapsAddress").gmap3({
                    map:{
                      options:{
                        center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        zoom: 14
                      }
                    },
                    marker:{
                    values:[
                      {latLng:[parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])]},
                    ],
                    options:{
                      draggable: true
                    },
                    events:{
                        dragend: function(marker){
                          if($("#inputAddress").attr("readonly"))
                          {
                            alert('<?php _l('Location change disabled'); ?>');
                            return false;
                          }
                          else
                          {
                            $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                          }
                        }
                  }}});
                firstSet = true;
            }
            else
            {
                $("#mapsAddress").gmap3({
                    map:{
                      options:{
                        center: [{settings_gps}],
                        zoom: 12
                      },
                    },
                marker:{
                    values:[
                      {latLng:[{settings_gps}]},
                    ],
                    options:{
                      draggable: true
                    },
                    events:{
                        dragend: function(marker){
                          if($("#inputAddress").attr("readonly"))
                          {
                            alert('<?php _l('Location change disabled'); ?>');
                            return false;
                          }
                          else
                          {
                            $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                          }
                        }
                  }}
                  });
                  firstSet = true;
            }
                
            $('#inputAddress').keyup(function (e) {
                clearTimeout(timerMap);
                timerMap = setTimeout(function () {
                    $("#mapsAddress").gmap3({
                      getlatlng:{
                        address:  $('#inputAddress').val(),
                        callback: function(results){
                          if ( !results ){
                            ShowStatus.show('<?php echo str_replace("'", "\'", lang_check('Address not found!')); ?>');
                            return;
                          } 
                          
                            if(firstSet){
                                $(this).gmap3({
                                    clear: {
                                      name:["marker"],
                                      last: true
                                    }
                                });
                            }
                          $(this).gmap3({
                            marker:{
                              latLng:results[0].geometry.location,
                               options: {
                                  id:'searchMarker',
                                  draggable: true
                              },
                              events: {
                                dragend: function(marker){
                                  if($("#inputAddress").attr("readonly"))
                                  {
                                    alert('<?php _l('Location change disabled'); ?>');
                                    return false;
                                  }
                                  else
                                  {
                                    $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                                  }
                                }
                              }
                            }
                          });
                          $(this).gmap3('get').setCenter( results[0].geometry.location );
                          
                          $('#inputGps').val(results[0].geometry.location.lat()+', '+results[0].geometry.location.lng());
                          
                          firstSet = true;
                        }
                      }
                    });
                }, 2000);
                
            });
            <?php endif;?>
            /* [/Edit property] */
            
            {/has_extra_js}
     reloadElements();
});

        function manualSearch(v_pagenum, scroll_enabled, onlysave, color)
        {
            if (typeof scroll_enabled === 'undefined') scroll_enabled = "#content-block";
            if (typeof onlysave === 'undefined') onlysave = false;
            if (typeof color === 'undefined') color = false;
            var v_order = $('.selectpicker-small').val();
            var v_view = $('.view-type.active').attr('ref');          
            var data = {
                order: v_order,
                view: v_view,
                page_num: v_pagenum
            };
            if(color) {
                data['color'] = color;
            }
            if($('#booking_date_from').length > 0)
            {
                if($('#booking_date_from').val() != '')
                    data['v_booking_date_from'] = $('#booking_date_from').val();
            }
            if($('#booking_date_to').length > 0)
            {
                if($('#booking_date_to').val() != '')
                    data['v_booking_date_to'] = $('#booking_date_to').val();
            }
            $('.search-form  input:not(.skip), .search-form  select:not(.skip)').each(function (i) {
                if($(this).attr('type') == 'checkbox')
                {
                    if ($(this)[0].checked)
                    {
                        data['v_'+$(this).attr('id')] = $(this).val();
                    }
                }
                else if($(this).attr('type') == 'radio')
                {   
                    if ($(this)[0].checked)
                    {
                        data['v_'+$(this).attr('name')] = $(this).attr('rel');
                    }
                }
                else if($(this).hasClass('tree-input'))
                {
                    if($(this).val() != '')
                    {
                        var tre_id_split = $(this).attr('id').split('_');
                        if(data['v_search_option_'+tre_id_split[2]] == undefined)
                            data['v_search_option_'+tre_id_split[2]] = '';
                        
                        data['v_search_option_'+tre_id_split[2]]+= $(this).find("option:selected").text()+' - ';
                    }
                }
                else
                {
                    data['v_'+$(this).attr('id')] = $(this).val();
                }
            });
            if($('#tags-filters').length > 0)
            {
                var tags_html = '';
                $('.search-form form input, .search-form form select').each(function (i) {
                    if($(this).attr('type') == 'checkbox')
                    {
                        if ($(this).attr('checked'))
                        {
                            data['v_'+$(this).attr('id')] = $(this).val();
                            
                            var option_name = '';
                            var attr = $(this).attr('value').substring(4);
                            if(typeof attr !== 'undefined' && attr !== false)
                            {
                                option_name = attr;
                            }
                            
                            if($(this).val() != '')
                                tags_html+='<button class="btn btn-small btn-warning filter-tag ck" rel="'+$(this).attr('id')+'" type="button"><span class="icon-remove icon-white"></span> '+option_name+'</button>&nbsp;';
                        
                        }
                    }
                    else if($(this).hasClass('tree-input'))
                    {
                    }
                    else
                    {
                        data['v_'+$(this).attr('id')] = $(this).val();
                        
                        var option_name = '';
                        var attr = $(this).attr('placeholder');
                        if(typeof attr !== 'undefined' && attr !== false)
                        {
                            option_name = attr+': ';
                        }
                        if($(this).val() != '')
                            tags_html+='<button class="btn btn-small btn-primary filter-tag" rel="'+$(this).attr('id')+'" type="button"><span class="icon-remove icon-white"></span> '+option_name+$(this).val()+'</button>&nbsp;';
                    }
                });
                
                if(typeof data['v_search_option_4'] != 'undefined')
                if(data['v_search_option_4'].length > 0)
                    tags_html+='<button class="btn btn-small btn-danger filter-tag" rel="4" type="button"><span class="icon-remove icon-white"></span> '+data['v_search_option_4']+'</button>&nbsp;';
                
                if(tags_html != '')
                {
                    $("#tags-filters").css('display', 'block');
                    
                    $("#tags-filters").html(tags_html);
                    
                    $(".filter-tag").click(function(){
                        var m_id = $(this).attr('rel').substring(14);
                        
                        if($(this).hasClass('ck'))
                        {
                            $('#'+$(this).attr('rel')).prop('checked', false);
                        }
                        else
                        {
                            $("input.id_"+m_id).val('');
                            $("input#"+$(this).attr('rel')).val('');
                            
                            $("select#"+$(this).attr('rel')).val('');
                            $("select.id_"+m_id).val('');
                            $("select#"+$(this).attr('rel')+".selectpicker").selectpicker('render');
                            $("select.id_"+m_id+".selectpicker").selectpicker('render');
                        }
                        
                        $(this).remove();
                        
                        
                        if($(this).attr('rel') == '4')
                        {
                            $('#search_option_4 .active').removeClass('active');
                        }
                        
                        if($(this).hasClass('ck'))
                        {
                            $("input.checkbox_am[option_id='"+m_id+"']").prop('checked', false);
                        }
                        
                        manualSearch(0);
                    });
                }
                else
                {
                    $("#tags-filters").css('display', 'none');
                }
            }
            
            $("#ajax-indicator-1").show();
            
            if(onlysave == true)
            {
                $.post("{api_private_url}/save_search/{lang_code}", data, 
                       function(data){
                    ShowStatus.show(data.message);
                                    
                    $("#ajax-indicator-1").hide();
                });
                return;
            }
            
 <?php if(config_item('enable_ajax_url') == true): ?>
            if(support_history_api() == true)
            {
                if(data.page_num)
                    data.page_num = data.page_num.replace("#content", "");
                    
                /* fix for search_category_21 select */
                var new_data = {};
                $.each(data, function(i,v){
                    if(i.indexOf('category') != -1) {
                        if($('#'+i.substr(2)).length && v){
                            var sel = $('#'+i.substr(2));
                            $.each(v, function(c_i,c_v){
                                let option_id = sel.find('option[value="'+c_v+'"]').attr('data-input_id');
                                if(option_id) {
                                    new_data['v_search_option_'+option_id]=c_v;
                                }
                            });
                        }
                    } else {
                        if(v!="")
                            new_data[i] = v;
                    }
                });
            	var json_string=JSON.stringify(new_data);
                
                json_string = json_string.replace("&amp;", "%26"); 
                
                if(window.history && history.pushState)
                    history.pushState(data, '', '{page_current_url}?search='+json_string);
            }
            <?php endif; ?>
                
             /* color_path */
                if(data['color']=='default'){
                    var _color ='default';
                } else if( data['color']) {
                    var _color = data['color']+'/';
                } else {
                    
                    var _color = '';
                    if($('.color-switch a').hasClass('active')){
                        _color = $('.color-switch a.active').attr('color')+'/';
                    }
                }
            /* end color_path */
            <?php if(config_item('search_listing_page')&&$page_id!=config_item('search_listing_page')): ?>
                
                if( data['v_search_radius']==0)
                    data['v_search_radius'] ='';
                <?php
                $CI =& get_instance();
                $CI->load->model('page_m');
                $_page = $CI->page_m->get_lang(config_item('search_listing_page'),false,$lang_id);
                $_title=$_page->{'navigation_title_'.$lang_id};
                
                ?>
                window.location.href='<?php echo site_url($lang_code.'/'.config_item('search_listing_page').'/'.url_title_cro($_title, '-', TRUE))?>?search='+JSON.stringify(data);
                return false;
                
            <?php endif;?>     
                
            showCounters(data);  
            $.post("{ajax_load_url}/"+v_pagenum, data,
             function(data){
                if(mapRefresh && $('#wrap-map').length > 0)
                {
                <?php if(config_db_item('map_version') =='open_street'):?>
                    if(map=="init") {       
                        map = L.map('wrap-map', {
                            <?php if(config_item('custom_map_center') === FALSE): ?>
                            center: [{all_estates_center}],
                            <?php else: ?>
                            center: [<?php echo config_item('custom_map_center'); ?>],
                            <?php endif; ?>
                            zoom: {settings_zoom}+1,
                            scrollWheelZoom: scrollWheelEnabled,
                            dragging: !L.Browser.mobile,
                            tap: !L.Browser.mobile
                        });     
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(map);
                        map.addLayer(clusters);
                    }
                                
                    for (var i = 0; i < markers.length; i++) {
                        clusters.removeLayer(markers[i]);
                    }
                    markers = [];
                    if(data.results.length > 0)
                    {
                        $.each(data.results, function(index, listing) {
                            if(typeof listing.latLng == 'undefined'){
                                return;
                            }
                            var marker = L.marker(
                                [listing.latLng[0], listing.latLng[1]],
                                {icon: L.divIcon({
                                        html: '<img src="'+listing.options.icon+'">',
                                        className: 'open_steet_map_marker '+data.results[index].options.cssclass,
                                        iconSize: [31, 46],
                                        popupAnchor: [95, -10],
                                        iconAnchor: [15, 30],
                                    })
                                }
                            );/*.addTo(map)*/;

                            marker.bindPopup(listing.data, jpopup_customOptions);
                            clusters.addLayer(marker);
                            markers.push(marker);
                        });

                        <?php if(config_db_item('map_fixed_position') == FALSE): ?>
                        /* set center */
                        if(markers.length){
                            var limits_center = [];
                            for (var i in markers) {
                                if(typeof markers[i]['_latlng'] == 'undefined') continue;
                                var latLngs = [ markers[i].getLatLng() ];
                                limits_center.push(latLngs)
                            };
                            var bounds = L.latLngBounds(limits_center);
                            <?php if(config_db_item('auto_set_zoom_disabled') != FALSE): ?>
                                map.setView(bounds.getCenter());
                           <?php else:?>
                                map.fitBounds(bounds);
                           <?php endif;?>
                        }
                        <?php endif;?>
                    }
                    <?php else:?>
                    $("#wrap-map").gmap3({
                        clear: {
                            name:["marker"]
                        }
                    });
                   
                    if(data.results.length > 0)
                    {
                 
                 var markers = new Array();
                 
                    $.each(data.results, function( index, listing ) {
                        
                    if( typeof listing.latLng !== 'undefined'){
                    
                     var icon =  listing.options.icon;
                    markers.push( {
                        latLng:[listing.latLng[0], listing.latLng[1]],
                        data:{
                            content:listing.data
                        }, 
                        options:{
                            icon: icon
                        },
                    });
                }
                });
                    $("#wrap-map").gmap3({
                               map:{
                        options:{
                            center: {lat:data.results_center[0], lng: data.results_center[1]},
                        }
                    },
                    marker:{
                        values:markers,
                        cluster: clusterConfig,	
                        events:{
                            <?php echo map_event(); ?>: function(marker, event, context){
                                $(this).gmap3(
                                {
                                    clear:"overlay"
                                },

                                {
                                        overlay:{
                                        latLng: marker.getPosition(),
                                        options:{
                                            content:   context.data.content,
                                            offset: {
                                                x:-38,
                                                y:-163
                                            }
                    } } }); }}} });
                    }
                    <?php endif;?>
                }
                /* add row count */
                if($('#count_row').length>0){
                     $('#count_row').html(data.total_rows);
                 }
                /* end add row count */
                $(selectorResults).html(data.print);
                reloadElements();
                $("#ajax-indicator-1").hide();
                if(scroll_enabled && $(scroll_enabled).length){
                    if($('.navbar.mega-nav').length && $('.navbar.mega-nav').hasClass('affix') )
                        $(document).scrollTop( $(scroll_enabled).offset().top-70 );
                    else
                        $(document).scrollTop( $(scroll_enabled).offset().top-150 );
                } else if(scroll_enabled && $('.results_conteiner').length){
                    if($('.navbar.mega-nav').length && $('.navbar.mega-nav').hasClass('affix') )
                        $(document).scrollTop( $('.results_conteiner').offset().top-70 );
                    else
                        $(document).scrollTop( $('.results_conteiner').offset().top-150 );
                }
            }, "json");
            return false;
        }
        
    $.fn.startLoading = function(data){
    };
    
    $.fn.endLoading = function(data){
        <?php if(config_item('app_type') == 'demo'):?>
            ShowStatus.show('<?php echo str_replace("'", "\'", lang('Data editing disabled in demo')); ?>');
        <?php else:?>
        <?php endif;?>
    };
        function reloadElements()
        {          
            $('.selectpicker-small').change(function() {
                manualSearch(0);
                return false;
            });

            $('.view-type').click(function () { 
              $(this).parent().find('.view-type').removeClass("active");
              $(this).addClass("active");
              manualSearch(0);
              return false;
            });
            
            $('.pagination.properties a').click(function () { 
              var page_num = $(this).attr('href');
              var n = page_num.lastIndexOf("/"); 
              page_num = page_num.substr(n+1);
              
              manualSearch(page_num);
              return false;
            });
            
            $('.pagination.news a').click(function () { 
                var page_num = $(this).attr('href');
                var n = page_num.lastIndexOf("/"); 
                page_num = page_num.substr(n+1);
                
                $.post($(this).attr('href'), {search: $('#search_showroom').val()}, function(data){
                    $('.property_content_position').html(data.print);
                    
                    reloadElements();
                }, "json");
                
                return false;
            });

        }
    {has_extra_js}
    function loadjQueryUpload()
    {
        $('form.fileupload').each(function () {
            $(this).fileupload({
            <?php if(config_item('app_type') != 'demo'):?>
            autoUpload: true,
            <?php endif;?>
            previewMaxWidth: 160,
            previewMaxHeight: 120,
            uploadTemplateId: null,
            downloadTemplateId: null,
            uploadTemplate: function (o) {
                var rows = $();
                $.each(o.files, function (index, file) {
                    var row = $('<div> </div>');
                    rows = rows.add(row);
                });
                return rows;
            },
            downloadTemplate: function (o) {
                var rows = $();
                $.each(o.files, function (index, file) {
                    var row = $('<li class="img-rounded template-download fade">' +
                        '<div class="preview"><span class="fade"></span></div>' +
                        '<div class="filename"><code>'+file.short_name+'</code></div>'+
                        '<div class="options-container">' +
                        (file.zoom_enabled?
                            '<a data-gallery="gallery" class="zoom-button btn btn-mini btn-success" download="'+file.name+'"><i class="icon-search icon-white"></i></a>'
                            : '<a target="_blank" class="btn btn-mini btn-success" download="'+file.name+'"><i class="icon-search icon-white"></i></a>') +
                        ' <span class="delete"><button class="btn btn-mini btn-danger" data-type="'+file.delete_type+'" data-url="'+file.delete_url+'"><i class="icon-trash icon-white"></i></button>' +
                        ' <input type="checkbox" value="1" name="delete"></span>' +
                        '</div>' +
                        (file.error ? '<div class="error"></div>' : '')+'</li>');
                    
                    var added=false;
                    
                    if (file.error) {
                        ShowStatus.show(file.error);
                    } else {
                        added=true;
                        row.find('.name a').text(file.name);
                        if (file.thumbnail_url) {
                            row.find('.preview').html('<img class="img-rounded" alt="'+file.name+'" data-src="'+file.thumbnail_url+'" src="'+file.thumbnail_url+'">');  
                        }
                        row.find('a').prop('href', file.url);
                        row.find('a').prop('title', file.name);
                        row.find('.delete button')
                            .attr('data-type', file.delete_type)
                            .attr('data-url', file.delete_url);
                    }
                    if(added)
                        rows = rows.add(row);
                });
                
                return rows;
            },
            destroyed: function (e, data) {
                $.fn.endLoading();
                <?php if(config_item('app_type') != 'demo'):?>
                if(data.success)
                {
                }
                else
                {
                    ShowStatus.show('<?php echo lang_check('Unsuccessful, possible permission problems or file not exists'); ?>');
                }
                <?php endif;?>
                return false;
            },
            <?php if(config_item('app_type') == 'demo'):?>
            added: function (e, data) {
                $.fn.endLoading();
                return false;
            },
            <?php endif;?>
            finished: function (e, data) {
                $('.zoom-button').unbind('click touchstart');
                $('.zoom-button').bind("click touchstart", function()
                {
                    var myLinks = new Array();
                    var current = $(this).attr('href');
                    var curIndex = 0;
                    $('.files-list-u .zoom-button').each(function (i) {
                        var img_href = $(this).attr('href');
                        myLinks[i] = img_href;
                        if(current == img_href)
                            curIndex = i;
                    });
            
                    options = {index: curIndex}
            
                    blueimp.Gallery(myLinks, options);
                    
                    return false;
                });
            },
            dropZone: $(this)
        });
        });       
        $("ul.files").each(function (i) {
            $(this).sortable({
                update: saveFilesOrder
            });
            $(this).disableSelection();
        });
    }
    function filesOrderToArray(container)
    {
        var data = {};
        container.find('li').each(function (i) {
            var filename = $(this).find('.options-container a:first').attr('download');
            data[i+1] = filename;
        });
        return data;
    }
    function saveFilesOrder( event, ui )
    {
        var filesOrder = filesOrderToArray($(this));
        var pageId = $(this).parent().parent().parent().attr('id').substring(11);
        var modelName = $(this).parent().parent().parent().attr('rel');
        
        $.fn.startLoading();
		$.post('<?php echo site_url('files/order'); ?>/'+pageId+'/'+modelName, 
        { 'page_id': pageId, 'order': filesOrder }, 
        function(data){
            $.fn.endLoading();
		}, "json");
    }
    
    {/has_extra_js}
        
    function showCounters(data_params)
    {
        $.post('<?php echo site_url('api/get_all_counters/'.$lang_id.'/1')?>', data_params, function(data){
            $("input.checkbox_am").parent().find('span').html('');
            $.each(data.counters, function( index, obj ) {
              var m_id = obj.option_id;
              if(!$("input.checkbox_am[option_id='"+m_id+"']").is(":checked"))
              $("input.checkbox_am[option_id='"+m_id+"']").parent().find('span').html('&nbsp('+obj.count+')');
            });

        }, "json");
    }
        /* [START] NumericFields */
        $(function() {
            <?php if(config_db_item('swiss_number_format') == TRUE): ?>
            $('input.DECIMAL').number( true, 2, '.', '\'' );
            $('input.INTEGER').number( true, 0, '.', '\'' );
            <?php else: ?>
            $('input.DECIMAL').number( true, 2 );
            $('input.INTEGER').number( true, 0 );
            <?php endif; ?>
        });
    
        /* [END] NumericFields */
        /* [START] ValidateFields */
        $(function() {
            $('form.form-estate')
                .h5Validate({});
                $("form.form-estate").on("formValidated", function()
                {
                    if($('form.form-estate .ui-state-error').length) {
                        var offsetTop = $('form.form-estate .ui-state-error').first().offset().top-70;
                        console.log(offsetTop);
                        
                       if($('.navbar.navbar-fixed.affix-top').length)
                            offsetTop -=80;
                        $(window).scrollTop(offsetTop);
                    }
                });
            });
        
        /* [END] ValidateFields */
</script>

    <script>
/* share popup */
$('document').ready(function(){
    $('.btn-share-fb').click(function(e){
        e = e || window.event;
        e.preventDefault();
        var width = 600;
        var height = 300;
        window.open( 'https://www.facebook.com/sharer/sharer.php?u='+$(this).attr("data-url")+'&title='+$(this).attr("data-title")+'&display=popup&ref=plugin&src=like', '', 'width=' + width + ',height=' + height + ',left=' + (($(window).innerWidth() - width)/2) + ',top=' + (($(window).innerHeight() - height)/2) );
    });
    
    $('.btn-share-tw').click(function(e){
        e = e || window.event;
        e.preventDefault();
        var width = 600;
        var height = 450;
        window.open( 'https://twitter.com/home?status='+$(this).attr("data-title")+'%20'+$(this).attr("data-url"), '', 'width=' + width + ',height=' + height + ',left=' + (($(window).innerWidth() - width)/2) + ',top=' + (($(window).innerHeight() - height)/2) );
    });

});
/* end share popup */
$('document').ready(function(){
    reloadPaginationUniversal();
 });
            function reloadPaginationUniversal()
        {
            $('.pagination-ajax-results a').click(function () { 
                var page_num = $(this).attr('href');
                var n = page_num.lastIndexOf("/"); 
                page_num = page_num.substr(n+1);
                
                var results_dom_id = '#ajax_results';
                
                $.post($(this).attr('href'), {'page_num':page_num}, function(data){
                    $(results_dom_id).html(data.print);
                    
                    reloadPaginationUniversal();
                }, "json");
                
                return false;
            });
        }

    $(document).ready(function(){
        if($('.results_conteiner').length>1) {
            $('.results_conteiner').not(':eq('+($('.results_conteiner').length-1)+')').removeClass('results_conteiner').hide();
            $('#content-block').attr('id','');

            if(!$('#section-treefieldresult .results_conteiner').length) {
                $('#section-treefieldresult').hide();
            }
        }
        $('.field_datepicker').each(function(){
            $(this).datepicker({
                place: function(){
                        var element = this.component ? this.component : this.element;
                        element.after(this.picker);
                    },   
                pickTime: false
            });
        });
    });

<?php if(config_db_item('agent_masking_enabled') == TRUE && isset($property_id) && isset($agent_id)): ?>
                /* visible */
                $('.hidden-agent-details,.hidden-file-details').css('display','block');
                
                $('.popup-with-form').magnificPopup({
                	type: 'inline',
                	preloader: false,
                	focus: '#name',
                                    
                	callbacks: {
                		beforeOpen: function() {
                			if($(window).width() < 700) {
                				this.st.focus = false;
                			} else {
                				this.st.focus = '#name';
                			}
                		}
                	}
                });
                
                $('#unhide-agent-mask').click(function(){
                    var data = $('#test-form').serializeArray();
                    data.push({name: 'property_id', value: "<?php echo $property_id; ?>"});
                    data.push({name: 'agent_id', value: "<?php echo $agent_id; ?>"});
                    
                    $('#ajax-indicator-masking').css('display', 'inline');
                    
                    $.post("<?php echo site_url('frontend/maskingsubmit/'.$lang_code); ?>", data,
                    function(data){
                        if(data=='successfully')
                        {
                            $('.popup-with-form').css('display', 'none');
                            $.magnificPopup.instance.close();
                        }
                        else
                        {
                            $('.alert.hidden').css('display', 'block');
                            $('.alert.hidden').css('visibility', 'visible');
                            $('#popup-form-validation').html(data);
                        }
                        $('#ajax-indicator-masking').css('display', 'none');
                    });
                    return false;
                });
            <?php endif; ?>
</script>
<?php
    $output ='';
    $CI =& get_instance();
    $template_name = $CI->data['settings']['template'];
    $cache_time_sec = 604800; /* one week */
    $cache_file_name = FCPATH.'templates/'.$template_name.'/assets/cache/_generate_dependentfields.js';
    if(file_exists(FCPATH.'templates/'.$template_name.'/widgets/_generate_dependentfields_js.php'))
        if(file_exists($cache_file_name) && filemtime($cache_file_name) > time()-$cache_time_sec)
        {
        } else {
            $output = $CI->load->view($template_name.'/widgets/_generate_dependentfields_js.php', false, true);
            require_once APPPATH."helpers/min-js.php";
            $jSqueeze = new JSqueeze();
            $output = $jSqueeze->squeeze($output, true, false);
            file_put_contents(FCPATH.'templates/'.$template_name.'/assets/cache/_generate_dependentfields.js', $output);
        }

    echo '<script src="assets/cache/_generate_dependentfields.js?"></script>';
?>
