<?php
/*
Widget-title: 5x Latest news
Widget-preview-image: /assets/img/widgets_preview/bottom_recentnews2.jpg
*/
?>

<div class="center-news clearfix">
    <div class="section-title-wr pg-opt style-title" style="">
        <h2 class="section-title left section-title-min"><span>{lang_Latestnews}</span></h2>
    </div>
    <ul class="list-listings blog-list" style="margin-top:25px;">

        <!-- Standard image post example -->
        <?php foreach($news_module_latest_5 as $key=>$row):?> 
        <li class="">
            <div class="listing-image">
                <a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>">
                <?php if(file_exists(FCPATH.'files/thumbnail/'.$row->image_filename)):?>
                <img src="<?php echo _simg('files/'.$row->image_filename, '300x185'); ?>" />
                <?php else:?>
                    <img style="height:300px;width:185px" src="assets/img/no_image.jpg" alt="new-image">
                <?php endif;?>
                </a> 
            </div>
            <div class="listing-body">
                <h3><a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>"><?php echo $row->title; ?></a></h3>
                <span class="list-item-info">
                    <?php _l('Posted');?>  <?php echo date("Y-m-d", strtotime($row->date_publish));?>
                </span>
                <p>
                    <?php echo $row->description; ?>
                </p>
                <p>
                    <a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>" class="btn btn-sm btn-base pull-right">{lang_Details}</a>
                </p>
            </div>
        </li>
        <?php endforeach;?>
    </ul>
</div>