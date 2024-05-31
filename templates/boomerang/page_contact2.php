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
      <div class="pg-opt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{page_title}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <?php _widget('top_contactmap');?>

    <section class="slice bg-white no-padding-top">
        <div class="w-section inverse">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title-wr">
                                    <h3 class="section-title left"><span>{lang_Info}</span></h3>
                                </div>
                                <div class="contact-info">
                                    <p>{page_body}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php _widget('bottom_contactformblack');?>

    <!-- FOOTER -->
    <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'standard')); ?>
</div>

<?php _widget('custom_javascript');?>

</body>
</html>