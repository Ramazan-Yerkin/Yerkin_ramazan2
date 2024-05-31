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
    <?php _widget('top_mapsearchvisual');?>  
     <section class="slice bg-white bb">
        <div class="wp-section">
            <div id="content-block" class="container">
                <div class="row">
                    <div class="col-md-9">
                        
                        
                    <?php _widget('center_recentproperties');?>  
   <h2>{page_title}</h2>
        <div class="property_content">
        {page_body}

<?php if(false): ?>
<br />
<script type='text/javascript'>
var ws_wsid = '';
<?php
$address = $page_navigation_title;
if(!empty($page_address))
    $address = $page_address;
$address = strip_tags($address);

echo "var ws_address = '$address';";
?>
var ws_width = '500';
var ws_height = '336';
var ws_layout = 'horizontal';
var ws_commute = 'true';
var ws_transit_score = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:318px;left:8px;width:488px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:286px' /><input type='image' id='ws-go' src='http://cdn2.walk.sc/2/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>
<?php endif; ?>
        
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
                            <?php _widget('right_customfilter');?>  
                            <?php _widget('right_mortgage');?>  
                            <?php _widget('right_adssmall');?>  
                            <?php _widget('right_recentproperties');?>  
                            
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

</body>
</html>