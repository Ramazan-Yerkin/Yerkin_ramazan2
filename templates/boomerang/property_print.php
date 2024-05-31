<!DOCTYPE html>
<html lang="{lang_code}">
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<title>{page_title}</title>
<meta name="description" content="{page_description}" />
<meta name="keywords" content="{page_keywords}" />

<meta name="author" content="" />
<link rel="shortcut icon" href="assets/img/favicon.png" type="image/png" />

<!-- Essential styles -->
<link rel="stylesheet" href="assets/libraries/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/bootstrap-select.css" type="text/css">
<link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css"> 
<link rel="stylesheet" href="assets/libraries/fancybox/jquery.fancybox.css?v=2.1.5" media="screen"> 

<!-- Boomerang styles -->

<?php
// Define selected CSS file
if(empty($settings_css_variant))
{
    $settings_css_variant = 'assets/css/styles.css';
}
else
{
    $pos = strrpos($settings_css_variant, "assets/css/global-");
    $settings_css_variant = substr($settings_css_variant, $pos);
}
echo '<link rel="stylesheet" type="text/css" href="'.$settings_css_variant.'" media="screen" id="wpStylesheet">';
?>
<link rel="stylesheet" href="assets/css/boomerang.css" type="text/css">
<link rel="stylesheet" href="assets/css/custom.css" type="text/css">

<!-- Assets -->
<link rel="stylesheet" href="assets/libraries/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assets/libraries/owl-carousel/owl.theme.css">
<link rel="stylesheet" href="assets/libraries/sky-forms/css/sky-forms.css">    
<!--[if lt IE 9]>
    <link rel="stylesheet" href="assets/boomerang/assets/sky-forms/css/sky-forms-ie8.css">
<![endif]-->

<link href="assets/css/blueimp-gallery.min.css" rel="stylesheet" media="screen">

<!-- Required JS -->
<script src="assets/js/jquery.js"></script>

<!-- JS GMAP3  -->

<?php load_map_api(config_db_item('map_version'), $lang_code);?>

<?php if(config_db_item('map_version') !='open_street'):?>
<script src='assets/js/gmap3/gmap3.min.js'></script>
<?php endif;?>

<!-- fileupload -->
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fileupload-ui.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fileupload-ui-noscript.css">
<script type="text/javascript" src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/load-image.js"></script>
<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script> <!-- jQuery UI -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="assets/js/fileupload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="assets/js/fileupload/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="assets/js/fileupload/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="assets/js/fileupload/jquery.fileupload-ui.js"></script>

<!-- end fileupload -->
<!-- cleditor -->
<link href="assets/css/jquery.cleditor.css" rel="stylesheet">
<script src="assets/js/jquery.cleditor.min.js"></script>
<!-- END cleditor -->

<!-- jquery.cookiebar -->
<!-- url  http://www.primebox.co.uk/projects/jquery-cookiebar/ -->
<script src="assets/js/jquery.cookiebar.js"></script>
<link href="assets/css/jquery.cookiebar.css" rel="stylesheet">
<!--end jquery.cookiebar -->
  
<!-- magnific-popup -->
<!-- url  https://plugins.jquery.com/magnific-popup/ -->
<?php if(config_item('report_property_enabled') == TRUE): ?>
<?php cache_file('big_js.js', 'assets/libraries/magnific-popup/jquery.magnific-popup.js'); ?>
<?php cache_file('big_css2.css', 'assets/libraries/magnific-popup/magnific-popup.css'); ?>
<?php endif;?>
<!--end magnific-popup -->
<link rel="stylesheet" href="assets/css/print.css"  media="print"/>
<style type="text/css">
  
  

  @media screen {

  }

  @media print {
    .print_hidden{
        display:none;
    }
  }
  
          @media screen {

        }

        @media print {
          .print_hidden{
              display:none;
          }
          
          #google_my_location,
          .popup-with-form-report,
          .route_suggestion,
          .favorite {
            display:none !important;
          }
          
          .property-map {
              max-height:inherit; 
          }
          
         a:after {content:" " !important; }
         .widget {
            margin-bottom: 0;
        }
    }
    
        .widget {
          page-break-inside: avoid;
      }
</style>
    
    <script>
    $(document).ready(function(){
    <?php if(config_db_item('map_version') =='open_street'):?>
        var property_map;
        if($('#propertyLocation').length){
            property_map = L.map('propertyLocation', {
                center: [{estate_data_gps}],
                zoom: {settings_zoom}+6,
                scrollWheelZoom: false,
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
                        popupAnchor: [1, -45],
                        iconAnchor: [15, 45],
                    })
                }
            ).addTo(property_map);
        
            property_marker.bindPopup("{estate_data_address}<br />{lang_GPS}: {estate_data_gps}");
        }

    <?php else:?>
        $('#propertyLocation').gmap3({
         map:{
            options:{
             center: [{estate_data_gps}],
             zoom: {settings_zoom},
             scrollwheel: false
            }
         },
         marker:{
            values:[
                {latLng:[{estate_data_gps}], options:{icon: "{estate_data_icon}"}, data:"{estate_data_address}<br />{lang_GPS}: {estate_data_gps}"},
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
                  options:{disableAutoPan: mapDisableAutoPan, content: '<div style="width:400px;display:inline;">'+context.data+'</div>'}
                }
              });
            }
          }
        }
        }});
     
    <?php endif;?>
    });    
    </script>
    {settings_tracking}
  </head>
  <body>

<div class="wrap-content-print">
    <div class="container container-property">
        <div class="row">        
                    <div class="col-xs-9">
                       <div class="row">
                            <div class="col-xs-7 clearfix">
                                <div class="product-gallery">
                                    <div class="primary-image">
                                        <div id="myCarousel" class="carousel carousel-property slide" data-ride="carousel">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                            <?php foreach($slideshow_property_images as $file): ?>
                                                <a href="<?php echo _simg($file['url'], '470x311');?>" class="theater item <?php echo  $file['first_active'];?>" rel="group" hidefocus="true">
                                                    <img src="<?php echo _simg($file['url'], '470x311');?>" class="img-responsive" alt="">
                                                </a>

                                            <?php endforeach; ?>
                                            </div>
                                            <!-- Carousel nav -->
                                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                <i class="fa fa-angle-right"></i>
                                            </a>   
                                        </div>
                                    </div>
                                    <div class="thumbnail-images">
                                        <?php if(sw_count($slideshow_property_images)>1):?>
                                            <?php foreach($slideshow_property_images as $file): ?>
                                            <a href="<?php echo _simg($file['url'], '470x311'); ?>" class="theater" rel="group" hidefocus="true">
                                                <img src="<?php echo _simg($file['url'],  '470x311'); ?>" alt="">
                                            </a>
                                            <?php endforeach; ?>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div class="product-info">
                                    <h3>{page_title}, #{estate_data_id}</h3>
                                    <div class="wp-block property list no-border">
                                        <div class="wp-block-content clearfix">
                                            <p class="description mb-15"><?php echo _ch($estate_data_option_8, ''); ?></p>
                                            <span class="pull-left">
                                                <span class="price">
                                                <?php if(!empty($estate_data_option_36) || !empty($estate_data_option_37)): ?>
                                                <?php 
                                                    if(!empty($estate_data_option_36))echo $options_prefix_36.price_format($estate_data_option_36, $lang_id).$options_suffix_36;
                                                    if(!empty($estate_data_option_37))echo ' '.$options_prefix_37.price_format($estate_data_option_37, $lang_id).$options_suffix_37;
                                                ?>
                                                <?php else: ?>
                                                <?php endif; ?>
                                                </span> 
                                            </span>
                                        </div>
                                        <div class="wp-block-footer style2 mt-15">
                                            <ul class="aux-info">
                                                <li><i class="fa fa-building"></i><?php echo _ch($estate_data_option_57, '-'); ?> <?php echo _ch($options_suffix_57, '-'); ?></li>
                                                <li><i class="fa fa-user"></i><?php echo _ch($estate_data_option_20, '-'); ?> <?php echo _ch($options_name_20, '-'); ?></li>
                                                <li><i class="fa fa-tint"></i><?php echo _ch($estate_data_option_19, '-'); ?> <?php echo _ch($options_name_19, '-'); ?></li>
                                                <li><i class="fa fa-car"></i><small> <strong class="<?php echo (!empty($estate_data_option_32)) ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-remove';  ?>"></strong> <?php echo _ch($options_name_32, '-'); ?></small></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <span class="clearfix"></span> 
                                    
                                </div>
                            </div>
                        </div>

                        <!-- PROPERTY DESCRIPTION -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="tabs-framed boxed">
                                    <ul class="tabs clearfix">
                                        <li class="active"><a href="#tab-1" data-toggle="tab"><?php _l('Additional details');?></a></li>
                                        <li><a href="#tab-map" data-toggle="tab" data-type="gmap"><?php _l('Map');?></a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab-1">
                                            <div class="tab-body">
                                                <div class="map-property">
                                                    <div id="propertyLocation" style="height: 300px;"></div><!-- /#map-property -->
                                                </div><!-- /.map-property
                                                <div class="section-title-wr">
                                                    <h3 class="section-title left">{lang_Description}</h3>
                                                </div>
                                                <p>
                                                    {estate_data_option_17}
                                                </p>
                                                <?php if(false): ?>
                                                <div class="section-title-wr">
                                                    <h3 class="section-title left">Additional details</h3>
                                                </div>
                                                <table class="table table-bordered table-striped table-hover table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Property Size:</strong> 2300 Sq Ft</td>
                                                            <td><strong>Lot size:</strong> 5000 Sq Ft</td>
                                                            <td><strong>Price:</strong> $23000</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Rooms:</strong> 5</td>
                                                            <td><strong>Bedrooms:</strong> 4</td>
                                                            <td><strong>Bathrooms:</strong> 2</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Garages:</strong> 2</td>
                                                            <td><strong>Roofing:</strong> New</td>
                                                            <td><strong>Structure Type:</strong> Bricks</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Year built:</strong> 1991</td>
                                                            <td><strong>Available from:</strong> 1 August 2014</td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php endif;?>
                                                

                                                <?php if(isset($category_options_21) && $category_options_count_21>0): ?>
                                                <h3 class="page-header">{options_name_21}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_21}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-xs-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_21}

                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>

                                                <?php if(isset($category_options_52) && $category_options_count_52>0): ?>
                                                <h3 class="page-header">{options_name_52}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_52}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-xs-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_52}
                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>

                                                <?php if(isset($category_options_43) && $category_options_count_43>0): ?>
                                                <h3 class="page-header">{options_name_43}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_43}
                                                        {is_text}
                                                        <li class="col-xs-6 col-xs-3">
                                                        <i class="fa fa-check ok"></i>{icon} {option_name}:&nbsp;&nbsp;{option_prefix}{option_value}{option_suffix}
                                                        </li>
                                                        {/is_text}
                                                        {/category_options_43}

                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>
                                                <?php if(!empty($estate_data_option_12)): ?>
                                                <h2>{options_name_9}</h2>
                                                {estate_data_option_12}
                                                <br style="clear:both;" />
                                                <?php endif; ?>
                                                
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(config_db_item('walkscore_enabled') == TRUE && !empty($estate_data_address) && !empty($estate_data_gps)): ?>
                        <br />
                        <script type='text/javascript'>
                        var ws_wsid = '';
                        <?php
                        echo "var ws_address = '$estate_data_address';";
                        ?>
                        var ws_width = '500';
                        var ws_height = '336';
                        var ws_layout = 'horizontal';
                        var ws_commute = 'true';
                        var ws_transit_score = 'true';
                        var ws_map_modules = 'all';
                        </script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:318px;left:8px;width:488px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:286px' /><input type='image' id='ws-go' src='http://cdn2.walk.sc/2/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>
                        <hr>
                        <?php endif; ?>
 
                        <?php _widget('center_imagegallery');?>
                        <br style="clear: both;" />
                        
                        <?php if(file_exists(APPPATH.'controllers/admin/swin_reviews.php') && $settings_reviews_enabled): ?>
                            <div id="main">
                        <h2 id="form_review" class="page-header"><?php echo lang_check('YourReview'); ?></h2>
                        <?php if(sw_count($not_logged)): ?>
                        <p class="alert alert-success">
                            <?php echo lang_check('LoginToReview'); ?>
                        </p>
                        <?php else: ?>
                        
                        <?php if($reviews_submitted == 0): ?>
                        <form  class="form-horizontal no-padding " method="post" action="{page_current_url}#form_review">
                        <div class="control-group">
                        <label class="control-label" for="inputRating"><?php echo lang_check('Rating'); ?></label>
                        <div class="controls">
                            <input type="number" data-max="5" data-min="1" name="stars" id="stars" class="rating form-control INPUTBOX" data-empty-value="5" value="5" data-active-icon="icon-star" data-inactive-icon="icon-star-empty" />
                        </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputMessageR"><?php echo lang_check('Message'); ?></label>
                            <div class="controls">
                                <textarea id="inputMessageR" class="form-control TEXTAREA" rows="3" name="message" rows="3" placeholder="{lang_Message}"></textarea>
                            </div>
                        </div>
                        <br style="clear: both;" />
                        <div class="control-group" >
                            <div class="controls">
                                <button type="submit" class="btn"><?php echo lang_check('Send'); ?></button>
                            </div>
                        </div>
                        <br style="clear: both;" />
                        </form>
                        <?php else: ?>
                        <p class="alert alert-info">
                            <?php echo lang_check('ThanksOnReview'); ?>
                        </p>
                        <?php endif; ?>

                        <?php endif; ?>
                        

                        <?php if($settings_reviews_public_visible_enabled): ?>
                        <h2><?php echo lang_check('Reviews'); ?></h2>
                        <div class="box">
                        <?php if(sw_count($not_logged) && !$settings_reviews_public_visible_enabled): ?>
                        <p class="alert alert-success">
                            <?php echo lang_check('LoginToReadReviews'); ?>
                        </p>
                        <?php else: ?>
                        <?php if(sw_count($reviews_all) > 0): ?>
                        <ul class="media-list clearfix">
                        <?php foreach($reviews_all as $review_data): ?>
                        <?php //print_r($review_data); ?>
                        <li class="media">
                        <div class="pull-left">
                        <?php if(isset($review_data['image_user_filename'])): ?>
                        <img class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="<?php echo base_url('files/thumbnail/'.$review_data['image_user_filename']); ?>" />
                        <?php else: ?>
                        <img class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="assets/img/user-agent.png" />
                        <?php endif; ?>
                        </div>
                        <div class="media-body">
                        <h4 class="media-heading"><div class="review_stars_<?php echo $review_data['stars']; ?>"> </div></h4>
                        <?php if($review_data['is_visible']): ?>
                        <?php echo $review_data['message']; ?>
                        <?php else: ?>
                        <?php echo lang_check('HiddenByAdmin'); ?>
                        <?php endif; ?>
                        </div>
                        </li>
                        <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p class="alert alert-success">
                            <?php echo lang_check('SubmitFirstReview'); ?>
                        </p>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                        <?php endif; ?>
                        <br style="clear: both;" />
                        
                        <?php if(!empty($settings_facebook_comments)): ?>
                        <h2 class='title'><?php echo lang_check('Facebook comments'); ?></h2>
                        <?php echo str_replace('http://example.com/comments', $page_current_url, $settings_facebook_comments); ?>
                        <br style="clear: both;" />
                        <?php endif;?>
                        
                        <?php if(sw_count($agent_estates) > 0): ?>
                        <h2 class='title' style="margin-top:10px;">{lang_Agentestates}</h2>
                        <?php foreach($agent_estates as $key=>$item): ?>
                        <?php
                            if($key==0)echo '<div class="row">';
                        ?>
                            <?php _generate_results_item(array('key'=>$key, 'item'=>$item)); ?>
                        <?php
                            if( ($key+1)%2==0 )
                            {
                                echo '</div><div class="row">';
                            }
                            if( ($key+1)==sw_count($agent_estates) ) echo '</div>';
                            endforeach;
                        ?>
                        <?php endif;?>
                        <br style="clear:both;" />
                        
                    </div>
                    <div class="col-xs-3">
                        <div class="sidebar">
                            {has_agent}
                            <div id="agents-block" class="section-title-wr pg-opt" style="padding-bottom: 15px;">
                                <h3 class="section-title left"><span><?php _l('Agent');?></span></h3>
                            </div>
                            <div class="panel">
                                <div class="wp-block testimonial style-1 base right-agents">
                                    <div class="testimonial-author light">  
                                        <div class="author-img">
                                            <a href="{agent_url}">
                                                <img src="<?php echo _simg($agent_image_url, '75x75'); ?>" alt="<?php  _che($agent_name_surname);?>">
                                            </a>
                                        </div>
                                        <div class="author-info">
                                            <span class="author-name"><a href="{agent_url}"><?php  _che($agent_name_surname);?></a></span>
                                            <small class="author-pos"><?php  _che($agent_phone);?></small>
                                            <small class="author-pos"><a href="mailto:<?php  _che($agent_mail);?>?subject={lang_Estateinqueryfor}: {estate_data_id}, {page_title}" title="<?php  _che($agent_mail);?>"><?php  _che($agent_mail);?></a></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {/has_agent}
                            
                            <?php _widget('property_right_qrcode');?>
                            
                            <div class="panel panel-default panel-sidebar-1"  id="">         
                                <div class="panel-heading"><h2>{lang_Overview}</h2></div>
                                  <div class="property_options">
                                      <div class="panel-row"> 
                                    <p class="bottom-border"><strong>
                                    {lang_Address}
                                    </strong> <span>{estate_data_address}</span>
                                    <br style="clear: both;" />
                                    </p></div>
                                    {category_options_1}
                                    {is_text}
                                    <div class="panel-row"> 
                                        <p class="bottom-border"><strong>{option_name}:</strong> <span>{option_prefix} {option_value} {option_suffix}</span><br style="clear: both;" /></p>
                                    </div>
                                    {/is_text}
                                    {is_dropdown}
                                    <div class="panel-row"> 
                                        <p class="bottom-border"><strong>{option_name}:</strong> <span class="label label-success">&nbsp;&nbsp;{option_value}&nbsp;&nbsp;</span></p>
                                    </div>
                                    {/is_dropdown}
                                    {is_checkbox}
                                    <div class="panel-row"> 
                                        <img src="assets/img/checkbox_{option_value}.png" alt="{option_value}" />&nbsp;&nbsp;{option_name}
                                    </div>
                                    {/is_checkbox}
                                    {/category_options_1}
                                    <?php if(!empty($estate_data_option_64) && isset($this->treefield_m)): ?>
                                    <div class="panel-row"> 
                                        <p class="bottom-border">
                                            <strong><?php echo $options_name_64; ?>:</strong>
                                            <span>
                                            <?php
                                                $nice_path = $estate_data_option_64;
                                                $link_defined = false;
                                                // Get treefield with language data
                                                $treefield_id = $this->treefield_m->id_by_path(64, $lang_id, $nice_path);
                                                if(is_numeric($treefield_id))
                                                {
                                                    $treefield_data = $this->treefield_m->get_lang($treefield_id, TRUE, $lang_id);

                                                    // If no content defined then no link, just span
                                                    if(!empty($treefield_data->{"body_$lang_id"}))
                                                    {
                                                        // If slug then define slug link
                                                        $href = slug_url('treefield/'.$lang_code.'/'.$treefield_id.'/'.url_title_cro($treefield_data->{"value_$lang_id"}), 'treefield_m');
                                                        echo '<a href="'.$href.'">'.$nice_path.'</a>';
                                                        $link_defined=true;
                                                    }
                                                }
                                                if(!$link_defined) echo $nice_path;
                                            ?>
                                            </span>
                                            <br style="clear: both;" />
                                        </p>
                                    </div>
                                    <?php endif;?>
                                    <?php
                                        foreach($category_options_1 as $key=>$row)
                                        {
                                            if($row['option_type'] == 'UPLOAD')
                                            {
                                                if(!empty($row['option_value']) && is_numeric($row['option_value']))
                                                {
                                                    //Fetch repository
                                                    $rep_id = $row['option_value'];
                                                    $file_rep = $this->file_m->get_by(array('repository_id'=>$rep_id));
                                                    $rep_value = '';
                                                    if(sw_count($file_rep))
                                                    {
                                                        $rep_value.= '<ul>';
                                                        foreach($file_rep as $file_r)
                                                        {
                                                            $rep_value.= "<li><a target=\"_blank\" href=\"".base_url('files/'.$file_r->filename)."\">$file_r->filename</a></li>";
                                                        }
                                                        $rep_value.= '</ul>';

                                                        echo '<p class="bottom-border"><strong>'.$row['option_name'].':</strong></p>';
                                                        echo $rep_value;
                                                    }
                                                }
                                            }

                                        }
                                    ?>

                                    <?php if(!empty($estate_data_counter_views)): ?>
                                    <div class="panel-row"> 
                                    <p class="bottom-border">
                                        <strong>{lang_ViewsCounter}:</strong>
                                        <span>{estate_data_counter_views}</span>
                                    </p>
                                    </div>
                                    <?php endif;?>

                                    <?php if(!empty($estate_data_option_56)): ?>
                                    <div class="panel-row"> 
                                    <p class="bottom-border">
                                        <strong>{lang_Pro}:</strong>
                                        <span class=" pull-right review_stars_<?php echo $estate_data_option_56; ?>"> </span>
                                    </p>
                                    </div>
                                    <?php endif;?>

                                    <?php if(!empty($avarage_stars) && file_exists(APPPATH.'controllers/admin/swin_reviews.php') && $settings_reviews_enabled): ?>
                                    <div class="panel-row"> 
                                    <p class="bottom-border">
                                        <strong>{lang_Users}:</strong>
                                        <span class="pull-right review_stars_<?php echo $avarage_stars; ?>"> </span>
                                    </p>
                                    </div>
                                    <?php endif;?>

                                    <p style="text-align:right;">
                                        <button class="print_hidden" onclick="myFunction()"><?php echo lang_check('Print'); ?></button> <script> function myFunction() { window.print(); } </script>
                                    </p>
                                  </div>
                                </div> 
                            
                                <div class="panel panel-default panel-sidebar-1"  id="form">
                                <div class="panel-heading"><h2>{lang_Enquireform}</h2></div>
                                <form method="post" class="property-form" action="{page_current_url}#form">
                                    <input type="hidden" name="form" value="contact" />
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
                                    
                                    <?php if(config_item('reservations_disabled') === FALSE ||
                                    (file_exists(APPPATH.'controllers/admin/booking.php') && sw_count($is_purpose_rent) && $this->session->userdata('type')=='USER' && config_item('reservations_disabled') === FALSE)): ?>
                                        {is_purpose_rent}
                                        <div class="form-group {form_error_fromdate}">
                                            <input class="form-control"  id="datetimepicker1" name="fromdate" type="text" placeholder="{lang_FromDate}" value="{form_value_fromdate}" />
                                        </div><!-- /.form-group -->
                                        <div class="form-group {form_error_todate}">
                                            <input class="form-control" id="datetimepicker2" name="todate" type="text" placeholder="{lang_ToDate}" value="{form_value_todate}" />
                                        </div><!-- /.form-group -->
                                    {/is_purpose_rent}
                                    <?php endif; ?>
                                    
                                    <?php if(config_item( 'captcha_disabled')===FALSE): ?>
                                    <div class="form-group form-group {form_error_captcha}">
                                        <div class="row">
                                            <div class="col-xs-6" style="padding-top:1px;">
                                                <?php echo $captcha[ 'image']; ?>
                                            </div>
                                            <div class="col-xs-6">
                                                <input class="captcha form-control {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                                                <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                                    <div class="control-group" >
                                        <label class="control-label captcha"></label>
                                        <div class="controls">
                                            <?php _recaptcha(true); ?>
                                       </div>
                                    </div>
                                   <?php endif; ?>
                                    <div class="form-group {form_error_message}">
                                        <textarea id="message" name="message" rows="1" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                                    </div>
                                    </div> 
                                    <button  class="btn btn-lg btn-block-bm btn-alt btn-icon btn-icon-right btn-envelope" type="submit">
                                        <span>{lang_Send}</span>
                                    </button>
                                </form>
                            </div>
                            
                            <?php _widget('right_recentproperties');?>
                            <?php _widget('right_adssmall');?>
                        </div>
                    </div>
                </div>
    </div>
</div>
    
<div class="wrap-bottom-print">
    <div class="container">
      <div class="row-fluid">
        <div class="span3">
            <table>
                <tr>
                    <td><i class="icon-map-marker"></i></td>
                    <td>
                        {settings_address_footer}
                    </td>
                </tr>
            </table>
        </div>
        <div class="span3">
            <table>
                <tr>
                    <td><i class="icon-phone"></i></td>
                    <td>{settings_phone}</td>
                </tr>
                <tr>
                    <td><i class="icon-print"></i></td>
                    <td>{settings_fax}</td>
                </tr>
                <tr>
                    <td><i class="icon-envelope"></i></td>
                    <td>{settings_email}</td>
                </tr>
            </table>
        </div>
      </div>
    </div>
    <!-- Generate time: <?php echo (microtime(true) - $time_start)?>, version: <?php echo APP_VERSION_REAL_ESTATE; ?> -->
</div>
  </body>
</html>