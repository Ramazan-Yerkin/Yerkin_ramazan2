<?php
/*
Widget-title: Carouse with featured properties
Widget-preview-image: /assets/img/widgets_preview/bottom_featuredproperties.jpg
*/
?>

<section class="slice relative bg-white bb animate-hover-slide">
     <div class="wp-section">
         <div class="container">
             <div class="section-title-wr">
                 <h3 class="section-title left"><span><?php echo _l('Featured');?></span></h3>
             </div>

                 <?php if(sw_count($featured_properties)>4): ?>
                 <div id="carouselWork" class="carousel carousel-3 slide animate-hover-slide" data-interval="false">
                 <div class="carousel-nav">
                     <a data-slide="prev" class="left" href="#carouselWork"><i class="fa fa-angle-left"></i></a>
                     <a data-slide="next" class="right" href="#carouselWork"><i class="fa fa-angle-right"></i></a>
                 </div>
                <?php else:?>
                  <div id="carouselWork" class="carousel-3 slide animate-hover-slide">
                <?php endif;?>
                 <!-- Wrapper for slides -->
                 <div class="carousel-inner">
                     
                            <!-- PROPERTY LISTING -->
                            <?php foreach($featured_properties as $key=>$item): ?>
                            <?php
                                if($key==0)echo '<div class="item active"><div class="row">';
                            ?>
                            
                            <div class="col-md-3">
                                 <div class="wp-block inverse">
                                     <div class="figure">
                                         <img alt="" src="<?php echo _simg($item['thumbnail_url'], '400x250'); ?>" class="img-responsive">
                                         <div class="figcaption bg-base"></div>
                                         <div class="figcaption-btn">
                                             <a href="<?php echo str_replace('thumbnail/', '', $item['thumbnail_url']); ?>" class="btn btn-xs btn-b-white theater"><i class="fa fa-plus-circle"></i> <?php echo _l('Zoom');?></a>
                                             <a href="<?php echo $item['url']; ?>" class="btn btn-xs btn-b-white"><i class="fa fa-link"></i><?php echo _l('View');?></a>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-xs-9">
                                             <h2 class="text-left"> 
                                                <a href="<?php echo $item['url']; ?>">
                                                   <?php echo _ch($item['option_10']); ?>
                                                </a>
                                             </h2>
                                             <small>
                                                <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                                                <?php 
                                                    if(!empty($item['option_36']))echo $options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36;
                                                    if(!empty($item['option_37']))echo ' '.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37
                                                ?>
                                                <?php else: ?>
                                                <?php endif; ?>
                                             </small>
                                         </div>
                                         <div class="col-xs-3">
                                             <div class="like-button">
                                                 <span class="button liked">
                                                     <i class="fa fa-heart"></i>
                                                 </span>
                                                 <span class="count"><small><?php echo _ch($item['counter_views']); ?></small></span>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                                    
                            <?php
                                if( ($key+1)%4==0 )
                                {
                                    echo '</div></div><div class="item"><div class="row">';
                                }
                                if( ($key+1)==sw_count($featured_properties) ) echo '</div></div>';
                                endforeach;
                            ?>

                 </div>
             </div>  
         </div>
     </div>
 </section>

<script type="text/javascript">
$('document').ready(function(){
    $('#carouselWork').carousel({
        <?php if(sw_count($featured_properties)>4): ?>
            pause: "hover",
            interval: 10000
        <?php else:?>
            interval: false
        <?php endif;?>
    });
})   
</script>
