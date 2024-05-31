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
                    <div class="col-md-12">
                        <div class="wp-block pg-opt">
                            <h2 class="title">{page_title}</h2>
                        </div>
                        <div class="wp-block pg-opt box-content">
                            {page_body}
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
                        <div id="news" class="property_content_position">
                        <ul class="list-listings blog-list">
                            <!-- Standard image post example -->
                            <?php foreach($news_articles as $key=>$row):?> 
                            <li class="">
                                <div class="listing-image">
                                    <a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>">
                                        <?php if(file_exists(FCPATH.'files/thumbnail/'.$row->image_filename)):?>
                                        <img src="<?php echo _simg('files/'.$row->image_filename, '300x185'); ?>" />
                                        <?php else:?>
                                            <img style="height:300px;width:185px" src="assets/img/no_image.jpg" alt="new-image">
                                        <?php endif;?>
                                    </a>
                                </div>
                                <div class="listing-body">
                                    <h3><a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>"><?php echo $row->title; ?></a></h3>
                                    <span class="list-item-info">
                                       <!-- Posted January 03, 2014-->
                                    </span>
                                    <p>
                                        <?php echo $row->description; ?>
                                    </p>
                                    <p>
                                        <a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>" class="btn btn-sm btn-base pull-right">{lang_Details}</a>
                                    </p>
                                </div>
                            </li>
                            <?php endforeach;?>
                        </ul>
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