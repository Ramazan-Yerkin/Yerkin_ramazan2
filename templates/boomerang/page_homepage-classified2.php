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
    <?php _widget('top_slidersearchvisual');?>  
    <?php _widget('top_featuredproperties');?>
    <?php _widget('top_categoriesparallax');?>
    
    <?php _widget('bottom_defaultcontent');?>
    <?php _widget('bottom_recentnews2');?>
    <?php _widget('bottom_parallax2');?>
    <?php _widget('bottom_agents2');?>
    <?php _widget('bottom_clientsreviews');?>
    <?php _widget('bottom_partners');?>

    <!-- FOOTER -->
    <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'standard')); ?>
</div>

<?php _widget('custom_javascript');?>


</body>
</html>