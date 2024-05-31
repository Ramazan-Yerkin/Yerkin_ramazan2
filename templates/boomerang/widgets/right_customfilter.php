<?php
/*
Widget-title: Custom search
Widget-preview-image: /assets/img/widgets_preview/right_customfilter.jpg
 */
?>

<!-- FILTERS -->
<div class="panel panel-default panel-sidebar-1 filter-checkbox-container">
    <div class="panel-heading"><h2>{lang_CustomFilters}</h2></div>
    <div class="panel-body">
        <form class="form-light secondary-form">

        <?php if(config_db_item('secondary_disabled') === TRUE): ?>

        <?php if(isset($options_name_19)): ?>
            <div class="form-group">
                <label>{options_name_19}</label>
                <input type="text" option_id="19" class="form-control input_am id_19" placeholder="{options_name_19}" hidefocus="true">
            </div>
        <?php endif; ?>
        <?php if(isset($options_name_20)): ?>
            <div class="form-group">
                <label>{options_name_20}</label>
                <input type="text" option_id="20" class="form-control input_am id_20" placeholder="{options_name_20}" hidefocus="true">
            </div>
        <?php endif; ?>
        <?php if(isset($options_name_36)): ?>
             <div class="row hidden">
                <div class="col-sm-6">
                    <div class="form-group">
                            <label>{lang_Fromprice} </label>
                            <input type="text" option_id="36" rel="from" class="form-control input_am_from id_36_from DECIMAL" placeholder="{lang_Fromprice} ({options_prefix_36}{options_suffix_36})" hidefocus="true">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                            <label>{lang_Toprice} </label>
                            <input type="text" option_id="36" rel="to" class="form-control input_am_from id_36_to DECIMAL" placeholder="{lang_Toprice} ({options_prefix_36}{options_suffix_36})" hidefocus="true">
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(isset($options_name_59)): ?>
            <?php if(config_db_item('search_energy_efficient_enabled') === TRUE): ?>
            <div class="form-group">
            <label>{options_name_59}</label>
            <select option_id="59" rel="to" class="form-control input_am_to id_59_to">
                <option value="">{options_name_59}</option>
                <option value="50">A</option>
                <option value="90">B</option>
                <option value="150">C</option>
                <option value="230">D</option>
                <option value="330">E</option>
                <option value="450">F</option>
                <option value="999999">G</option>
            </select>
            </div>
            <?php endif; ?>
        <?php endif; ?>
            <div class="row form-checkbox">
                <div class="col-sm-6">
                    <div class="form-group">
                       <?php if(isset($options_name_11)): ?> 
                       <label class="checkbox">
                       <input option_id="11" class="checkbox_am" type="checkbox" value="true{options_name_11}" />{options_name_11}
                       </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_22)): ?>
                       <label class="checkbox">
                       <input option_id="22" class="checkbox_am" type="checkbox" value="true{options_name_22}" />{options_name_22}
                       </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_25)): ?>
                       <label class="checkbox">
                       <input option_id="25" class="checkbox_am" type="checkbox" value="true{options_name_25}" />{options_name_25}
                       </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_27)): ?>
                       <label class="checkbox">
                       <input option_id="27" class="checkbox_am" type="checkbox" value="true{options_name_27}" />{options_name_27}
                       </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_28)): ?>
                       <label class="checkbox">
                       <input option_id="28" class="checkbox_am" type="checkbox" value="true{options_name_28}" />{options_name_28}
                       </label>
                       <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <?php if(isset($options_name_29)): ?> 
                        <label class="checkbox">
                        <input option_id="29" class="checkbox_am" type="checkbox" value="true{options_name_29}" />{options_name_29}
                        </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_32)): ?>
                        <label class="checkbox">
                        <input option_id="32" class="checkbox_am" type="checkbox" value="true{options_name_32}" />{options_name_32}
                        </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_30)): ?>
                        <label class="checkbox">
                        <input option_id="30" class="checkbox_am" type="checkbox" value="true{options_name_30}" />{options_name_30}
                        </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_33)): ?>
                        <label class="checkbox">
                        <input option_id="33" class="checkbox_am" type="checkbox" value="true{options_name_33}" />{options_name_33}
                        </label>
                       <?php endif; ?>
                       <?php if(isset($options_name_23)): ?>
                        <label class="checkbox">
                        <input option_id="23" class="checkbox_am" type="checkbox" value="true{options_name_23}" />{options_name_23}
                        </label>
                        <?php endif; ?>
                    </div>
                </div>
            </div>   
           <?php else: ?>
           
           <?php  _search_form_secondary(1); ?>
           <div style="height: 10px; display: block;clear:both;">&nbsp;</div>
           <?php endif; ?>
            
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-block btn-base btn-icon btn-icon-right btn-search refresh_filters">
                        <span>{lang_RefreshResults}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>