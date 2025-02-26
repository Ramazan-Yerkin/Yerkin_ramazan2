                            <div class="panel panel-default panel-sidebar-1"  id="">         
                                <div class="panel-heading"><h2>{lang_Overview}</h2></div>
                                  <div class="property_options">
                                      <div class="panel-row"> 
                                    <p class="bottom-border"><strong>
                                    {lang_Address}
                                    </strong> <span>{estate_data_address}</span>
                                    <br style="clear: both;" />
                                    </p></div>
                                    {category_options_1}
                                    {is_text}
                                    <div class="panel-row"> 
                                        <p class="bottom-border"><strong>{option_name}:</strong> <span>{option_prefix} {option_value} {option_suffix}</span><br style="clear: both;" /></p>
                                    </div>
                                    {/is_text}
                                    {is_dropdown}
                                    <div class="panel-row"> 
                                        <p class="bottom-border"><strong>{option_name}:</strong> <span class="label label-success">{option_value}</span></p>
                                    </div>
                                    {/is_dropdown}
                                    {is_checkbox}
                                    <div class="panel-row"> 
                                        <img src="assets/img/checkbox_{option_value}.png" alt="{option_value}" />{option_name}
                                    </div>
                                    {/is_checkbox}
                                    {/category_options_1}
                                    <?php if(!empty($estate_data_option_64)): ?>
                                    <div class="panel-row"> 
                                        <p class="bottom-border">
                                            <strong><?php echo $options_name_64; ?>:</strong>
                                            <span>
                                            <?php
                                                $nice_path = $estate_data_option_64;
                                                $link_defined = false;
                                                // Get treefield with language data
																								$CI = &get_instance();
																								$CI->load->model('treefield_m');
                                                $treefield_id = $CI->treefield_m->id_by_path(64, $lang_id, $nice_path);
                                                if(is_numeric($treefield_id))
                                                {
                                                    $treefield_data =$CI->treefield_m->get_lang($treefield_id, TRUE, $lang_id);

                                                    // If no content defined then no link, just span
                                                    if(!empty($treefield_data->{"body_$lang_id"}))
                                                    {
                                                        // If slug then define slug link
                                                        $href = slug_url('treefield/'.$lang_code.'/'.$treefield_id.'/'.url_title_cro($treefield_data->{"value_$lang_id"}), 'treefield_m');
                                                        echo '<a href="'.$href.'">'.$nice_path.'</a>';
                                                        $link_defined=true;
                                                    }
                                                }
                                                if(!$link_defined) echo $nice_path;
                                            ?>
                                            </span>
                                            <br style="clear: both;" />
                                        </p>
                                    </div>
                                    <?php endif;?>
                                    <?php
                                        foreach($category_options_1 as $key=>$row)
                                        {
                                            if($row['option_type'] == 'UPLOAD')
                                            {
                                                if(!empty($row['option_value']) && is_numeric($row['option_value']))
                                                {
                                                    //Fetch repository
                                                    $rep_id = $row['option_value'];
                                                    $file_rep = $this->file_m->get_by(array('repository_id'=>$rep_id));
                                                    $rep_value = '';
                                                    if(sw_count($file_rep))
                                                    {
                                                        $rep_value.= '<ul>';
                                                        foreach($file_rep as $file_r)
                                                        {
                                                            $rep_value.= "<li><a target=\"_blank\" href=\"".base_url('files/'.$file_r->filename)."\">$file_r->filename</a></li>";
                                                        }
                                                        $rep_value.= '</ul></div>';

                                                        echo '<div class="panel-row"><p class="bottom-border"><strong>'.$row['option_name'].':</strong></p>';
                                                        echo $rep_value;
                                                    }
                                                }
                                            }

                                        }
                                    ?>

                                    <?php if(!empty($estate_data_counter_views)): ?>
                                    <div class="panel-row"> 
                                    <p class="bottom-border">
                                        <strong>{lang_ViewsCounter}:</strong>
                                        <span>{estate_data_counter_views}</span>
                                    </p>
                                    </div>
                                    <?php endif;?>

                                    <?php if(!empty($estate_data_option_56)): ?>
                                    <div class="panel-row"> 
                                    <p class="bottom-border">
                                        <strong>{lang_Pro}:</strong>
                                        <span class=" pull-right review_stars_<?php echo $estate_data_option_56; ?>"> </span>
                                    </p>
                                    </div>
                                    <?php endif;?>

                                    <?php if(!empty($avarage_stars) && file_exists(APPPATH.'controllers/admin/swin_reviews.php') && $settings_reviews_enabled): ?>
                                    <div class="panel-row"> 
                                    <p class="bottom-border">
                                        <strong>{lang_Users}:</strong>
                                        <span class="pull-right review_stars_<?php echo $avarage_stars; ?>"> </span>
                                    </p>
                                    </div>
                                    <?php endif;?>
                                    
                                    <?php if(FALSE):?>
                                    <p style="text-align:right;">
                                        <a target="_blank" type="button" class="btn" href="{estate_data_printurl}"><i class="icon-print"></i>&nbsp;{lang_PrintVersion}</a>
                                    </p>
                                    <?php endif;?>
                                  </div>
                                </div> 