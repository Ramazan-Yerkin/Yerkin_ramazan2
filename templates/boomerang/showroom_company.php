<!DOCTYPE html>
<html>  
<head>
 <?php _widget('head');?>
</head>
<body class="body-wrap <?php _widget('custom_paletteclass'); ?>">

<?php _widget('slidebar'); ?>
<!-- MAIN WRAPPER -->
<div class="">
    <?php _widget('custom_palette');?>
    
    <!-- HEADER -->
    <div id="divHeaderWrapper">
    <header class="header-standard-3"> 
        <?php _widget('header_loginmenu');?>
        <?php _widget('header_mainmenu');?>
    </header>   
    </div>

    <!-- MAIN CONTENT -->
     <section class="slice bg-white bb">
        <div class="wp-section">
            <div id="content-block" class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="wp-block pg-opt">
                            <h2 class="title">{page_title}</h2>
                        </div>
                        <div class="wp-block pg-opt box-content">
                            {page_body}
                            <br style="clear: both;" />
                            <div class="wp-block pg-opt">
                            <h2 class="title">{lang_Locationonmap}</h2>
                            </div>
                            <div id="propertyLocation" style="height: 400px;" class="right-space">
                            </div>
                            <br style="clear: both;" />
                            <?php _widget('center_imagegallery');?>
                            {has_page_documents}
                            <h2>{lang_Filerepository}</h2>
                            <ul>
                            {page_documents}
                            <li>
                                <a href="{url}">{filename}</a>
                            </li>
                            {/page_documents}
                            </ul>
                            {/has_page_documents}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar">
                            <div class="panel panel-default panel-sidebar-1">
                                <div class="panel-heading"><h2>{lang_Overview}</h2></div>
                                <div class=" panel-body" style="padding-bottom:15px;">
                                  <p class="bottom-border"><strong>
                                  {lang_Company}
                                  </strong> <span>{page_title}</span>
                                  <br style="clear: both;" />
                                  </p>
                                  <p class="bottom-border"><strong>
                                  {lang_Address}
                                  </strong> <span>{showroom_data_address}</span>
                                  <br style="clear: both;" />
                                  </p>
                                  <p class="bottom-border"><strong>
                                  {lang_Keywords}
                                  </strong> <span>{page_keywords}</span>
                                  <br style="clear: both;" />
                                  </p>
                                </div>
                            </div>
                             <div class="panel panel-default panel-sidebar-1"  id="form">
                                <div class="panel-heading"><h2>{lang_AskExpert}</h2></div>
                                <form method="post" class="property-form" action="{page_current_url}#form">
                                    <div class="panel-body">
                                          {validation_errors} {form_sent_message}
                                    <!-- The form name must be set so the tags identify it -->
                                    <input type="hidden" name="form" value="contact" />
                                    
                                    <div class="form-group {form_error_firstname}">
                                        <input class="form-control" id="firstname" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                                    </div>
                                    <div class="form-group {form_error_email}">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />
                                    </div>
                                    <div class="form-group {form_error_phone}">
                                        <input class="form-control" id="phone" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                                    </div>
                                    
                                    <div class="form-group {form_error_address}">
                                        <input class="form-control" id="address" name="address" type="text" placeholder="{lang_Address}" value="{form_value_address}" />
                                    </div>
                                    
                                    <div class="form-group  {form_error_message}">
                                        <textarea id="message" name="message" rows="1" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                                    </div>
                                    
                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                <?php
                                    $site_url = site_url();
                                    $urlparts = parse_url($site_url);
                                    $basic_domain = $urlparts['host'];
                                    $terms_url = config_db_item('terms_link');
                                    $urlparts = parse_url($terms_url);
                                    $terms_domain ='';
                                    if(isset($urlparts['host']))
                                        $terms_domain = $urlparts['host'];

                                    if($terms_domain == $basic_domain) {
                                        $terms_url = str_replace('en', $lang_code, $terms_url);
                                    }
                                ?>
                                <div class="control-group" style="padding-bottom: 15px;">
                                  <div class="controls">
                                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                                  <a target="_blank" href="<?php echo $terms_url; ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
                                  </div>
                                </div>
                                <?php endif; ?>
                                



                                <?php if(config_db_item('privacy_link') !== FALSE && sw_count($not_logged)>0): ?>
                                                            <?php

                                $site_url = site_url();
                                $urlparts = parse_url($site_url);
                                $basic_domain = $urlparts['host'];
                                $privacy_url = config_db_item('privacy_link');
                                $urlparts = parse_url($privacy_url);
                                $privacy_domain ='';
                                if(isset($urlparts['host']))
                                    $privacy_domain = $urlparts['host'];

                                if($privacy_domain == $basic_domain) {
                                    $privacy_url = str_replace('en', $lang_code, $privacy_url);
                                }
                            ?>
                                <div class="control-group" style="padding-bottom: 15px;">
                                  <div class="controls">
                                    <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                  <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
                                  </div>
                                </div>
                                <?php endif; ?>
                                    </div> 
                                    <button  class="btn btn-lg btn-block-bm btn-alt btn-icon btn-icon-right btn-envelope" type="submit">
                                        <span>{lang_Send}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER -->
    <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'standard')); ?>
</div>

<?php _widget('custom_javascript');?>
<script>
    $(document).ready(function(){
        
       $("#route_from_button").click(function () { 
            window.open("https://maps.google.hr/maps?saddr="+$("#route_from").val()+"&daddr={showroom_data_address}@{showroom_data_gps}&hl={lang_code}",'_blank');
            return false;
        });
        <?php if(config_db_item('map_version') =='open_street'):?>

        var property_map;
        if($('#propertyLocation').length){
            property_map = L.map('propertyLocation', {
                center: [{showroom_data_gps}],
                zoom: {settings_zoom},
                scrollWheelZoom: scrollWheelEnabled,
            });     
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(property_map);
            var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(property_map);
            var property_marker = L.marker(
                [{showroom_data_gps}],
                {icon: L.divIcon({
                        html: '<img src="assets/img/marker_blue.png">',
                        className: 'open_steet_map_marker',
                        iconSize: [19, 34],
                        popupAnchor: [-5, -45],
                        iconAnchor: [15, 30],
                    })
                }
            ).addTo(property_map);
        
            property_marker.bindPopup("{showroom_data_address}<br />{lang_GPS}: {showroom_data_gps}");
        }

        <?php else:?>
        $('#propertyLocation').gmap3({
         map:{
            options:{
             center: [{showroom_data_gps}],
             zoom: {settings_zoom},
            }
         },
         marker:{
            values:[
                {latLng:[{showroom_data_gps}], options:{icon: "assets/img/marker_blue.png"}, data:"{showroom_data_address}<br />{lang_GPS}: {showroom_data_gps}"},
            ],
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
                  options:{ content: '<div style="width:400px;display:inline;">'+context.data+'</div>'}
                }
              });
            }
          }
        }
         }});
        <?php endif;?>
    
    }); 
    </script>
</body>
</html>