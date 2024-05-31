<?php
/*
Widget-title: Ads
Widget-preview-image: /assets/img/widgets_preview/right_adssmall.jpg
 */
?>

<!-- RECENTLY VIEWED -->
<?php if(file_exists(APPPATH.'controllers/admin/ads.php')):?>
<div class="panel panel-default panel-sidebar-1">
    {has_ads_180x150px}
    <div class="panel-heading"><h2>{lang_Ads}</div>
    <div class="panel-body" style="text-align: center;">
          <a href="{random_ads_180x150px_link}" target="_blank"><img src="{random_ads_180x150px_image}" /></a>
    </div>
  {/has_ads_180x150px}
</div>

<?php elseif(!empty($settings_adsense160_600)): ?>
<div class="panel panel-default panel-sidebar-1">
    <div class="panel-heading"><h2>{lang_Ads}</h2></div>
    <div class="panel-body"  style="text-align: center;">
          <?php echo $settings_adsense160_600; ?>
    </div>
</div>
<?php endif; ?>
