<?php
/*
Widget-title: Search
Widget-preview-image: /assets/img/widgets_preview/top_search.jpg
*/
?>

<section class="slice bg-white ">
        <div class="container">
            <div class="wp-section relative">
                <form class="form-inline form-base search-form">
                    <div class="inline-form-filters base">
                        <!-- Optional filters tigger button -->
                        <!--<a href="#" id="btnToggleOptionalFIlters" data-animate-in="animated fadeInDown" data-animate-out="animated fadeOutUp" class="optional-form-filters-trigger" title="Toggle advanced search"></a> -->

                        <!-- Main filters -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-group-lg search_option_smart-select">
                                    <label class="sr-only"><?php echo _l('Search text');?></label>
                                     <input id="search_option_smart" type="text" class="form-control input-lg" value='<?php _che($search_query); ?>' placeholder="{lang_CityorCounty}">
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-lg field_select">
                                    <label class="sr-only"><?php _che(${'options_name_2'}); ?></label>
                                    <select id="search_option_2" class="form-control select_styled base no-padding">
                                        <?php _che(${'options_values_2'}); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-lg field_select">
                                     <label class="sr-only"><?php _che(${'options_name_4'}); ?></label>
                                    <select id="search_option_4" class="form-control select_styled base no-padding">
                                        <?php _che(${'options_values_4'}); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-lg field_select">
                                     <label class="sr-only"><?php _che(${'options_name_3'}); ?></label>
                                    <select id="search_option_3" class="form-control select_styled base no-padding">
                                        <?php _che(${'options_values_3'}); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a href="#"  id="search-start" class="btn btn-lg btn-block btn-alt btn-icon btn-icon-right btn-icon-go">
                                    <span>{lang_Search}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                 </form>
            </div>
        </div>
    </section>
           