                        <!-- PROPERTY DESCRIPTION -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabs-framed boxed">
                                    <ul class="tabs clearfix">
                                        <li class="active"><a href="#tab-1" data-toggle="tab"><?php _l('Additional details');?></a></li>
                                        <li><a href="#tab-map" data-toggle="tab" data-type="gmap"><?php _l('Map');?></a></li>
                                        <?php if(!empty($estate_data_option_36) && file_exists(FCPATH.'templates/'.$settings_template.'/widgets/right_mortgage.php')): ?>
                                        <li><a href="#tab-mortgage" data-toggle="tab" data-type="gmap"><?php _l('Mortgage'); ?></a></li>
                                        <?php endif; ?>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab-1">
                                            <div class="tab-body">
                                                <div class="section-title-wr">
                                                    <h3 class="section-title left">{lang_Description}</h3>
                                                </div>
                                                <p>
                                                    <?php _che($estate_data_option_17, '<p class="alert alert-success">'.lang_check('Not available').'</p>'); ?>
                                                </p>
                                                <br/>
                                                <?php
                                                /* check if some value defined in category */
                                                function is_defined_category ($array = NULL) {
                                                    if($array === NULL) return false;
                                                    $flag = false;
                                                    foreach ($array as $v) {
                                                        if(!empty($v['is_checkbox'])) {
                                                            $flag = true;
                                                            break;
                                                        } elseif(!empty($v['is_text'])) {
                                                            $flag = true;
                                                            break;
                                                        } elseif(!empty($v['is_dropdown'])) {
                                                            $flag = true;
                                                            break;
                                                        } 
                                                    }
                                                    return $flag;
                                                }
                                                function is_defined_category_din ($array = NULL) {
                                                    if($array === NULL) return false;
                                                    $flag = false;
                                                    foreach ($array as $v) {
                                                        if(!empty($v['is_checkbox'])) {
                                                            $flag = true;
                                                            break;
                                                        } elseif(!empty($v['is_text'])) {
                                                            $flag = true;
                                                            break;
                                                        } elseif(!empty($v['is_dropdown'])) {
                                                            $flag = true;
                                                            break;
                                                        } elseif(!empty($v['is_tree'])) {
                                                            $flag = true;
                                                            break;
                                                        } 
                                                    }
                                                    return $flag;
                                                }
                                                ?>
                                                
                                                <?php if(isset($category_options_111) && $category_options_count_111>0 && !empty($category_options_111) && is_defined_category($category_options_111)): ?>
                                                <h3 class="page-header">{options_name_111}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_111}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-sm-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_111}
                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>
                                                <?php if(isset($category_options_100) && $category_options_count_100>0 && !empty($category_options_100) && is_defined_category($category_options_100)): ?>
                                                <h3 class="page-header">{options_name_100}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_100}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-sm-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_100}
                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>
                                                <?php if(isset($category_options_105) && $category_options_count_105>0 && !empty($category_options_105) && is_defined_category($category_options_105)): ?>
                                                <h3 class="page-header">{options_name_105}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_105}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-sm-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_105}
                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>
                                                
                                                <?php if(false): ?>
                                                <div class="section-title-wr">
                                                    <h3 class="section-title left">Additional details</h3>
                                                </div>
                                                <table class="table table-bordered table-striped table-hover table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Property Size:</strong> 2300 Sq Ft</td>
                                                            <td><strong>Lot size:</strong> 5000 Sq Ft</td>
                                                            <td><strong>Price:</strong> $23000</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Rooms:</strong> 5</td>
                                                            <td><strong>Bedrooms:</strong> 4</td>
                                                            <td><strong>Bathrooms:</strong> 2</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Garages:</strong> 2</td>
                                                            <td><strong>Roofing:</strong> New</td>
                                                            <td><strong>Structure Type:</strong> Bricks</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Year built:</strong> 1991</td>
                                                            <td><strong>Available from:</strong> 1 August 2014</td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php endif;?>
                                                

                                                <?php if(isset($category_options_21) && $category_options_count_21>0 && is_defined_category($category_options_21)): ?>
                                                <h3 class="page-header">{options_name_21}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_21}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-sm-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_21}

                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>

                                                <?php if(isset($category_options_52) && $category_options_count_52>0 && is_defined_category($category_options_52)): ?>
                                                <h3 class="page-header">{options_name_52}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_52}
                                                        {is_checkbox}
                                                        <li class="col-xs-6 col-sm-3">
                                                        <i class="fa fa-check ok"></i>&nbsp;&nbsp;{option_name}&nbsp;&nbsp;{icon}
                                                        </li>
                                                        {/is_checkbox}
                                                        {/category_options_52}
                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>

                                                <?php if(isset($category_options_43) && $category_options_count_43>0 && is_defined_category($category_options_43)): ?>
                                                <h3 class="page-header">{options_name_43}</h3>
                                                <div class="property-amenities clearfix">
                                                    <ul>
                                                        {category_options_43}
                                                        {is_text}
                                                        <li class="col-xs-6 col-sm-3">
                                                        <i class="fa fa-check ok"></i>{icon} {option_name}:&nbsp;&nbsp;{option_prefix}{option_value}{option_suffix}
                                                        </li>
                                                        {/is_text}
                                                        {/category_options_43}

                                                    </ul>
                                                </div><!-- /.property-amenities -->
                                                <?php endif; ?>
                                                
                                                
                                                <?php
                                                /* Show new categories */
                                                
                                                $CI = &get_instance();
                                                $CI->load->model('option_m');
                                                $categories = $CI->option_m->get_by(array('type'=>'CATEGORY'));
                                                /* skip categories */
                                                $already_exists_categories = array(1,66,21,52,43,9,42,42,43,111,100,105);
                                                foreach ($categories as $key => $value):
                                                    if(in_array($value->id, $already_exists_categories)) continue;
                                                    $category_id = $value->id;
                                                    ?>
                                                    <?php if(isset(${"category_options_$category_id"}) && ${"category_options_count_$category_id"}>0 && is_defined_category_din(${"category_options_$category_id"})): ?>
                                                    <h3 class="page-header"><?php echo ${"options_name_$category_id"} ?></h3>
                                                    <div class="property-amenities clearfix">
                                                        <ul>
                                                            <?php foreach(${"category_options_$category_id"} as $key=>$row): ?>
                                                            <?php if(!empty($row['option_value'])): ?>
                                                                <?php if(sw_count($row['is_text']) > 0): ?>
                                                                <li class="col-xs-6 col-sm-3">
                                                                    <i class="fa fa-check ok"></i><?php _che($row['icon'], ''); ?> <?php _che($row['option_name']); ?>:&nbsp;&nbsp;<?php echo _che($row['option_prefix']); ?> <?php echo _che($row['option_value']); ?> <?php echo _che($row['option_suffix']); ?>
                                                                </li>
                                                                <?php elseif(sw_count($row['is_checkbox']) > 0): ?>
                                                                <li class="col-xs-6 col-sm-3">
                                                                    <i class="fa fa-check ok"></i>&nbsp;&nbsp;<?php _che($row['option_name']); ?>&nbsp;&nbsp;<?php _che($row['icon'], ''); ?>
                                                                </li>
                                                                <?php elseif(sw_count($row['is_dropdown']) > 0): ?>
                                                                <li class="col-xs-6 col-sm-3">
                                                                    <i class="fa fa-check ok"></i><?php _che($row['icon'], ''); ?> <?php _che($row['option_name']); ?>:&nbsp;&nbsp;<?php echo _che($row['option_prefix']); ?> <?php echo _che($row['option_value']); ?> <?php echo _che($row['option_suffix']); ?>
                                                                </li>
                                                                <?php elseif(sw_count($row['is_tree']) > 0): ?>
                                                                <li class="col-xs-6 col-sm-6">
                                                                    <i class="fa fa-check ok"></i><?php _che($row['icon'], ''); ?> <?php _che($row['option_name']); ?>:&nbsp;&nbsp;<?php echo _che($row['option_prefix']); ?> <?php echo _che($row['option_value']); ?> <?php echo _che($row['option_suffix']); ?>
                                                                </li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div><!-- /.property-amenities -->
                                                    <?php endif; ?>
                                                <?php endforeach; 
                                                /* END Show new categories */
                                                ?>
                                                
                                            </div> 
                                        </div>

                                        <div class="tab-pane fade" id="tab-map">
                                            <div class="tab-body">
                                                <?php _widget('custom_property_center_map');?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-mortgage">
                                            <div class="tab-body">
                                                <?php _widget('right_mortgage');?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>