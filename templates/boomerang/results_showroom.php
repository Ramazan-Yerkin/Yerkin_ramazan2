<ul class="list-listings blog-list">
    <!-- Standard image post example -->
    <?php foreach($showroom_module_all as $key=>$row):?> 
    <li class="">
        <div class="listing-image">
            <?php if(file_exists(FCPATH.'files/thumbnail/'.$row->image_filename)):?>
            <img src="<?php echo _simg('files/'.$row->image_filename, '300x185'); ?>" />
            <?php else:?>
                <img style="height:300px;width:185px" src="assets/img/no_image.jpg" alt="new-image">
            <?php endif;?>
        </div>
        <div class="listing-body">
            <h3><a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>"><?php echo $row->title; ?></a></h3>
            <span class="list-item-info">
               <!-- Posted January 03, 2014-->
            </span>
            <p>
                <?php echo $row->description; ?>
            </p>
            <p>
                <a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>" class="btn btn-sm btn-base pull-right">{lang_Details}</a>
            </p>
        </div>
    </li>
    <?php endforeach;?>
</ul>

<!-- Pagination -->
<div class="pagination-delimiter">
    <?php echo $showroom_pagination; ?>
</div>