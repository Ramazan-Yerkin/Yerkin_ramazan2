                       <div class="row">
                    <?php if(sw_count($slideshow_property_images)>0):?>
                            <div class="col-md-7 clearfix">
                                <div class="product-gallery">
                                    <div class="primary-image">
                                        <div id="myCarousel" class="carousel carousel-property slide" data-ride="carousel">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                            <?php foreach($slideshow_property_images as $file): ?>
                                                <a href="<?php echo _simg($file['url'], '470x311');?>"  data-link="<?php echo $file['url']; ?>" class=" item <?php echo  $file['first_active'];?>" rel="group" hidefocus="true">
                                                    <img src="<?php echo _simg($file['url'], '470x311');?>" class="img-responsive" alt="<?php echo _ch($file['alt']);?>">
                                                </a>

                                            <?php endforeach; ?>
                                            </div>
                                            <?php if(sw_count($slideshow_property_images)>1):?>
                                                <!-- Carousel nav -->
                                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                    <i class="fa fa-angle-left"></i>
                                                </a>
                                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            <?php endif;?> 
                                        </div>
                                    </div>
                                    <div class="thumbnail-images">
                                        <?php if(sw_count($slideshow_property_images)>1):?>
                                            <?php foreach($slideshow_property_images as $k=>$file): ?>
                                            <a href="<?php echo _simg($file['url'], '470x311'); ?>" data-link="<?php echo $file['url']; ?>" data-to='<?php echo $k;?>' title="<?php echo $file['filename']; ?>"  alt="" class="" rel="group" hidefocus="true">
                                                <img src="<?php echo _simg($file['url'],  '470x311'); ?>" alt="<?php echo _ch($file['alt']);?>">
                                            </a>
                                            <?php endforeach; ?>
                                        <?php endif;?>
                                    </div>
                                </div>
                                
                                <?php if(file_exists(APPPATH.'controllers/admin/favorites.php')):?>
                                <?php
                                    $favorite_added = false;
                                    if(sw_count($not_logged) == 0)
                                    {
                                        $CI =& get_instance();
                                        $CI->load->model('favorites_m');
                                        $favorite_added = $CI->favorites_m->check_if_exists($this->session->userdata('id'), 
                                                                                            $estate_data_id);
                                        if($favorite_added>0)$favorite_added = true;
                                    }
                                ?>
                                <div class="pull-left favorite clearfix" style="margin-bottom: 20px;">
                                    <a class="btn btn-warning" id="add_to_favorites" href="#" style="<?php echo ($favorite_added)?'display:none;':''; ?>"><i class="icon-star icon-white"></i> <?php echo lang_check('Add to favorites'); ?> <i class="load-indicator"></i></a>
                                    <a class="btn btn-success" id="remove_from_favorites" href="#" style="<?php echo (!$favorite_added)?'display:none;':''; ?>"><i class="icon-star icon-white"></i> <?php echo lang_check('Remove from favorites'); ?> <i class="load-indicator"></i></a>
                                </div>
                                <?php endif; ?>
                                <?php _widget('custom_property_center_reports');?>
                            </div>
                            <div class="col-md-5">
                        <?php else: ?>
                            <div class="col-md-12">
                        <?php endif;?>
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
                <?php
                    $custom_elements = _get_custom_items();
                    $i=0;
                    if(sw_count($custom_elements) > 0):
                    foreach($custom_elements as $key=>$elem):
                    if(!empty(${"estate_data_option_".$elem->f_id}) && $i++<3)
                    if($elem->type == 'DROPDOWN' || $elem->type == 'INPUTBOX'):
                     ?>
                <li><i class="fa <?php _che($elem->f_class); ?>"></i><?php echo _ch(${"estate_data_option_".$elem->f_id}, '-'); ?> <?php echo _ch(${"options_suffix_$elem->f_id"}, ''); ?> <span style="<?php _che($elem->f_style); ?>"><?php echo _ch(${"options_name_$elem->f_id"}, '-'); ?></span></li>
                     <?php 
                    elseif($elem->type == 'CHECKBOX'):
                     ?>
                <li><i class="fa <?php _che($elem->f_class); ?>"></i><small> <strong class="<?php echo (!empty(${"estate_data_option_".$elem->f_id})) ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-remove';  ?>"></strong> <?php echo _ch(${"options_name_$elem->f_id"}, '-'); ?></small></li>
                     <?php 
                    endif;                    
                    endforeach;  
                    else:
                ?>
                    <?php if(isset($estate_data_option_57) && !empty($estate_data_option_57)):?>
                    <li><i class="fa fa-building"></i><?php echo _ch($estate_data_option_57, '-'); ?> <?php echo _ch($options_suffix_57, '-'); ?></li>
                    <?php endif;?>
                    <?php if(isset($estate_data_option_20) && !empty($estate_data_option_20)):?>
                    <li><i class="fa fa-user"></i><?php echo _ch($estate_data_option_20, '-'); ?> <?php echo _ch($options_name_20, '-'); ?></li>
                    <?php endif; ?>
                    <?php if(isset($estate_data_option_19) && !empty($estate_data_option_19)):?>
                    <li><i class="fa fa-tint"></i><?php echo _ch($estate_data_option_19, '-'); ?> <?php echo _ch($options_name_19, '-'); ?></li>
                    <?php endif; ?>
                    <?php if(isset($estate_data_option_32) && !empty($estate_data_option_32)):?>
                    <li><i class="fa fa-car"></i><small> <strong class="<?php echo (!empty($estate_data_option_32)) ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-remove';  ?>"></strong> <?php echo _ch($options_name_32, '-'); ?></small></li>
                    <?php endif; ?>
                <?php endif; ?>

                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <span class="clearfix"></span> 
                                    
                                </div>
                                <?php if(file_exists(APPPATH.'controllers/admin/favorites.php') && sw_count($slideshow_property_images)==0):?>
                                <?php
                                    $favorite_added = false;
                                    if(sw_count($not_logged) == 0)
                                    {
                                        $CI =& get_instance();
                                        $CI->load->model('favorites_m');
                                        $favorite_added = $CI->favorites_m->check_if_exists($this->session->userdata('id'), 
                                                                                            $estate_data_id);
                                        if($favorite_added>0)$favorite_added = true;
                                    }
                                ?>
                                <div class="pull-left favorite clearfix" style="margin-bottom: 20px;">
                                    <a class="btn btn-warning" id="add_to_favorites" href="#" style="<?php echo ($favorite_added)?'display:none;':''; ?>"><i class="icon-star icon-white"></i> <?php echo lang_check('Add to favorites'); ?> <i class="load-indicator"></i></a>
                                    <a class="btn btn-success" id="remove_from_favorites" href="#" style="<?php echo (!$favorite_added)?'display:none;':''; ?>"><i class="icon-star icon-white"></i> <?php echo lang_check('Remove from favorites'); ?> <i class="load-indicator"></i></a>
                                </div>
                                <?php endif; ?>
                                <?php if(sw_count($slideshow_property_images)==0):?>
                                    <?php _widget('custom_property_center_reports');?>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                           
                           
<script>
    
$(document).ready(function(){
        
    $(document).on('click', '.carousel-inner a', function () {
        var myLinks = new Array();
        var current_link = $(this).attr('data-link');
        var curIndex=0;
        $('.carousel-inner a').each(function (i) {
            var img_link = $(this).attr('data-link');
            myLinks[i] = img_link;
            if(current_link == img_link)
                curIndex = i;
        });
        options = {index: curIndex};
        blueimp.Gallery(myLinks,options);
        
        return false;
    });   
    
    if (!$('#blueimp-gallery').length)
    $('body').append('<div id="blueimp-gallery" class="blueimp-gallery">\n\
                     <div class="slides"></div>\n\
                     <h3 class="title"></h3>\n\
                     <a class="prev">&lsaquo;</a>\n\
                     <a class="next">&rsaquo;</a>\n\
                     <a class="close">&times;</a>\n\
                     <a class="play-pause"></a>\n\
                     <ol class="indicator"></ol>\n\
                     </div>');
})
    
</script>                 
                           