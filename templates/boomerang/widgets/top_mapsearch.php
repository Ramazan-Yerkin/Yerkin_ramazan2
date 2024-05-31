<?php
/*
Widget-title: Map with search
Widget-preview-image: /assets/img/widgets_preview/top_map.jpg
*/
?>

<script>
    var marks=new Array();
    var _map;
    $(document).ready(function(){
        
    <?php if(config_db_item('map_version') =='open_street'):?>
    if($('#wrap-map').length){
        map = L.map('wrap-map', {
            <?php if(config_item('custom_map_center') === FALSE): ?>
            center: [{all_estates_center}],
            <?php else: ?>
            center: [<?php echo config_item('custom_map_center'); ?>],
            <?php endif; ?>
            zoom: {settings_zoom}+2,
            scrollWheelZoom: scrollWheelEnabled,
            dragging: !L.Browser.mobile,
            tap: !L.Browser.mobile
        });     
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(map);
        
        <?php  if(!empty($all_estates))foreach($all_estates as $item): ?>
            <?php
                if(!isset($item['gps']))break;
                if(empty($item['gps']))continue;
            ?>
            sw_os_generare_marker('<?php _che($item['icon'])?>',[<?php _che($item['gps']); ?>],"<?php echo _generate_popup($item, true); ?>");
        <?php endforeach; ?>
        map.addLayer(clusters);
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
    function sw_os_generare_marker(icon,gps,content) {
        var marker = L.marker(
            gps,
            {icon: L.divIcon({
                    html: '<img src="'+icon+'">',
                    className: 'open_steet_map_marker',
                    iconSize: [31, 46],
                    popupAnchor: [95, -10],
                    iconAnchor: [15, 30],
                })
            }
        )
        marker.bindPopup(content, jpopup_customOptions);
        clusters.addLayer(marker);
        markers.push(marker);
    }
   <?php else:?>    
       _map= $("#wrap-map").gmap3({
         map:{
            options:{
             <?php if(config_item('custom_map_center') === FALSE && isset($all_estates_center)): ?>
             center: [{all_estates_center}],
             <?php elseif(config_item('custom_map_center')): ?>
             center: [<?php echo config_item('custom_map_center'); ?>],
             <?php endif; ?>
             zoom: {settings_zoom},
             scrollwheel: scrollWheelEnabled,
             mapTypeId: c_mapTypeId,
             mapTypeControlOptions: {
               mapTypeIds: c_mapTypeIds
             }
            }
         },
        styledmaptype:{
          id: "style1",
          options:{
            name: "<?php echo lang_check('CustomMap'); ?>"
          },
          styles: mapStyle
        },
         marker:{
            values:[
             <?php if(isset($all_estates))foreach($all_estates as $key=>$estate): if(!empty($estate['gps'])): ?>
                {latLng:[<?php echo _ch($estate['gps']);?>], adr:"<?php echo _ch($estate['address']);?>", options:{icon: "<?php _che($estate['icon'])?>"}, data:"<?php echo _generate_popup($estate, true); ?>"},
            <?php endif; endforeach; ?>
            ],
            cluster: clusterConfig,
            options: markerOptions,
            
        events:{
          <?php echo map_event(); ?>: function(marker, event, context){
              $(this).gmap3("get").setCenter(marker.getPosition())
              $(this).gmap3(
                        {
                            clear:"overlay",
                    center: marker.getPosition()
                        },

                        {
                            overlay:{
                                latLng: marker.getPosition(),
                                options:{
                                    content:   context.data,
                                    offset: {
                                        x:-38,
                                        y:-163
                                    }
                                }
                                
                            }
                        });
          },
          mouseout: function(){
          }
        }}});
       /* init_gmap_searchbox();*/
    <?php endif;?>
    });    
</script>

<section class="slice no-padding bb resize-block save-form" style="border:0;">
        <div class="wp-section">
            <div class="container-fluid no-padding resize-block-map">
                <div class="row-fluid">
                    <div class="">
                        <!-- JumboTron -->
                        <div class="jumbotron">
                            <div class="jumbotron-left jumbotron-map" id="wrap-map"  >
                            </div>
                            <div class="jumbotron-right">
                                <!-- FIND property list WIDGET -->
                                <div class="panel panel-base no-margin">
                                    <form class="form-base search-form" >
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="panel-heading panel-heading-lg clearfix form-field">
                                                    <div class="form-group form-group-lg field_select">
                                                        <input id="search_option_quick" type="text" class="form-control noavtoWidth" placeholder="<?php echo lang_check('Quick search');?>" value="{search_query}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class=""><?php _che(${'options_name_2'}); ?></label>
                                                        <select id="search_option_2" class="form-control select_styled base no-padding">
                                                            <?php _che(${'options_values_2'}); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class=""><?php _che(${'options_name_4'}); ?></label>
                                                        <select id="search_option_4" class="form-control select_styled base no-padding">
                                                            <?php _che(${'options_values_4'}); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group search_option_smart-select">
                                                <input id="search_option_smart" type="text" class="form-control input-lg" value='<?php _che($search_query); ?>' placeholder="{lang_CityorCounty}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class="">{lang_Fromprice}</label>
                                                        <select id="search_option_36_from" name="search_option_36_from" class="form-control select_styled base no-padding">
                                                            <option value="0">-</option>
                                                            <option value="2000">$2000</option>
                                                            <option value="4000">$4000</option>
                                                            <option value="5000">$5000</option>
                                                            <option value="6000">$6000</option>
                                                            <option value="7000">$7000</option>
                                                            <option value="10000">$10000</option>
                                                            <option value="15000">$15000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class="">{lang_Toprice}</label>
                                                        <select id="search_option_36_to" name="search_option_36_to" class="form-control select_styled base no-padding">
                                                            <option value="0">-</option>
                                                            <option value="20000">$20000</option>
                                                            <option value="25000">$25000</option>
                                                            <option value="30000">$30000</option>
                                                            <option value="40000">$40000</option>
                                                            <option value="50000">$50000</option>
                                                            <option value="60000">$60000</option>
                                                            <option value="70000">$70000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="advanced-form-part hidden">
                                            <div class="form-row-space"></div>
                                            <!--
                                            <input id="search_option_36_from" type="text" class="span3 mPrice" placeholder="{lang_Fromprice} ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_from'); ?>" />
                                            <input id="search_option_36_to" type="text" class="span3 xPrice" placeholder="{lang_Toprice} ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_to'); ?>" />
                                            -->
                                            <input id="search_option_19" type="text" class="span3 Bathrooms" placeholder="{options_name_19}" value="<?php echo search_value(19); ?>" />
                                            <input id="search_option_20" type="text" class="span3" placeholder="{options_name_20}" value="<?php echo search_value(20); ?>" />
                                            <div class="form-row-space"></div>
                                            <?php if(file_exists(APPPATH.'controllers/admin/booking.php')):?>
                                            <input id="booking_date_from" type="text" class="span3 mPrice" placeholder="{lang_Fromdate}" value="<?php echo search_value('date_from'); ?>" />
                                            <input id="booking_date_to" type="text" class="span3 xPrice" placeholder="{lang_Todate}" value="<?php echo search_value('date_to'); ?>" />
                                            <div class="form-row-space"></div>
                                            <?php endif; ?>
                                            <?php if(config_db_item('search_energy_efficient_enabled') === TRUE): ?>
                                            <select id="search_option_59_to" class="span3 selectpicker nomargin">
                                                <option value="">{options_name_59}</option>
                                                <option value="50">A</option>
                                                <option value="90">B</option>
                                                <option value="150">C</option>
                                                <option value="230">D</option>
                                                <option value="330">E</option>
                                                <option value="450">F</option>
                                                <option value="999999">G</option>
                                            </select>
                                            <div class="form-row-space"></div>
                                            <?php endif; ?>
                                            <label class="checkbox">
                                            <input id="search_option_11" type="checkbox" class="span1" value="true{options_name_11}" <?php echo search_value('11', 'checked'); ?>/>{options_name_11}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_22" type="checkbox" class="span1" value="true{options_name_22}" <?php echo search_value('22', 'checked'); ?>/>{options_name_22}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_25" type="checkbox" class="span1" value="true{options_name_25}" <?php echo search_value('25', 'checked'); ?>/>{options_name_25}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_27" type="checkbox" class="span1" value="true{options_name_27}" <?php echo search_value('27', 'checked'); ?>/>{options_name_27}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_28" type="checkbox" class="span1" value="true{options_name_28}" <?php echo search_value('28', 'checked'); ?>/>{options_name_28}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_29" type="checkbox" class="span1" value="true{options_name_29}" <?php echo search_value('29', 'checked'); ?>/>{options_name_29}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_32" type="checkbox" class="span1" value="true{options_name_32}" <?php echo search_value('32', 'checked'); ?>/>{options_name_32}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_30" type="checkbox" class="span1" value="true{options_name_30}" <?php echo search_value('30', 'checked'); ?>/>{options_name_30}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_33" type="checkbox" class="span1" value="true{options_name_33}" <?php echo search_value('33', 'checked'); ?>/>{options_name_33}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_23" type="checkbox" class="span1" value="true{options_name_23}" <?php echo search_value('23', 'checked'); ?>/>{options_name_23}
                                            </label>
                                        </div>

                                        <button  id="search-start" type="submit" class="btn btn-xl btn-block-bm btn-alt btn-icon btn-icon-right btn-icon-go btn-square">
                                            <span>{lang_Search}</span>
                                        </button>
                                    </form>
                                </div>
                                <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')): ?>
                                    <button id="search-save" type="button" class="btn btn-info"><i class="icon-bookmark"></i>{lang_SaveResearch}</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>