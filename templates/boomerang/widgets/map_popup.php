<div class='info-location'>
    <a href="" class="btn-close close-info-location" onclick="$(this).parent().toggle();return false"><i class="close">&times;</i></a>
    <div class='text'>
        <h4 style="max-height: 22px;overflow: hidden;"><?php _che($option_10, ''); ?></h4>
        <img src='<?php echo _simg($thumbnail_url, '90x71'); ?>' width=90>   
        
        <?php if(!empty($option_36)): /* price */ ?>
        <span class="price"> <?php _che($options_prefix_36, ''); ?><?php _che($option_36, ''); ?></span>
        <br/>
        <?php endif;?> 
        
        <?php _che($address, ''); ?>
        <br/><a href='<?php _che($url, ''); ?>' class='btn btn-proper btn-small' style="margin-top:15px;"><?php _l('See Detail'); ?></a>
    </div>
</div>
<div class='arrow-location'></div>