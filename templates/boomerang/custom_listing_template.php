<!DOCTYPE html>
<html> 
<head>
    <?php _widget('head');?>
    <?php if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/js/places.js')): ?>
    <script src="assets/js/places.js"></script>
    <?php endif; ?>
    <style>
        .tabs-framed .tab-pane:not(.active) {
            position: absolute !important;
            left: -11000px !important;
            display:block !important;
            width: 100%
        }
        </style>
</head>
<body class="body-wrap <?php _widget('custom_paletteclass'); ?>">
<?php if (!empty($settings_facebook_jsdk) && (config_db_item('appId') == '' || !file_exists(FCPATH . 'templates/' . $settings_template . '/assets/js/like2unlock/js/jquery.op.like2unlock.min.js'))): ?>
<?php
if (!empty($lang_facebook_code))
    $settings_facebook_jsdk = str_replace('en_EN', $lang_facebook_code, $settings_facebook_jsdk);
?>
<?php echo $settings_facebook_jsdk; ?>
<?php endif; ?> 
<?php _widget('slidebar'); ?>
<!-- MAIN WRAPPER -->
<div class="">
    <!-- This section is only for demonstration purpose only. Check out the docs for more informations" -->
     <?php _widget('custom_palette');?>
            <!-- HEADER -->
        <div id="divHeaderWrapper">
            <header class="header-standard-2">     
               <?php _widget('header_loginmenu');?>
               <?php _widget('header_mainmenu');?>
            </header>        
        </div>
        <!-- MAIN CONTENT -->
        <section class="slice bg-white bb">
            <div class="wp-section estate">
                <div class="container">
                    <div class="row">        
                        <div class="col-md-9">
                                <?php
                                foreach ($widgets_order->center as $widget_filename) {
                                    _widget('property_'.$widget_filename);
                                }
                                ?>
                        </div>
                        <div class="col-md-3">
                            <div class="sidebar">
                                    <?php
                                    foreach ($widgets_order->right as $widget_filename) {
                                        _widget('property_'.$widget_filename);
                                    }
                                    ?>
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

<script type="text/javascript">
    $(document).ready(function() {

    <?php if(file_exists(APPPATH.'controllers/admin/favorites.php')):?>
        $("#add_to_favorites").click(function(){
            var data = { property_id: {estate_data_id} };
            var load_indicator = $(this).find('.load-indicator');
            load_indicator.css('display', 'inline-block');
            $.post("{api_private_url}/add_to_favorites/{lang_code}", data, 
                   function(data){

                ShowStatus.show(data.message);

                load_indicator.css('display', 'none');

                if(data.success)
                {
                    $("#add_to_favorites").css('display', 'none');
                    $("#remove_from_favorites").css('display', 'inline-block');
                }
            });

            return false;
        });

        $("#remove_from_favorites").click(function(){

            var data = { property_id: {estate_data_id} };

            var load_indicator = $(this).find('.load-indicator');
            load_indicator.css('display', 'inline-block');
            $.post("{api_private_url}/remove_from_favorites/{lang_code}", data, 
                   function(data){

                ShowStatus.show(data.message);

                load_indicator.css('display', 'none');

                if(data.success)
                {
                    $("#remove_from_favorites").css('display', 'none');
                    $("#add_to_favorites").css('display', 'inline-block');
                }
            });

            return false;
        });

    <?php endif; ?>
    });
 
</script>

<script>
    
    $(document).ready(function(){
        
        $('.product-gallery .thumbnail-images a').click(function (e) {
            e.preventDefault();
            var data_slide = parseInt($(this).attr('data-to'));
            $('#myCarousel').carousel(data_slide);
        });
    })
    
</script>

</body>
</html>