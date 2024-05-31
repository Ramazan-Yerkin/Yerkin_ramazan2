{has_agent}
<div id="agents-block" class="section-title-wr pg-opt" style="padding-bottom: 15px;">
    <h3 class="section-title left"><span>
            <?php if(isset($agent_profile) && $agent_profile['type']=='USER'):?>
                <?php echo lang_check('Owner');?>
            <?php else: ?>
                {lang_Agent}
            <?php endif;?>
    </span></h3>
</div>
<div class="panel">
    <div class="wp-block testimonial style-1 base right-agents">
        <div class="testimonial-author light">  
            <div class="author-img">
                <a href="{agent_url}">
                    <img src="{agent_image_url}" alt="<?php  _che($agent_name_surname);?>">
                </a>
            </div>
            <div class="author-info">
                <span class="author-name"><a href="{agent_url}"><?php  _che($agent_name_surname);?></a></span>
                <small class="author-pos"><?php  echo anti_spam_field(_ch($agent_phone)); ?></small>
                <small class="author-pos"><?php  echo anti_spam_field(_ch($agent_mail)); ?></small>
            
                <!-- Example to print specific custom field with label -->
                <?php //profile_cf_single(1, TRUE); ?>
            </div>
        </div>
    </div>
</div>
{/has_agent}