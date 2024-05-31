<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= trans('product_settings'); ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('marketplace'); ?><br><small><?= trans("add_product_for_sale"); ?></small></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= trans('sku'); ?></label>
                        <?= formCheckbox('marketplace_sku', 1, trans('enable'), $productSettings->marketplace_sku); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('variations'); ?></label>
                        <?= formCheckbox('marketplace_variations', 1, trans('enable'), $productSettings->marketplace_variations); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('shipping'); ?></label>
                        <?= formCheckbox('marketplace_shipping', 1, trans('enable'), $productSettings->marketplace_shipping); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('location'); ?></label>
                        <?= formCheckbox('marketplace_product_location', 1, trans('enable'), $productSettings->marketplace_product_location); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="marketplace" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('classified_ads'); ?><br><small><?= trans("add_product_services_listing"); ?></small></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= trans('price'); ?></label>
                        <?= formCheckbox('classified_price', 1, trans('enable'), $productSettings->classified_price); ?>
                        <?= formCheckbox('classified_price_required', 1, trans('required'), $productSettings->classified_price_required); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('location'); ?></label>
                        <?= formCheckbox('classified_product_location', 1, trans('enable'), $productSettings->classified_product_location); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('external_link'); ?></label>
                        <?= formCheckbox('classified_external_link', 1, trans('enable'), $productSettings->classified_external_link); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="classified_ads" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('physical_products'); ?></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= trans('demo_url'); ?></label>
                        <?= formCheckbox('physical_demo_url', 1, trans('enable'), $productSettings->physical_demo_url); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('video_preview'); ?></label>
                        <?= formCheckbox('physical_video_preview', 1, trans('enable'), $productSettings->physical_video_preview); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('audio_preview'); ?></label>
                        <?= formCheckbox('physical_audio_preview', 1, trans('enable'), $productSettings->physical_audio_preview); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="physical_products" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('digital_products'); ?></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= trans('demo_url'); ?></label>
                        <?= formCheckbox('digital_demo_url', 1, trans('enable'), $productSettings->digital_demo_url); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('video_preview'); ?></label>
                        <?= formCheckbox('digital_video_preview', 1, trans('enable'), $productSettings->digital_video_preview); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('audio_preview'); ?></label>
                        <?= formCheckbox('digital_audio_preview', 1, trans('enable'), $productSettings->digital_audio_preview); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('external_download_link'); ?></label>
                        <?= formCheckbox('digital_external_link', 1, trans('enable'), $productSettings->digital_external_link); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('allowed_file_extensions'); ?></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <input id="input_digital_allowed_file_extensions" type="text" name="digital_allowed_file_extensions" value="<?= str_replace('"', '', $productSettings->digital_allowed_file_extensions); ?>" class="form-control tags"/>
                                <small>(<?= trans('type_extension'); ?>&nbsp;E.g. zip, jpg, doc, pdf..)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="digital_products" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .form-group .option-label {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: normal !important;
    }

    #input_digital_allowed_file_extensions_tag {
        width: auto !important;
    }
</style>

<script>
    $(function () {
        $('#input_digital_allowed_file_extensions').tagsInput({width: 'auto', 'defaultText': ''});
    });
</script>
