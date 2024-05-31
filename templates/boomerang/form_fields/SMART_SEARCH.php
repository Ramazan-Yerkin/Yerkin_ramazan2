<div class="col-sm-12">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-lg field_select">
                <input id="search_option_smart" type="text" class="form-control noavtoWidth"   value="{search_query}" placeholder="{lang_CityorCounty}" autocomplete="new-password" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-lg field_select">
                <select id="search_radius" name="search_radius"  class="form-control select_styled base no-padding">
                    <option value="0">0 <?php echo lang_check('km');?></option>
                    <option value="50">50 <?php echo lang_check('km');?></option>
                    <option value="100">100 <?php echo lang_check('km');?></option>
                    <option value="200">200 <?php echo lang_check('km');?></option>
                </select>
            </div>
        </div>
    </div>
</div>