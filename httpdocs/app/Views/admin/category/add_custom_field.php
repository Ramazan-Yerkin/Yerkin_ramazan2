<div class="row">
    <div class="col-sm-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans('add_custom_field'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('custom-fields'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= trans('custom_fields'); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Category/addCustomFieldPost'); ?>" method="post" onkeypress="return event.keyCode != 13;">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><?= trans("field_name"); ?></label>
                                <?php foreach ($activeLanguages as $language): ?>
                                    <input type="text" class="form-control m-b-5" name="name_lang_<?= $language->id; ?>" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label><?= trans("row_width"); ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="row_width" value="half" id="row_width_1" class="custom-control-input" checked>
                                            <label for="row_width_1" class="custom-control-label"><?= trans("half_width"); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="row_width" value="full" id="row_width_2" class="custom-control-input">
                                            <label for="row_width_2" class="custom-control-label"><?= trans("full_width"); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= trans("required"); ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="is_required" value="1" id="is_required_1" class="custom-control-input" checked>
                                            <label for="is_required_1" class="custom-control-label"><?= trans("yes"); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="is_required" value="0" id="is_required_2" class="custom-control-input">
                                            <label for="is_required_2" class="custom-control-label"><?= trans("no"); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= trans("where_to_display"); ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="where_to_display" value="2" id="where_to_display_1" class="custom-control-input" checked>
                                            <label for="where_to_display_1" class="custom-control-label"><?= trans("additional_information"); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="where_to_display" value="1" id="where_to_display_2" class="custom-control-input">
                                            <label for="where_to_display_2" class="custom-control-label"><?= trans("product_details"); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= trans("status"); ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="status" value="1" id="status_1" class="custom-control-input" checked>
                                            <label for="status_1" class="custom-control-label"><?= trans("active"); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="status" value="0" id="status_2" class="custom-control-input">
                                            <label for="status_2" class="custom-control-label"><?= trans("inactive"); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= trans('order'); ?></label>
                                <input type="number" class="form-control" name="field_order" placeholder="<?= trans('order'); ?>" min="1" max="99999" value="1" required>
                            </div>
                            <div class="form-group">
                                <label><?= trans('type'); ?></label>
                                <select class="form-control" name="field_type">
                                    <option value="text"><?= trans('text'); ?></option>
                                    <option value="textarea"><?= trans('textarea'); ?></option>
                                    <option value="number"><?= trans('number'); ?></option>
                                    <option value="checkbox"><?= trans('checkbox'); ?></option>
                                    <option value="radio_button"><?= trans('radio_button'); ?></option>
                                    <option value="dropdown"><?= trans('dropdown'); ?></option>
                                    <option value="date"><?= trans('date'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_and_continue'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>