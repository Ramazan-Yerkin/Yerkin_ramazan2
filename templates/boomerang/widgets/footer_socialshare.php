<?php
/*
Widget-title: Social links
Widget-preview-image: /assets/img/widgets_preview/footer_socialshare.jpg
 */
?>

<div class="col-md-4">
    <div class="col">
        <h4><?php _l('Follow us');?></h4>
        <ul class="clearfix sharing-buttons">
            <li class="no-margin">
                <a class="facebook" href="https://www.facebook.com/share.php?u={page_current_url}&title={settings_websitetitle}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <i class="fa fa-facebook fa-left no-margin"></i>
                </a>
            </li>
            <li class="no-margin">
                <a class="twitter"  href="https://twitter.com/home?status={settings_websitetitle}%20{page_current_url}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <i class="fa fa-twitter fa-left no-margin"></i>
                </a>
            </li>
        </ul>
    </div>
</div>