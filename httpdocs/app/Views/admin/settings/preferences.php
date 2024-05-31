<div class="row" style="margin-bottom: 15px;">
    <div class="col-sm-12">
        <h3 style="font-size: 18px; font-weight: 600;margin-top: 10px;"><?= trans('preferences'); ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("system"); ?></h3>
            </div>
            <form action="<?= base_url('Admin/preferencesPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("physical_products"); ?></label>
                        <?= formRadio('physical_products_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->physical_products_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("digital_products"); ?></label>
                        <?= formRadio('digital_products_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->digital_products_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("marketplace_selling_product_on_the_site"); ?></label>
                        <?= formRadio('marketplace_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->marketplace_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("classified_ads_adding_product_as_listing"); ?></label>
                        <?= formRadio('classified_ads_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->classified_ads_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("bidding_system_request_quote"); ?></label>
                        <?= formRadio('bidding_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->bidding_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("selling_license_keys"); ?></label>
                        <?= formRadio('selling_license_keys_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->selling_license_keys_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans('multi_vendor_system'); ?></label>
                        <small style="font-size: 13px;">(<?= trans("multi_vendor_system_exp"); ?>)</small>
                        <?= formRadio('multi_vendor_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->multi_vendor_system); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('timezone'); ?></label>
                        <select name="timezone" class="form-control">
                            <?php $timezones = timezone_identifiers_list();
                            if (!empty($timezones)):
                                foreach ($timezones as $timezone):?>
                                    <option value="<?= $timezone; ?>" <?= $timezone == $generalSettings->timezone ? 'selected' : ''; ?>><?= $timezone; ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="system" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('general'); ?></h3>
            </div>
            <form action="<?= base_url('Admin/preferencesPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("multilingual_system"); ?></label>
                        <?= formRadio('multilingual_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->multilingual_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("rss_system"); ?></label>
                        <?= formRadio('rss_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->rss_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans('vendor_verification_system'); ?></label>
                        <small><?= "(" . trans('vendor_verification_system_exp') . ")"; ?></small>
                        <?= formRadio('vendor_verification_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->vendor_verification_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_vendor_contact_information"); ?></label>
                        <?= formRadio('show_vendor_contact_information', 1, 0, trans("yes"), trans("no"), $generalSettings->show_vendor_contact_information); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("guest_checkout"); ?></label>
                        <?= formRadio('guest_checkout', 1, 0, trans("enable"), trans("disable"), $generalSettings->guest_checkout); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("search_by_location"); ?></label>
                        <?= formRadio('location_search_header', 1, 0, trans("enable"), trans("disable"), $generalSettings->location_search_header); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("pwa"); ?></label>
                        <?= formRadio('pwa_status', 1, 0, trans("enable"), trans("disable"), $generalSettings->pwa_status); ?>
                    </div>
                    <div class="alert alert-info alert-large m-t-10">
                        <strong><?= trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("pwa_warning"); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="general" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('products'); ?></h3>
            </div>
            <form action="<?= base_url('Admin/preferencesPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("approve_before_publishing"); ?></label>
                        <?= formRadio('approve_before_publishing', 1, 0, trans("yes"), trans("no"), $generalSettings->approve_before_publishing); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("featured_products_system"); ?></label>
                        <?= formRadio('promoted_products', 1, 0, trans("enable"), trans("disable"), $generalSettings->promoted_products); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("vendor_bulk_product_upload"); ?></label>
                        <?= formRadio('vendor_bulk_product_upload', 1, 0, trans("enable"), trans("disable"), $generalSettings->vendor_bulk_product_upload); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_sold_products_on_site"); ?></label>
                        <?= formRadio('show_sold_products', 1, 0, trans("yes"), trans("no"), $generalSettings->show_sold_products); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("product_link_structure"); ?></label>
                        <?= formRadio('product_link_structure', 'slug-id', 'id-slug', 'domain.com/slug-id', 'domain.com/id-slug', $generalSettings->product_link_structure); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("reviews"); ?></label>
                        <?= formRadio('reviews', 1, 0, trans("enable"), trans("disable"), $generalSettings->reviews); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("product_comments"); ?></label>
                        <?= formRadio('product_comments', 1, 0, trans("enable"), trans("disable"), $generalSettings->product_comments); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("blog_comments"); ?></label>
                        <?= formRadio('blog_comments', 1, 0, trans("enable"), trans("disable"), $generalSettings->blog_comments); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("comment_approval_system"); ?></label>
                        <?= formRadio('comment_approval_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->comment_approval_system); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="products" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('shop'); ?></h3>
            </div>
            <form action="<?= base_url('Admin/preferencesPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("allow_vendors_change_shop_name"); ?></label>
                        <?= formRadio('vendors_change_shop_name', 1, 0, trans("yes"), trans("no"), $generalSettings->vendors_change_shop_name); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_customer_email_seller"); ?></label>
                        <?= formRadio('show_customer_email_seller', 1, 0, trans("yes"), trans("no"), $generalSettings->show_customer_email_seller); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_customer_phone_number_seller"); ?></label>
                        <?= formRadio('show_customer_phone_seller', 1, 0, trans("yes"), trans("no"), $generalSettings->show_customer_phone_seller); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("request_documents_vendors"); ?></label>
                        <?= formRadio('request_documents_vendors', 1, 0, trans("yes"), trans("no"), $generalSettings->request_documents_vendors); ?>
                    </div>
                    <?php if ($generalSettings->request_documents_vendors == 1): ?>
                        <div class="form-group">
                            <label class="control-label"><?= trans("input_explanation"); ?>&nbsp;(E.g. ID Card)</label>
                            <textarea class="form-control" name="explanation_documents_vendors"><?= str_replace('<br/>', '\n', $generalSettings->explanation_documents_vendors); ?></textarea>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="shop" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('file_upload'); ?></h3>
                </div>
                <div class="box-body" style="min-height: 270px;">
                    <div class="form-group">
                        <label><?= trans("image_file_format"); ?></label>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 m-b-5">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="image_file_format" value="JPG" id="image_file_format_1" class="custom-control-input" <?= $productSettings->image_file_format == 'JPG' ? 'checked' : ''; ?>>
                                    <label for="image_file_format_1" class="custom-control-label">JPG</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 m-b-5">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="image_file_format" value="WEBP" id="image_file_format_2" class="custom-control-input" <?= $productSettings->image_file_format == 'WEBP' ? 'checked' : ''; ?>>
                                    <label for="image_file_format_2" class="custom-control-label">WEBP</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 m-b-5">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="image_file_format" value="PNG" id="image_file_format_3" class="custom-control-input" <?= $productSettings->image_file_format == 'PNG' ? 'checked' : ''; ?>>
                                    <label for="image_file_format_3" class="custom-control-label">PNG</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 m-b-5">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="image_file_format" value="original" id="image_file_format_4" class="custom-control-input" <?= $productSettings->image_file_format == 'original' ? 'checked' : ''; ?>>
                                    <label for="image_file_format_4" class="custom-control-label"><?= trans("keep_original_file_format"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?= trans("product_image_upload"); ?></label>
                        <?= formRadio('is_product_image_required', 1, 0, trans("required"), trans("optional"), $productSettings->is_product_image_required); ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= trans('product_image_upload_limit'); ?></label>
                        <input type="number" name="product_image_limit" class="form-control" value="<?= $productSettings->product_image_limit; ?>" min="1" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('max_file_size') . ' (' . trans("image") . ')'; ?></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="number" name="max_file_size_image" value="<?= round(($productSettings->max_file_size_image / 1048576), 2); ?>" min="1" class="form-control" aria-describedby="basic-addon1" required>
                                    <span class="input-group-addon" id="basic-addon1">MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('max_file_size') . ' (' . trans("video") . ')'; ?></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="number" name="max_file_size_video" value="<?= round(($productSettings->max_file_size_video / 1048576), 2); ?>" min="1" class="form-control" aria-describedby="basic-addon2" required>
                                    <span class="input-group-addon" id="basic-addon2">MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('max_file_size') . ' (' . trans("audio") . ')'; ?></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="number" name="max_file_size_audio" value="<?= round(($productSettings->max_file_size_audio / 1048576), 2); ?>" min="1" class="form-control" aria-describedby="basic-addon3" required>
                                    <span class="input-group-addon" id="basic-addon3">MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="file_upload" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>