<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= trans('payout_settings'); ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("paypal"); ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('payout_paypal_enabled', 1, 0, trans("enable"), trans("disable"), $paymentSettings->payout_paypal_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('min_poyout_amount'); ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_paypal" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_paypal, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="paypal" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("bitcoin"); ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('payout_bitcoin_enabled', 1, 0, trans("enable"), trans("disable"), $paymentSettings->payout_bitcoin_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('min_poyout_amount'); ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_bitcoin" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_bitcoin, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="bitcoin" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('iban'); ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('payout_iban_enabled', 1, 0, trans("enable"), trans("disable"), $paymentSettings->payout_iban_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('min_poyout_amount'); ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_iban" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_iban, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="iban" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('swift'); ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('payout_swift_enabled', 1, 0, trans("enable"), trans("disable"), $paymentSettings->payout_swift_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('min_poyout_amount'); ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_swift" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_swift, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="swift" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>