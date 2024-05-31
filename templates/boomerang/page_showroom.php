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
                    <?php if(file_exists(APPPATH.'controllers/admin/showroom.php')):?>
                    <div class="col-md-9">
                    <?php else:?>
                    <div class="col-md-12">  
                    <?php endif;?>
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
                        <?php if(file_exists(APPPATH.'controllers/admin/showroom.php')):?>
                        <div id="showroom" class="property_content_position">
                        <ul class="list-listings blog-list">
                            <!-- Standard image post example -->
                            <?php foreach($showroom_module_all as $key=>$row):?> 
                            <li class="">
                                <div class="listing-image">
                                    <a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>" >
                                        <?php if(file_exists(FCPATH.'files/thumbnail/'.$row->image_filename)):?>
                                        <img src="<?php echo _simg('files/'.$row->image_filename, '300x185'); ?>" />
                                        <?php else:?>
                                            <img style="height:300px;width:185px" src="assets/img/no_image.jpg" alt="new-image">
                                        <?php endif;?>
                                    </a>
                                </div>
                                <div class="listing-body">
                                    <h3><a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>"><?php echo $row->title; ?></a></h3>
                                    <span class="list-item-info">
                                       <!-- Posted January 03, 2014-->
                                    </span>
                                    <p>
                                        <?php echo $row->description; ?>
                                    </p>
                                    <p>
                                        <a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>" class="btn btn-sm btn-base pull-right">{lang_Details}</a>
                                    </p>
                                </div>
                            </li>
                            <?php endforeach;?>
                        </ul>

                        <!-- Pagination -->
                        <div class="pagination-delimiter">
                            <?php echo $showroom_pagination; ?>
                        </div>
                    </div>
                        <?php endif;?>
                    </div>
                    <?php if(file_exists(APPPATH.'controllers/admin/showroom.php')):?>
                    <div class="col-md-3">
                    	<!-- SIDEBAR - BLOG -->
                        <div class="sidebar">
                                <!-- Search blog -->
                            <div class="section-title-wr">
                                   <h3 class="section-title left"><span><?php _l('Search');?></span></h3>
                            </div>
                                <div class="widget">
                                <form class="form-light">
                                    <div class="input-group">
                                        <input type="text" id="search_showroom" class="form-control" placeholder="<?php _l('Search');?>">
                                        <span class="input-group-btn">
                                            <button id="btn-search_showroom" class="btn btn-base" type="button"><?php _l('Go');?></button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <!-- Categories -->
                            <div class="section-title-wr">
                                   <h3 class="section-title left"><span><?php _l('Categories');?></span></h3>
                            </div>
                                <div class="widget">
                                <ul class="categories highlight">
                                    <?php foreach($categories_showroom as $id=>$category_name):?>
                                    <?php if($id != 0): ?>
                                        <li><a href="{page_current_url}?cat=<?php echo $id; ?>#showroom"><?php echo $category_name; ?></a></li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>                   
                    </div>
                    <?php endif;?>
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
        $("search_showroom_form").click( function() {
            if($('#search_showroom').val().length > 2 || $('#search_showroom').val().length == 0)
            {
                $.post('<?php echo $ajax_showroom_load_url; ?>', {search: $('#search_showroom').val()}, function(data){
                    $('.property_content_position').html(data.print);
                    
                    reloadElements();
                }, "json");
            }
        });

    });    
</script>
</body>
</html>