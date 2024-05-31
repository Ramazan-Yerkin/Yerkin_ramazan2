<!DOCTYPE html>
<html>  
<head>
 <?php _widget('head');?>
</head>
<body class="body-wrap <?php _widget('custom_paletteclass'); ?>">

<?php _widget('slidebar'); ?>
<!-- MAIN WRAPPER -->
<div >
    <?php _widget('custom_palette');?>
    
    <!-- HEADER -->
    <div id="divHeaderWrapper">
    <header class="header-standard-3"> 
        <?php _widget('header_loginmenu');?>
        <?php _widget('header_mainmenu');?>

    </header>   
    </div>

    <!-- MAIN CONTENT -->
    <?php _widget('top_geosearchvisual');?> 
     <section class="slice bg-white bb">
        <div class="wp-section">
            <div id="content-block" class="container">
                <div class="row">
                    <div class="col-md-9">
                    <?php _widget('center_demomaps');?>  
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar">
                            <?php _widget('right_customfilter');?>  
                            <?php _widget('right_categoriesmenu');?>  
                            <?php _widget('right_mortgage');?>
                            <?php _widget('right_adssmall');?>  
                            <?php _widget('right_recentproperties');?>  
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php _widget('bottom_defaultcontent');?>
    <?php _widget('bottom_agents2');?>
    <?php _widget('bottom_clientsreviews');?>
    <?php _widget('bottom_stats');?>
    <?php _widget('bottom_partners');?>

    <!-- FOOTER -->
    <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'standard')); ?>
</div>

<?php _widget('custom_javascript');?>

</body>
</html>