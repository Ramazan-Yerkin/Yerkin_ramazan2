<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('pricing'); ?></h3>
            </div>
            <form action="<?= base_url('Product/featuredProductsPricingPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= trans('price_per_day'); ?></label>
                        <div class="input-group">
                            <input type="text" name="price_per_day" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->price_per_day, 'input'); ?>" placeholder="0.00" onpaste="return false;" maxlength="32" required>
                            <span class="input-group-addon"><?= esc($defaultCurrency->code); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('price_per_month'); ?></label>
                        <div class="input-group">
                            <input type="text" name="price_per_month" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->price_per_month, 'input'); ?>" placeholder="0.00" onpaste="return false;" maxlength="32" required>
                            <span class="input-group-addon"><?= esc($defaultCurrency->code); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= trans("free_promotion"); ?></label>
                        <?= formRadio('free_product_promotion', 1, 0, trans("enable"), trans("disable"), $paymentSettings->free_product_promotion); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>