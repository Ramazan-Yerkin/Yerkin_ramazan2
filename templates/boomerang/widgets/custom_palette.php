<?php if(config_db_item('app_type') == 'demo' || $this->user_m->check_user_type('ADMIN')): ?>
<!-- This section is only for demonstration purpose only. Check out the docs for more informations" -->
<div id="divStyleSwitcher" class="style-switcher-slidebar">
<a href="#" id="cmdShowStyleSwitcher" class="open-panel hidden-xs"><i class="fa fa-cog"></i></a>
<div class="switch-panel">
    <h3><?php _l('Style Builder');?></h3>
    <div class="panel-section">
        <h4 class="title text-uppercase font-normal"><?php _l('Layout options');?></h4>

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label><?php _l('I prefer it');?>:</label> 
                    <select id="cmbLayoutStyle" class="form-control">
                        <option value="1"><?php _l('Fluid');?></option>
                        <option value="2"><?php _l('Boxed');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label></label>
                    <select id="cmbLayoutColor" class="form-control">
                        <option value="1"><?php _l('Light');?></option>
                        <option value="2"><?php _l('Dark');?></option>
                    </select>
                </div>
            </div>
        </div>

        <label class="mt-10"><?php _l('Predefined body backgrounds');?></label>
        <span class="clearfix"></span>
        <span id="cmbBodyBg" class="color-switch">
            <a href="#" id="cmdBodyBg1" class="body-bg-1 ttip" data-toggle="bottom" title="Solid color"></a>
            <a href="#" id="cmdBodyBg2" class="body-bg-2 ttip" data-toggle="bottom" title="Black Lozenge"></a>
            <a href="#" id="cmdBodyBg3" class="body-bg-3 ttip" data-toggle="bottom" title="Squairy Light"></a>
            <a href="#" id="cmdBodyBg4" class="body-bg-4 ttip" data-toggle="bottom" title="Dark Dotted"></a>
            <a href="#" id="cmdBodyBg5" class="body-bg-5 ttip" data-toggle="bottom" title="Skulls"></a>
            <a href="#" id="cmdBodyBg6" class="body-bg-6 ttip" data-toggle="bottom" title="Image Background - 1"></a>
            <a href="#" id="cmdBodyBg7" class="body-bg-7 ttip" data-toggle="bottom" title="Image Background - 2"></a>
            <a href="#" id="cmdBodyBg8" class="body-bg-8 ttip" data-toggle="bottom" title="new 1"></a>
            <a href="#" id="cmdBodyBg9" class="body-bg-9 ttip" data-toggle="bottom" title="new 2"></a>
            <span class="clearfix"></span>
        </span>

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label><?php _l('Section title');?>:</label>
                    <select id="cmbSectionTitleStyle" class="form-control">
                        <option value="1"><?php echo lang_check('Style 1');?></option>
                        <option value="2"><?php echo lang_check('Style 2');?></option>
                        <option value="3"><?php echo lang_check('Style 3');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Color:</label>
                    <select id="cmbSectionTitleColor" class="form-control" disabled="disabled">
                        <option value="1"><?php _l('Base');?></option>
                        <option value="2"><?php _l('Alt Base');?></option>
                        <option value="3"><?php _l('Light');?></option>
                        <option value="4"><?php _l('Dark');?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>   

    <hr> 
<!--
    <div class="panel-section">
        <h4 class="title text-uppercase font-normal"><?php _l('Header options');?></h4> 

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label><?php _l('Header');?>:</label>
                    <select id="cmbHeaderStyle" class="form-control">
                        <option value="2">Header 1: Default navbar</option>
                        <option value="3">Header 2: Default navbar + Top header</option>
                        <option value="1">Header 3: Header + Navbar</option>
                        <option value="4">Header 4: Cover</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label><?php _l('Top header color');?>:</label>
                    <select id="cmbTopHeaderColor" class="form-control" disabled="disabled">
                        <option value="1"><?php _l('Light');?></option>
                        <option value="2"><?php _l('Dark');?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>     
-->
    <div class="panel-section">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label><?php _l('Nav shadow');?></label>
                    <select id="cmbNavShadow" class="form-control">
                        <option value="1"><?php _l('No');?></option>
                        <option value="2"><?php _l('Yes');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label><?php _l('Dropdown arrow');?>:</label>
                    <select id="cmbNavDropdownArrow" class="form-control">
                        <option value="2"><?php _l('Yes');?></option>
                        <option value="1"><?php _l('No');?></option>
                    </select>
                </div>
            </div>          
        </div>
    </div>   

    <hr>

    <div class="panel-section">
        <h4 class="title text-uppercase font-normal"><?php _l('Color options');?></h4>

        <label><?php _l('Predefined colors');?></label>
        <span class="clearfix"></span>
        <span class="color-switch color-template">
            <a href="#" id="cmdSchemeRed" class="color-red" color='red' title="Red"><?php _l('Red');?></a>
            <a href="#" id="cmdSchemeViolet" class="color-violet" color='violet' title="Violet"><?php _l('Violet');?></a>
            <a href="#" id="cmdSchemeBlue" class="color-blue" color='blue' title="Blue"><?php _l('Blue');?></a>
            <a href="#" id="cmdSchemeGreen" class="color-green" color='green' title="Green"><?php _l('Green');?></a>
            <a href="#" id="cmdSchemeYellow" class="color-yellow" color='yellow' title="Yellow"><?php _l('Yellow');?></a>
            <a href="#" id="cmdSchemeOrange" class="color-orange" color='orange' title="Orange"><?php _l('Orange');?></a>
        </span>
    </div>

    <hr>

    <div class="panel-section">
        <h4 class="title">
            <span class="text-uppercase font-normal"><?php _l('Special');?></span> 
            <a href="#" class="pop" title="About customization" data-content="We created some examples that show you the multitude of options you have so you make this template as you wish. <br><br>Customization is very easy and it is made in only one file.">
                <i class="fa fa-question-circle"></i>
            </a>
            <label class="badge base pull-right"><?php _l('New');?></label>
        </h4>

        <label><?php _l('Predefined schemes');?></label>
        <span class="clearfix"></span>
        <span class="color-switch  color-template">
            <a href="#" id="cmdSchemeBW" class="color-bw ttip" data-toggle="top" color='bw' title="Black & White"><?php _l('Black and white');?></a>
            <a href="#" id="cmdSchemeDark" class="color-dark ttip" data-toggle="top"  color='dark' title="Dark"><?php _l('Dark');?></a>
            <a href="#" id="cmdSchemeFlat" class="color-flat ttip" data-toggle="top" color='flat' title="Flat"><?php _l('Flat');?></a>
        </span>

    
    <?php if($this->session->userdata('type') == 'ADMIN' && config_db_item('app_type') != 'demo'): ?>
    <button id="design-save" type="button" class="btn btn-primary btn-inversed btn-block" style="margin-top: 10px;">&nbsp;&nbsp;{lang_Save}&nbsp;&nbsp</button>                         
        
<script type="text/javascript">
$(document).ready(function() {
    $('#design-save').click(function() {
        var color= '';
        if($('#divStyleSwitcher .color-switch a.active').length) {
            var color = $('#divStyleSwitcher .color-switch.color-template a.active').attr('color');
        }
        var data = { design_parameters: $('body').attr('class'), css_variant: $('#wpStylesheet').attr('href'),color: color };
        
        var load_indicator = $(this).find('.load-indicator');
        load_indicator.css('display', 'inline-block');
        $.post("{api_private_url}/design_save/{lang_code}", data, 
               function(data){
            
            ShowStatus.show(data.message);
                            
            load_indicator.css('display', 'none');
        });

        return false;
    });
});
        </script>
    <?php endif; ?>
        <button id="design-reset" type="button" class="btn btn-primary btn-inversed btn-block" style="margin-top:15px;">&nbsp;&nbsp;<?php echo lang_check('Reset default');?>&nbsp;&nbsp</button>                         
    <div class="panel-section mt-15 hide">
        <a href="#"><span><?php echo lang_check('Reset all applied styles');?></span></a>
        <br><br>
    </div>
</div>
</div>
</div>
<?php endif;?>