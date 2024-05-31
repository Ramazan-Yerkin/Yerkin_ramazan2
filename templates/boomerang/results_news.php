<ul class="list-listings blog-list">
    <!-- Standard image post example -->
    <?php foreach($news_module_all as $key=>$row):?> 
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

<!-- Pagination -->
<div class="pagination product-list-filters wp-block news">
    <?php echo $news_pagination; ?>
</div>