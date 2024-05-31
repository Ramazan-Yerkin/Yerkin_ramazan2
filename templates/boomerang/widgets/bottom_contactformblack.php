<?php
/*
Widget-title: Contact form parallax
Widget-preview-image: /assets/img/widgets_preview/bottom_contactformblack.jpg
*/
?>

<section class="prlx-bg inset-shadow-1" data-stellar-ratio="2" style="min-height: 500px; height: auto; padding: 30px 0;">
    <!-- Section mask -->
    <div class="mask mask-1"></div>
    <div class="container">

        <div class="section-title-wr">
            <h3 class="section-title center" id="form">
                <span class="c-white">{lang_Contactform}</span>
            </h3>
        </div>

        <!-- Contact form -->
        <?php if(sw_count($has_settings_email) > 0): ?>
        <form method="post" class="form-dark" action="{page_current_url}#form">
            <div class="box-panel box-panel-alert" style="position: relative;">
                <?php _che($validation_errors); ?>
                <?php _che($form_sent_message); ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-group-lg {form_error_email}">
                        <label class="sr-only">{lang_FirstLast}</label>
                        <input type="text" id="firstname" name="firstname" class="form-control input-lg" placeholder="{lang_FirstLast}" hidefocus="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg  {form_error_email}">
                        <label class="sr-only">{lang_Email}</label>
                        <input type="email"  id="email" name="email"  class="form-control input-lg" placeholder="{lang_Email}" hidefocus="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lgp {form_error_phone}">
                        <label class="sr-only">{lang_Phone}</label>
                        <input type="text" id="phone" name="phone"  class="form-control input-lg" placeholder="{lang_Phone}" hidefocus="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if(config_item('captcha_disabled') === FALSE): ?>
                        <div class="row">
                            <div class="col-md-6" style="padding-top:22px;">
                                <?php echo $captcha[ 'image']; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {form_error_captcha}">
                                    <label> </label>
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

                </div>
            </div>      
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group  {form_error_message}">
                        <label class="sr-only">{lang_Message}</label>
                        <textarea  id="message" name="message" class="form-control" placeholder="{lang_Message} ..." rows="5"></textarea>
                    </div>
                </div>
            </div>   
            <div class="row">

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
                <div class="col-md-6">
                <div class="control-group" style="padding-bottom: 15px;">
                  <div class="controls">
                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                    <a target="_blank" href="<?php echo $terms_url; ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
                  </div>
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
                <div class="col-md-6">
                <div class="control-group" style="padding-bottom: 15px;">
                  <div class="controls">
                    <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                  <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
                  </div>
                </div>
                </div>
                <?php endif; ?>
            </div>   
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="tn btn-lg btn-dark">
                        <span>{lang_Send}</span>
                    </button>
                </div>
            </div>     
        </form>
        <?php endif;?>
        <!-- Social Media Icons -->
        <div class="social-media social-media-lg text-center mt-40">
            <a href="#" data-url='{homepage_url}' data-title='{settings_websitetitle}' class="btn-share-fb"><i class="fa fa-facebook facebook"></i></a>
            <a href="#" data-url='{homepage_url}' data-title='{settings_websitetitle}' class="btn-share-tw"><i class="fa fa-twitter twitter"></i></a>
        </div>
    </div>
</section>