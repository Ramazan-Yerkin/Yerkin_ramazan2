<?php if(!empty($settings_facebook_comments)): ?>
<br style="clear: both;" />
<div class="wp-block pg-opt">
<h2 class="title"><?php echo lang_check('Facebook comments'); ?></h2>
</div>
<?php echo str_replace('http://example.com/comments', $page_current_url, $settings_facebook_comments); ?>
<?php endif;?>




