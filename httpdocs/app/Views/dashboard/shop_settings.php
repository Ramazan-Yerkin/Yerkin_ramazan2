<div class="row">
    <div class="col-sm-12">
        <?= view('dashboard/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= esc($title); ?></h3>
                </div>
            </div>
            <div class="box-body">
                <form action="<?= base_url('shop-settings-post'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="control-label"><?= trans("shop_name"); ?></label>
                        <input type="text" name="shop_name" class="form-control form-input" value="<?= esc(getUsername(user())); ?>" placeholder="<?= trans("shop_name"); ?>" maxlength="<?= $baseVars->usernameMaxlength; ?>" <?= !isAdmin() && $generalSettings->vendors_change_shop_name != 1 ? 'readonly' : ''; ?>>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans("shop_description"); ?></label>
                        <textarea name="about_me" class="form-control form-textarea" placeholder="<?= trans("shop_description"); ?>"><?= esc(user()->about_me); ?></textarea>
                    </div>
                    <?php if ($generalSettings->rss_system == 1): ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label><?= trans('rss_feeds'); ?></label>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="show_rss_feeds" value="1" id="show_rss_feeds_1" class="custom-control-input" <?= user()->show_rss_feeds == 1 ? 'checked' : ''; ?>>
                                        <label for="show_rss_feeds_1" class="custom-control-label"><?= trans("enable"); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="show_rss_feeds" value="0" id="show_rss_feeds_2" class="custom-control-input" <?= user()->show_rss_feeds != 1 ? 'checked' : ''; ?>>
                                        <label for="show_rss_feeds_2" class="custom-control-label"><?= trans("disable"); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="show_rss_feeds" value="<?= user()->show_rss_feeds; ?>">
                    <?php endif; ?>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" value="update" class="btn btn-md btn-success"><?= trans("save_changes") ?></button>
                    </div>
                </form>
            </div>
        </div>
        <?php if ($paymentSettings->vat_status == 1): ?>
            <div class="box">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?= trans('vat'); ?>&nbsp;(<?= trans("vat_exp"); ?>)</h3><br>
                        <small><?= trans("vat_vendor_dashboard_exp"); ?></small>
                    </div>
                </div>
                <div class="box-body">
                    <form action="<?= base_url('shop-settings-post'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_fixed_vat" id="set_fixed_vat_rate_all_countries" value="1" class="custom-control-input" <?= user()->is_fixed_vat == 1 ? 'checked' : ''; ?>>
                                <label for="set_fixed_vat_rate_all_countries" class="custom-control-label"><?= trans("set_fixed_vat_rate_all_countries"); ?></label>
                            </div>
                        </div>
                        <div id="vendorFixedtVatRate" class="form-group" <?= user()->is_fixed_vat != 1 ? 'style="display: none;"' : ''; ?>>
                            <label class="control-label"><?= trans("tax_rate"); ?>(%)</label>
                            <input type="number" name="fixed_vat_rate" min="0" max="99.99" step="0.01" class="form-control w-200" value="<?= user()->fixed_vat_rate; ?>" placeholder="0.00">
                        </div>
                        <div id="vendorVatRates" class="vendor-vat-rates m-t-30" <?= user()->is_fixed_vat == 1 ? 'style="display: none;"' : ''; ?>>
                            <div class="vendor-vat-rate display-flex align-items-center">
                                <div class="flex-item">
                                    <strong><?= trans("country"); ?></strong>
                                </div>
                                <div class="flex-item">
                                    <strong><?= trans("tax_rate"); ?>(%)</strong>
                                </div>
                            </div>
                            <?php if (!empty($activeCountries)):
                                $userVatRatesArray = unserializeData(user()->vat_rates_data);
                                foreach ($activeCountries as $item): ?>
                                    <div class="vendor-vat-rate display-flex align-items-center">
                                        <div class="flex-item">
                                            <span><?= esc($item->name); ?></span>
                                        </div>
                                        <div class="flex-item">
                                            <input type="number" name="vat_rate_<?= esc($item->id); ?>" min="0" max="99.99" step="0.01" value="<?= !empty($userVatRatesArray[$item->id]) ? $userVatRatesArray[$item->id] : 0; ?>" class="form-control" placeholder="0.00">
                                        </div>
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" name="submit" value="vat" class="btn btn-md btn-success"><?= trans("save_changes") ?></button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-sm-6">
        <?php if ($generalSettings->membership_plans_system == 1): ?>
            <div class="box">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?= trans("membership_plan"); ?></h3>
                    </div>
                </div>
                <?php if (isSuperAdmin()): ?>
                    <div class="box-body">
                        <div class="alert alert-info alert-large">
                            <?= trans("warning_membership_admin_role"); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="box-body">
                        <?php if (!empty($userPlan)): ?>
                            <div class="form-group">
                                <label class="control-label"><?= trans("current_plan"); ?></label><br>
                                <?php $plan = null;
                                if (!empty($userPlan->plan_id)) {
                                    $plan = getMembershipPlan($userPlan->plan_id);
                                }
                                if (empty($plan)):?>
                                    <p class="label label-success label-user-plan"><?= esc($userPlan->plan_title); ?></p>
                                <?php else: ?>
                                    <p class="label label-success label-user-plan"><?= esc(getMembershipPlanTitle($plan)); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("plan_expiration_date"); ?></label><br>
                                <?php if ($userPlan->is_unlimited_time): ?>
                                    <p class="text-success"><?= trans("unlimited"); ?></p>
                                <?php else: ?>
                                    <p><?= formatDate($userPlan->plan_end_date); ?>&nbsp;<span class="text-danger">(<?= ucfirst(trans("days_left")); ?>:&nbsp;<?= $daysLeft < 0 ? 0 : $daysLeft; ?>)</span></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("number_remaining_ads"); ?></label><br>
                                <?php if ($userPlan->is_unlimited_number_of_ads): ?>
                                    <p class="text-success"><?= trans("unlimited"); ?></p>
                                <?php else: ?>
                                    <p><?= esc($adsLeft); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if (user()->is_membership_plan_expired == 1): ?>
                                <div class="form-group text-center">
                                    <p class="label label-danger label-user-plan"><?= trans("msg_plan_expired"); ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="form-group text-center">
                                <a href="<?= generateUrl('select_membership_plan'); ?>" class="btn btn-md btn-block btn-slate m-t-30" style="padding: 10px 12px;"><?= trans("renew_your_plan") ?></a>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <p><?= trans("do_not_have_membership_plan"); ?></p>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?= generateUrl('select_membership_plan'); ?>" class="btn btn-md btn-block btn-slate m-t-30" style="padding: 10px 12px;"><?= trans("select_your_plan") ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($userPlan) && $userPlan->is_unlimited_time != 1): ?>
                <div class="alert alert-info alert-large">
                    <strong><?= trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("msg_expired_plan"); ?>
                </div>
            <?php endif;
        endif;
        if ($paymentSettings->cash_on_delivery_enabled == 1): ?>
            <div class="box">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?= trans("cash_on_delivery"); ?></h3><br>
                        <small><?= trans("cash_on_delivery_vendor_exp"); ?></small>
                    </div>
                </div>
                <div class="box-body">
                    <form action="<?= base_url('shop-settings-post'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="cash_on_delivery" value="1" id="cash_on_delivery_1" class="custom-control-input" <?= user()->cash_on_delivery == 1 ? 'checked' : ''; ?>>
                                        <label for="cash_on_delivery_1" class="custom-control-label"><?= trans("enable"); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="cash_on_delivery" value="0" id="cash_on_delivery_2" class="custom-control-input" <?= user()->cash_on_delivery != 1 ? 'checked' : ''; ?>>
                                        <label for="cash_on_delivery_2" class="custom-control-label"><?= trans("disable"); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label><?= trans("transaction_fee"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><?= $defaultCurrency->symbol; ?></span>
                                <input type="text" name="cash_on_delivery_fee" class="form-control form-input price-input" value="<?= getPrice(user()->cash_on_delivery_fee, 'input'); ?>" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32">
                            </div>
                        </div>-->
                        <input type="hidden" name="cash_on_delivery_fee" value="0">
                        <div class="form-group text-right">
                            <button type="submit" name="submit" value="cash_on_delivery" class="btn btn-md btn-success"><?= trans("save_changes") ?></button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).on("change", "#set_fixed_vat_rate_all_countries", function () {
        if ($(this).is(":checked")) {
            $('#vendorFixedtVatRate').show();
            $('#vendorVatRates').hide();
        } else {
            $('#vendorFixedtVatRate').hide();
            $('#vendorVatRates').show();
        }
    });
</script>