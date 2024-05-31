<?php
/*
Widget-title: 5x Latest news
Widget-preview-image: /assets/img/widgets_preview/bottom_recentnews2.jpg
*/
?>

<section class="slice animate-hover-slide bg-white bb">
    <div class="wp-section">
        <div class="container">
            <div class="section-title-wr">
                <h3 class="section-title center">
                    <span>{lang_Latestnews}</span>
                </h3>
            </div>
            <div class="row">
                <?php foreach($news_module_latest_5 as $key=>$row):?> 
                <div class="col-md-3">
                    <div class="wp-block default">
                        <div class="figure">
                            <img alt="" src="<?php echo _simg('files/'.$row->image_filename, '260x185'); ?>" class="img-responsive">
                            <?php
                            $month = date("M", strtotime($row->date_publish));
                            ?>
                            <span class="wp-block-date-over alpha"><strong><?php echo _l('cal_'.strtolower($month));?> <?php echo date("d", strtotime($row->date_publish));?></strong></span>
                            <div class="figcaption bg-base"></div>
                            <div class="figcaption-btn">
                                <a href="<?php echo base_url('files/'.$row->image_filename) ;?>" class="btn btn-xs btn-b-white theater"><i class="fa fa-plus-circle"></i><?php echo _l('Zoom');?></a>
                                <a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>" class="btn btn-xs btn-b-white"><i class="fa fa-link"></i><?php echo _l('View');?></a>
                            </div>
                        </div>
                        <div class="wp-block-body">
                            <h2 class="title"><a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>"><?php echo $row->title; ?></a></h2>
                            <p>
                                <?php echo $row->description; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>