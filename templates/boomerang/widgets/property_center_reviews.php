                        
                        <br style="clear: both;" />
                        
                        <?php if(file_exists(APPPATH.'controllers/admin/swin_reviews.php') && $settings_reviews_enabled): ?>
                            <div id="main">
                        <h2 id="form_review" class="page-header"><?php echo lang_check('YourReview'); ?></h2>
                        <?php if(sw_count($not_logged)): ?>
                        <p class="alert alert-success">
                            <?php echo lang_check('LoginToReview'); ?>
                        </p>
                        <?php else: ?>
                        
                        <?php if($reviews_submitted == 0): ?>
                        <form  class="form-horizontal no-padding " method="post" action="{page_current_url}#form_review">
                        <div class="control-group">
                        <label class="control-label" for="inputRating"><?php echo lang_check('Rating'); ?></label>
                        <div class="controls">
                            <input type="number" data-max="5" data-min="1" name="stars" id="stars" class="rating form-control INPUTBOX" data-empty-value="5" value="5" data-active-icon="icon-star" data-inactive-icon="icon-star-empty" />
                        </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputMessageR"><?php echo lang_check('Message'); ?></label>
                            <div class="controls">
                                <textarea id="inputMessageR" class="form-control TEXTAREA" rows="3" name="message" rows="3" placeholder="{lang_Message}"></textarea>
                            </div>
                        </div>
                        <br style="clear: both;" />
                        <div class="control-group" >
                            <div class="controls">
                                <button type="submit" class="btn"><?php echo lang_check('Send'); ?></button>
                            </div>
                        </div>
                        <br style="clear: both;" />
                        </form>
                        <?php else: ?>
                        <p class="alert alert-info">
                            <?php echo lang_check('ThanksOnReview'); ?>
                        </p>
                        <?php endif; ?>

                        <?php endif; ?>
                        

                        <?php if($settings_reviews_public_visible_enabled): ?>
                        <h2><?php echo lang_check('Reviews'); ?></h2>
                        <div class="box">
                        <?php if(sw_count($not_logged) && !$settings_reviews_public_visible_enabled): ?>
                        <p class="alert alert-success">
                            <?php echo lang_check('LoginToReadReviews'); ?>
                        </p>
                        <?php else: ?>
                        <?php if(sw_count($reviews_all) > 0): ?>
                        <ul class="media-list clearfix">
                        <?php foreach($reviews_all as $review_data): ?>
                        <?php //print_r($review_data); ?>
                        <li class="media clearfix">
                        <div class="pull-left">
                        <?php if(isset($review_data['image_user_filename'])): ?>
                        <img class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="<?php echo base_url('files/thumbnail/'.$review_data['image_user_filename']); ?>" />
                        <?php else: ?>
                        <img class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="assets/img/user-agent.png" />
                        <?php endif; ?>
                        </div>
                        <div class="media-body">
                        <h4 class="media-heading"><div class="review_stars_<?php echo $review_data['stars']; ?>"> </div></h4>
                        <?php if($review_data['is_visible']): ?>
                        <?php echo $review_data['message']; ?>
                        <?php else: ?>
                        <?php echo lang_check('HiddenByAdmin'); ?>
                        <?php endif; ?>
                        </div>
                        </li>
                        <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p class="alert alert-success">
                            <?php echo lang_check('SubmitFirstReview'); ?>
                        </p>
                        <?php endif; ?>
                        <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                        <?php endif; ?>