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
                    <div class="col-md-9">
                        <div class="wp-block pg-opt">
                            <h2 class="title">{page_title}</h2>
                        </div>
                        <div class="agent-detail">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="agent-detail-picture">
                                                    <img src="{agent_image_url}" alt="" class="img-responsive">
                                                </div><!-- /.agent-detail-picture -->
                                            </div>

                                            <div class="col-sm-8">
                                                <p>
                <?php
                if(!empty($agent_profile['embed_video_code']))
                {
                    echo $agent_profile['embed_video_code'];
                    echo '<br />';
                }
                ?>
                                                    <?php echo $agent_profile['description']; ?>
                                                </p>
                                                
                                                <p>
                  {has_agent}
                  <div class="agent">
                    <div class="phone"><?php  echo anti_spam_field(_ch($agent_phone)); ?></div>
                    <div class="mail"> <?php  echo anti_spam_field(_ch($agent_mail)); ?></div>
                  </div>
                  {/has_agent}
                                                </p>
                                                <p>
                                                <!-- Example to print all custom fields in list -->
                                                <?php profile_cf_li(); ?>
                                                
                                                <!-- Example to print specific custom field with label -->
                                                <?php //profile_cf_single(1, TRUE); ?>
                                                
                                                </p>
                    <ul class="social social-boxed social-media">
                        <?php if(!empty($agent_profile['facebook_link'])): ?>
                            <li><a href="<?php echo $agent_profile['facebook_link']; ?>"><i class="fa fa-facebook facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($agent_profile['youtube_link'])): ?>
                            <li><a href="<?php echo $agent_profile['youtube_link']; ?>"><i class="fa fa-youtube youtube"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($agent_profile['gplus_link'])): ?>
                            <li><a href="<?php echo $agent_profile['gplus_link']; ?>"><i class="fa fa-google-plus google"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($agent_profile['twitter_link'])): ?>
                            <li><a href="<?php echo $agent_profile['twitter_link']; ?>"><i class="fa fa-twitter twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($agent_profile['linkedin_link'])): ?>
                            <li><a href="<?php echo $agent_profile['linkedin_link']; ?>"><i class="fa fa-linkedin linkedin"></i></a></li>
                        <?php endif; ?>
                    </ul><!-- /.social-->
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.agent-detail -->

                                    <h2><?php _l('Assigned Properties'); ?></h2>
<div id="ajax_results">
    <?php foreach($agent_estates as $key=>$item): ?>
    <?php
        if($key==0)echo '<div class="row">';
    ?>
        <?php _generate_results_item(array('key'=>$key, 'item'=>$item)); ?>
    <?php
        if( ($key+1)%2==0 )
        {
            echo '</div><div class="row">';
        }
        if( ($key+1)==sw_count($agent_estates) ) echo '</div>';
        endforeach;
    ?>   
<div class="row-fluid clearfix text-center">
    <div class="pagination-ajax-results pagination  wp-block default product-list-filters light-gray pagination" rel="ajax_results">
       <?php echo $pagination_links_agent; ?>
    </div>
</div>
</div>

                            </div>
                    <div class="col-md-3">
                        <div class="sidebar">
                                <div class="panel panel-default panel-sidebar-1"  id="form">
                                <div class="panel-heading"><h2>{lang_Enquireform}</h2></div>
                                <form method="post" class="property-form" action="{page_current_url}#form">
                                    <input type="hidden" name="form" value="contact" />
                                    <div class="panel-body">
                                          {validation_errors} {form_sent_message}
                                    <!-- The form name must be set so the tags identify it -->
                                    <input type="hidden" name="form" value="contact" />
                                    
                                    <div class="form-group {form_error_firstname}">
                                        <input class="form-control" id="firstname" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                                    </div>
                                    <div class="form-group {form_error_email}">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />
                                    </div>
                                    <div class="form-group {form_error_phone}">
                                        <input class="form-control" id="phone" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                                    </div>
                                     <div class="form-group {form_error_address}">
                                        <input class="form-control" id="address" name="address" type="text" placeholder="{lang_Address}" value="{form_value_address}" />
                                    </div>
                                    
                                    <div class="form-group {form_error_message}">
                                        <textarea id="message" name="message" rows="1" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                                    </div>
                                    
                                    <?php if(config_item( 'captcha_disabled')===FALSE): ?>
                                    <div class="form-group {form_error_captcha}">
                                        <div class="row">
                                            <div class="col-lg-6" style="padding-top:1px;">
                                                <?php echo $captcha[ 'image']; ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="captcha form-control {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                                                <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                                    <div class="control-group" >
                                        <label class="control-label captcha"></label>
                                        <div class="controls">
                                            <?php _recaptcha(true); ?>
                                       </div>
                                    </div>
                                   <?php endif; ?>
                                    
                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                <?php
                                    $site_url = site_url();
                                    $urlparts = parse_url($site_url);
                                    $basic_domain = $urlparts['host'];
                                    $terms_url = config_db_item('terms_link');
                                    $urlparts = parse_url($terms_url);
                                    $terms_domain ='';
                                    if(isset($urlparts['host']))
                                        $terms_domain = $urlparts['host'];

                                    if($terms_domain == $basic_domain) {
                                        $terms_url = str_replace('en', $lang_code, $terms_url);
                                    }
                                ?>
                                <div class="control-group" style="padding-bottom: 15px;">
                                  <div class="controls">
                                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                                  <a target="_blank" href="<?php echo $terms_url; ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
                                  </div>
                                </div>
                                <?php endif; ?>
                                



                                <?php if(config_db_item('privacy_link') !== FALSE && sw_count($not_logged)>0): ?>
                                                            <?php

                                $site_url = site_url();
                                $urlparts = parse_url($site_url);
                                $basic_domain = $urlparts['host'];
                                $privacy_url = config_db_item('privacy_link');
                                $urlparts = parse_url($privacy_url);
                                $privacy_domain ='';
                                if(isset($urlparts['host']))
                                    $privacy_domain = $urlparts['host'];

                                if($privacy_domain == $basic_domain) {
                                    $privacy_url = str_replace('en', $lang_code, $privacy_url);
                                }
                            ?>
                                <div class="control-group" style="padding-bottom: 15px;">
                                  <div class="controls">
                                    <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                  <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
                                  </div>
                                </div>
                                <?php endif; ?>
                                    </div> 
                                    <button  class="btn btn-lg btn-block-bm btn-alt btn-icon btn-icon-right btn-envelope" type="submit">
                                        <span>{lang_Send}</span>
                                    </button>
                                </form>
                            </div>
                            
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