<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans("add_currency"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('currency-settings'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= trans("currencies"); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/addCurrencyPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("currency_name"); ?></label>
                        <input type="text" class="form-control" name="name" placeholder="Ex: US Dollar" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("currency_code"); ?></label>
                        <input type="text" class="form-control" name="code" placeholder="Ex: USD" maxlength="99" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("currency_symbol"); ?></label>
                        <input type="text" class="form-control" name="symbol" placeholder="Ex: $" maxlength="99" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans('currency_format'); ?> (Thousands Seperator)</label>
                        <?= formRadio('currency_format', 'us', 'european', '1,234,567.89','1.234.567,89', 'us'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("currency_symbol_format"); ?></label>
                        <?= formRadio('symbol_direction', 'left', 'right', '$100 ('.trans("left").')', '100$ ('.trans("right").')', 'left'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("add_space_between_money_currency"); ?></label>
                        <?= formRadio('space_money_symbol', 1, 0, trans("yes"), trans("no"), '0'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('status', 1, 0, trans("active"), trans("inactive"), 1); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_currency'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>