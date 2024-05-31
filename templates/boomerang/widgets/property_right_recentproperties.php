<!-- RECENTLY VIEWED -->
<div class="panel panel-default panel-sidebar-1">
    <div class="panel-heading"><h2><?php _l('Lastaddedproperties'); ?></h2></div>
    <div class="panel-body">
        <ul class="featured featured-vertical">
            <?php foreach($last_estates as $item): ?>
            <li class="wp-block-property"> 
                 <div class="wp-block-img">
                    <img src="<?php echo _simg($item['thumbnail_url'], '380x250'); ?>" alt="<?php _che($item['alt']); ?>">
                    <a href="<?php echo $item['url']; ?>"></a>
                 </div>
                <div class="featured-content">
                    <h3 class="title">
                        <a href="<?php echo $item['url']; ?>" hidefocus="true"><?php echo _ch($item['address']); ?></a>
                    </h3>
                    <span class="star-rating">
                        <?php
                        if( !empty($item['option_56'])):
                            for($i=0; $i<$item['option_56']; $i++):?>
                                <i class="fa fa-star"></i>
                           <?php endfor;
                        endif;
                        ?>
                    </span>
                    <div class="table no-margin">
                        <div class="price-wr width-50">
                            <span class="price">
                            <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                            <?php 
                                if(!empty($item['option_36']))echo $options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36;
                                if(!empty($item['option_37']))echo ' '.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37
                            ?>
                            <?php else: ?>
                            <?php endif; ?>
                            </span> 
                        </div>
                       <!-- <div class="">
                            <span class="capacity">
                                <i class="fa fa-user"></i>
                                <i class="fa fa-user"></i>
                                <i class="fa fa-user"></i>
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                       -->
                    </div>
                </div> 
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>