<?php
/*
Widget-title: Slider with Search
Widget-preview-image: /assets/img/widgets_preview/top_slidersearch.jpg
*/
?>

<section class="slice no-padding bb resize-block save-form">
        <div class="wp-section">
            <div class="container-fluid no-padding">
                <div class="row-fluid">
                    <div class="">
                        <!-- JumboTron -->
                        <div class="jumbotron <?php echo (config_item('slider_full_width') == TRUE) ? 'slider_full_width' : '';?>">
                            <div id="homepageCarousel" class="carousel carousel-1 phone-sup carousel-fixed-height slide jumbotron-left" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach($slideshow_images as $key=>$file): ?>
                                    <div class="item item-dark <?php echo ($key==0) ? 'active' : '';?>" style="background-image:url(<?php echo _simg($file['url'], '1800x600'); ?>);">
                                        <img src="<?php echo _simg($file['url'], '1800x600'); ?>" alt="" class="img">
                                        <?php if(config_item('property_slider_enabled')===TRUE&&!empty($file['property_details'])):?>
                                        <div class="mask mask-1"></div>
                                        <div class="container">
                                             <div class="description-left">
                                                 <span class="title c-white text-uppercase strong-700"><?php _che($file['property_details']['title']);?></span>
                                                 <span class="subtitle-sm"><?php _che($file['property_details']['option_chlimit_8']);?></span>
                                                 <a href="<?php _che($file['property_details']['link']);?>" class="btn btn-lg btn-white btn-icon fa-eye">
                                                     <span><?php echo _l('Read more');?></span>
                                                 </a>
                                             </div>
                                        </div> 
                                        <?php elseif(!empty($file['title'])): ?>
                                        <div class="mask mask-1"></div>
                                        <div class="container">
                                             <div class="description-left">
                                                <span class="title c-white text-uppercase strong-700"><?php _che($file['title']);?></span>
                                                <span class="subtitle-sm"><?php _che($file['description']);?></span>
                                                 <?php if(!empty($file['link'])):?>
                                                 <a href="<?php _che($file['link']);?>" class="btn btn-lg btn-white btn-icon fa-eye">
                                                     <span><?php echo _l('Read more');?></span>
                                                 </a>
                                                <?php endif; ?>
                                             </div>
                                        </div>                     
                                        <?php endif; ?>
                                    </div> 
                                    <?php endforeach;?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#homepageCarousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right carousel-control" href="#homepageCarousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>     
                            </div>
                            <div class="jumbotron-right">
                                <!-- FIND property list WIDGET -->
                                <div class="panel panel-base no-margin">
                                    <form class="form-base search-form" >
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="panel-heading panel-heading-lg clearfix form-field">
                                                    <div class="form-group form-group-lg field_select">
                                                        <input id="search_option_quick" type="text" class="form-control noavtoWidth" placeholder="<?php echo lang_check('Quick search');?>" value="{search_query}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class=""><?php _che(${'options_name_2'}); ?></label>
                                                        <select id="search_option_2" class="form-control select_styled base no-padding">
                                                            <?php _che(${'options_values_2'}); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class=""><?php _che(${'options_name_4'}); ?></label>
                                                        <select id="search_option_4" class="form-control select_styled base no-padding">
                                                            <?php _che(${'options_values_4'}); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group search_option_smart-select">
                                                <input id="search_option_smart" type="text" class="form-control input-lg" value='<?php _che($search_query); ?>' placeholder="{lang_CityorCounty}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class="">{lang_Fromprice}</label>
                                                        <select id="search_option_36_from" name="search_option_36_from" class="form-control select_styled base no-padding">
                                                            <option value="0">-</option>
                                                            <option value="2000">$2000</option>
                                                            <option value="3000">$3000</option>
                                                            <option value="4000">$4000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg field_select">
                                                        <label class="">{lang_Toprice}</label>
                                                        <select id="search_option_36_to" name="search_option_36_to" class="form-control select_styled base no-padding">
                                                            <option value="0">-</option>
                                                            <option value="3000">$30000</option>
                                                            <option value="4000">$40000</option>
                                                            <option value="50000">$50000</option>
                                                            <option value="60000">$60000</option>
                                                            <option value="70000">$70000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="advanced-form-part hidden">
                                            <div class="form-row-space"></div>
                                            <!--
                                            <input id="search_option_36_from" type="text" class="span3 mPrice" placeholder="{lang_Fromprice} ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_from'); ?>" />
                                            <input id="search_option_36_to" type="text" class="span3 xPrice" placeholder="{lang_Toprice} ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_to'); ?>" />
                                            -->
                                            <input id="search_option_19" type="text" class="span3 Bathrooms" placeholder="{options_name_19}" value="<?php echo search_value(19); ?>" />
                                            <input id="search_option_20" type="text" class="span3" placeholder="{options_name_20}" value="<?php echo search_value(20); ?>" />
                                            <div class="form-row-space"></div>
                                            <?php if(file_exists(APPPATH.'controllers/admin/booking.php')):?>
                                            <input id="booking_date_from" type="text" class="span3 mPrice" placeholder="{lang_Fromdate}" value="<?php echo search_value('date_from'); ?>" />
                                            <input id="booking_date_to" type="text" class="span3 xPrice" placeholder="{lang_Todate}" value="<?php echo search_value('date_to'); ?>" />
                                            <div class="form-row-space"></div>
                                            <?php endif; ?>
                                            <?php if(config_db_item('search_energy_efficient_enabled') === TRUE): ?>
                                            <select id="search_option_59_to" class="span3 selectpicker nomargin">
                                                <option value="">{options_name_59}</option>
                                                <option value="50">A</option>
                                                <option value="90">B</option>
                                                <option value="150">C</option>
                                                <option value="230">D</option>
                                                <option value="330">E</option>
                                                <option value="450">F</option>
                                                <option value="999999">G</option>
                                            </select>
                                            <div class="form-row-space"></div>
                                            <?php endif; ?>
                                            <label class="checkbox">
                                            <input id="search_option_11" type="checkbox" class="span1" value="true{options_name_11}" <?php echo search_value('11', 'checked'); ?>/>{options_name_11}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_22" type="checkbox" class="span1" value="true{options_name_22}" <?php echo search_value('22', 'checked'); ?>/>{options_name_22}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_25" type="checkbox" class="span1" value="true{options_name_25}" <?php echo search_value('25', 'checked'); ?>/>{options_name_25}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_27" type="checkbox" class="span1" value="true{options_name_27}" <?php echo search_value('27', 'checked'); ?>/>{options_name_27}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_28" type="checkbox" class="span1" value="true{options_name_28}" <?php echo search_value('28', 'checked'); ?>/>{options_name_28}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_29" type="checkbox" class="span1" value="true{options_name_29}" <?php echo search_value('29', 'checked'); ?>/>{options_name_29}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_32" type="checkbox" class="span1" value="true{options_name_32}" <?php echo search_value('32', 'checked'); ?>/>{options_name_32}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_30" type="checkbox" class="span1" value="true{options_name_30}" <?php echo search_value('30', 'checked'); ?>/>{options_name_30}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_33" type="checkbox" class="span1" value="true{options_name_33}" <?php echo search_value('33', 'checked'); ?>/>{options_name_33}
                                            </label>
                                            <label class="checkbox">
                                            <input id="search_option_23" type="checkbox" class="span1" value="true{options_name_23}" <?php echo search_value('23', 'checked'); ?>/>{options_name_23}
                                            </label>
                                        </div>

                                        <button  id="search-start" type="submit" class="btn btn-xl btn-block-bm btn-alt btn-icon btn-icon-right btn-icon-go btn-square">
                                            <span>{lang_Search}</span>
                                        </button>
                                        <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')): ?>
                                            <button id="search-save" type="button" class="btn btn-info"><i class="icon-bookmark"></i>{lang_SaveResearch}</button>
                                        <?php endif; ?>
                                    </form>
                             
                                </div>
                                <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')): ?>
                                    <button id="search-save" type="button" class="btn btn-info"><i class="icon-bookmark"></i>{lang_SaveResearch}</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>