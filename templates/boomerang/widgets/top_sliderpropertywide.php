<?php
/*
Widget-title: Wide slider
Widget-preview-image: /assets/img/widgets_preview/top_sliderpropertywide.jpg
*/
?>

<section class="slice no-padding bb resize-block save-form ">
        <div class="wp-section">
            <div class="container-fluid no-padding">
                <div class="row-fluid">
                    <div class="">
                        <div id="homepageCarousel" class="carousel carousel-1 carousel-fixed-height slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach($slideshow_images as $key=>$file): ?>
                                        <div class="item item-dark <?php echo ($key==0) ? 'active' : '';?>" style="background-image:url(<?php echo _simg($file['url'], '1800x600'); ?>);">
                                            <?php if(config_item('property_slider_enabled')===TRUE&&!empty($file['property_details'])):?>
                                            <div class="mask mask-1"></div>
                                            <div class="container">
                                                 <div class="description-left">
                                                     <span class="title c-white text-uppercase strong-700"><?php _che($file['property_details']['title']);?></span>
                                                     <span class="subtitle-sm"><?php _che($file['property_details']['option_chlimit_8']);?></span>
                                                     <a href="<?php _che($file['property_details']['link']);?>" class="btn btn-lg btn-white btn-icon fa-eye">
                                                         <span><?php echo _l('Read more');?></span>
                                                     </a>
                                                 </div>
                                            </div> 
                                            <?php elseif(!empty($file['title'])): ?>
                                            <div class="mask mask-1"></div>
                                            <div class="container">
                                                 <div class="description-left">
                                                    <span class="title c-white text-uppercase strong-700"><?php _che($file['title']);?></span>
                                                    <span class="subtitle-sm"><?php _che($file['description']);?></span>
                                                     <?php if(!empty($file['link'])):?>
                                                     <a href="<?php _che($file['link']);?>" class="btn btn-lg btn-white btn-icon fa-eye">
                                                         <span><?php echo _l('Read more');?></span>
                                                     </a>
                                                    <?php endif; ?>
                                                 </div>
                                            </div>                     
                                            <?php endif; ?>
                                        </div> 
                                        <?php endforeach;?>
                                    </div>
                                    
                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#homepageCarousel" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="right carousel-control" href="#homepageCarousel" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>     
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>