<?php $activeTab = inputGet('gateway');
if (empty($activeTab)):
    $activeTab = 'paypal';
endif;

$stripeLocales = ['auto' => 'Auto', 'ar' => 'Arabic', 'bg' => 'Bulgarian (Bulgaria)', 'cs' => 'Czech (Czech Republic)', 'da' => 'Danish', 'de' => 'German (Germany)', 'el' => 'Greek (Greece)',
    'en' => 'English', 'en-GB' => 'English (United Kingdom)', 'es' => 'Spanish (Spain)', 'es-419' => 'Spanish (Latin America)', 'et' => 'Estonian (Estonia)', 'fi' => 'Finnish (Finland)',
    'fr' => 'French (France)', 'fr-CA' => 'French (Canada)', 'he' => 'Hebrew (Israel)', 'id' => 'Indonesian (Indonesia)', 'it' => 'Italian (Italy)', 'ja' => 'Japanese', 'lt' => 'Lithuanian (Lithuania)',
    'lv' => 'Latvian (Latvia)', 'ms' => 'Malay (Malaysia)', 'nb' => 'Norwegian Bokmål', 'nl' => 'Dutch (Netherlands)', 'pl' => 'Polish (Poland)', 'pt' => 'Portuguese (Brazil)', 'ru' => 'Russian (Russia)',
    'sk' => 'Slovak (Slovakia)', 'sl' => 'Slovenian (Slovenia)', 'sv' => 'Swedish (Sweden)', 'zh' => 'Chinese Simplified (China)']; ?>
<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= trans('payment_settings'); ?></h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url('Admin/paymentGatewaySettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="active_tab" id="input_active_tab" value="<?= clrNum($activeTab); ?>">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php if (!empty($paymentGateways)):
                        foreach ($paymentGateways as $gateway):?>
                            <li class="<?= $activeTab == $gateway->name_key ? ' active' : ''; ?>"><a href="<?= adminUrl('payment-settings'); ?>?gateway=<?= $gateway->name_key; ?>"><?= esc($gateway->name); ?></a></li>
                        <?php endforeach;
                    endif; ?>
                    <li class="<?= $activeTab == 'bank_transfer' ? ' active' : ''; ?>"><a href="<?= adminUrl('payment-settings'); ?>?gateway=bank_transfer"><?= trans("bank_transfer"); ?></a></li>
                    <li class="<?= $activeTab == 'cash_on_delivery' ? ' active' : ''; ?>"><a href="<?= adminUrl('payment-settings'); ?>?gateway=cash_on_delivery"><?= trans("cash_on_delivery"); ?></a></li>
                </ul>
                <form action="<?= base_url('Admin/paymentGatewaySettingsPost'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="tab-content settings-tab-content">
                        <div class="tab-pane<?= $activeTab == 'paypal' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paypal'):
                                $paypal = getPaymentGateway('paypal');
                                if (!empty($paypal)):?>
                                    <input type="hidden" name="name_key" value="paypal">
                                    <img src="<?= base_url('assets/img/payment/paypal.svg'); ?>" alt="paypal" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $paypal->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?= trans("mode"); ?></label>
                                        <?= formRadio('environment', 'production', 'sandbox', trans("production"), trans("sandbox"), $paypal->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("client_id"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("client_id"); ?>" value="<?= esc($paypal->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($paypal->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $paypal->base_currency == 'all' ? 'selected' : ''; ?>><?= trans("all_active_currencies"); ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $paypal->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $paypal->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'stripe' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'stripe'):
                                $stripe = getPaymentGateway('stripe');
                                if (!empty($stripe)):?>
                                    <input type="hidden" name="name_key" value="stripe">
                                    <img src="<?= base_url('assets/img/payment/stripe.svg'); ?>" alt="stripe" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $stripe->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("publishable_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("publishable_key"); ?>" value="<?= esc($stripe->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($stripe->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $stripe->base_currency == 'all' ? 'selected' : ''; ?>><?= trans("all_active_currencies"); ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $stripe->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $stripe->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'paystack' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paystack'):
                                $paystack = getPaymentGateway('paystack');
                                if (!empty($paystack)):?>
                                    <input type="hidden" name="name_key" value="paystack">
                                    <img src="<?= base_url('assets/img/payment/paystack.svg'); ?>" alt="paystack" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $paystack->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("public_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("public_key"); ?>" value="<?= esc($paystack->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($paystack->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $paystack->base_currency == 'all' ? 'selected' : ''; ?>><?= trans("all_active_currencies"); ?></option>
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'NGN' || $currency->code == 'USD' || $currency->code == 'GHS' || $currency->code == 'ZAR'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $paystack->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $paystack->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'razorpay' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'razorpay'):
                                $razorpay = getPaymentGateway('razorpay');
                                if (!empty($razorpay)):?>
                                    <input type="hidden" name="name_key" value="razorpay">
                                    <img src="<?= base_url('assets/img/payment/razorpay.svg'); ?>" alt="razorpay" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $razorpay->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("api_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("api_key"); ?>" value="<?= esc($razorpay->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($razorpay->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $razorpay->base_currency == 'all' ? 'selected' : ''; ?>><?= trans("all_active_currencies"); ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $razorpay->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $razorpay->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'flutterwave' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'flutterwave'):
                                $flutterwave = getPaymentGateway('flutterwave');
                                if (!empty($flutterwave)):?>
                                    <input type="hidden" name="name_key" value="flutterwave">
                                    <img src="<?= base_url('assets/img/payment/flutterwave.svg'); ?>" alt="flutterwave" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $flutterwave->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("public_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("public_key"); ?>" value="<?= esc($flutterwave->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($flutterwave->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $flutterwave->base_currency == 'all' ? 'selected' : ''; ?>><?= trans("all_active_currencies"); ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $flutterwave->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $flutterwave->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'iyzico' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'iyzico'):
                                $iyzico = getPaymentGateway('iyzico');
                                if (!empty($iyzico)):?>
                                    <input type="hidden" name="name_key" value="iyzico">
                                    <img src="<?= base_url('assets/img/payment/iyzico.svg'); ?>" alt="iyzico" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $iyzico->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?= trans("mode"); ?></label>
                                        <?= formRadio('environment', 'production', 'sandbox', trans("production"), trans("sandbox"), $iyzico->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("api_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("api_key"); ?>" value="<?= esc($iyzico->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($iyzico->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == "TRY"):?>
                                                        <option value="<?= $currency->code; ?>" <?= $iyzico->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $iyzico->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif; ?>
                                <div class="alert alert-info alert-large">
                                    <strong><?= trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("iyzico_warning"); ?> <a href="https://dev.iyzipay.com/en/checkout-form" target="_blank" style="color: #0c5460;font-weight: bold">Iyzico Checkout Form</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'midtrans' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'midtrans'):
                                $midtrans = getPaymentGateway('midtrans');
                                if (!empty($midtrans)):?>
                                    <input type="hidden" name="name_key" value="midtrans">
                                    <img src="<?= base_url('assets/img/payment/midtrans.svg'); ?>" alt="midtrans" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $midtrans->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?= trans("mode"); ?></label>
                                        <?= formRadio('environment', 'production', 'sandbox', trans("production"), trans("sandbox"), $midtrans->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("api_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("api_key"); ?>" value="<?= esc($midtrans->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("server_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("server_key"); ?>" value="<?= esc($midtrans->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'IDR'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $midtrans->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $midtrans->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'mercado_pago' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'mercado_pago'):
                                $mercadoPago = getPaymentGateway('mercado_pago');
                                if (!empty($mercadoPago)):?>
                                    <input type="hidden" name="name_key" value="mercado_pago">
                                    <img src="<?= base_url('assets/img/payment/mercado_pago.svg'); ?>" alt="mercado pago" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $mercadoPago->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("api_key"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("api_key"); ?>" value="<?= esc($mercadoPago->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("secret_key"); ?> (Token)</label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($mercadoPago->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'ARS' || $currency->code == 'BRL' || $currency->code == 'CLP' || $currency->code == 'COP' || $currency->code == 'MXN' || $currency->code == 'PEN' || $currency->code == 'UYU'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $mercadoPago->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $mercadoPago->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'paytabs' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paytabs'):
                                $payTabs = getPaymentGateway('paytabs');
                                if (!empty($payTabs)): ?>
                                    <input type="hidden" name="name_key" value="paytabs">
                                    <img src="<?= base_url('assets/img/payment/paytabs.svg'); ?>" alt="paytabs" class="img-payment-logo">
                                    <img src="<?= base_url('assets/img/payment/mercado_pago.svg'); ?>" alt="mercado pago" class="img-payment-logo">
                                    <div class="form-group">
                                        <label><?= trans("status"); ?></label>
                                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $payTabs->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("profile_id"); ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= trans("profile_id"); ?>" value="<?= esc($payTabs->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= trans("server_key"); ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= trans("secret_key"); ?>" value="<?= esc($payTabs->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= trans("base_currency"); ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $payTabs->base_currency == 'all' ? 'selected' : ''; ?>><?= trans("all_active_currencies"); ?>&nbsp;(PayTabs&nbsp;<?= trans('global'); ?>)</option>
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'AED' || $currency->code == 'SAR' || $currency->code == 'OMR' || $currency->code == 'JOD' || $currency->code == 'EGP'): ?>
                                                        <option value="<?= $currency->code; ?>" <?= $payTabs->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= trans('transaction_fee'); ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $payTabs->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= trans("transaction_fee_exp"); ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'bank_transfer' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'bank_transfer'): ?>
                                <input type="hidden" name="name_key" value="bank_transfer">
                                <div class="form-group">
                                    <label><?= trans("status"); ?></label>
                                    <?= formRadio('bank_transfer_enabled', 1, 0, trans("enable"), trans("disable"), $paymentSettings->bank_transfer_enabled, 'col-md-4'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?= trans('bank_accounts'); ?></label>
                                    <textarea class="form-control tinyMCEsmall" name="bank_transfer_accounts"><?= $paymentSettings->bank_transfer_accounts; ?></textarea>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'cash_on_delivery' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'cash_on_delivery'): ?>
                                <input type="hidden" name="name_key" value="cash_on_delivery">
                                <div class="form-group">
                                    <label><?= trans("status"); ?></label>
                                    <?= formRadio('cash_on_delivery_enabled', 1, 0, trans("enable"), trans("disable"), $paymentSettings->cash_on_delivery_enabled, 'col-md-4'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('commission'); ?>&nbsp;&&nbsp;<?= trans('tax_settings'); ?></h3><br>
            </div>
            <form action="<?= base_url('Admin/commissionSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 m-b-10">
                                <label><?= trans('commission'); ?></label>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="commission" value="1" id="commission_1" class="custom-control-input radio-commission" <?= $paymentSettings->commission_rate > 0 ? 'checked' : ''; ?>>
                                    <label for="commission_1" class="custom-control-label"><?= trans("enable"); ?></label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="commission" value="0" id="commission_2" class="custom-control-input radio-commission" <?= $paymentSettings->commission_rate <= 0 ? 'checked' : ''; ?>>
                                    <label for="commission_2" class="custom-control-label"><?= trans("disable"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="commissionRateContainer" class="form-group" <?= $paymentSettings->commission_rate <= 0 ? 'style="display:none;"' : ''; ?>>
                        <label><?= trans('commission_rate'); ?>(%)</label>
                        <input type="number" name="commission_rate" class="form-control" min="0" max="100" step="0.01" value="<?= $paymentSettings->commission_rate; ?>">
                    </div>
                    <div class="form-group">
                        <div class="m-b-10">
                            <label><?= trans('vat'); ?>&nbsp;(<?= trans("vat_exp"); ?>)</label><br>
                            <small style="font-size: 13px;"><?= trans("vat_vendor_exp"); ?></small>
                        </div>
                        <?= formRadio('vat_status', 1, 0, trans("enable"), trans("disable"), $paymentSettings->vat_status); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= trans('global_taxes'); ?><br>
                    <small><?= trans("global_taxes_exp"); ?></small>
                </h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <table class="table">
                        <tr>
                            <th><?= trans('tax_name'); ?></th>
                            <th><?= trans('tax_rate'); ?></th>
                            <th><?= trans('status'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        <?php if (!empty($globalTaxes)):
                            foreach ($globalTaxes as $globalTax):
                                if (!empty($globalTax['id'])):
                                    $taxStatus = !empty($globalTax['status']) && $globalTax['status'] == 1 ? 1 : 0; ?>
                                    <tr>
                                        <td><?= esc(getGlobalTaxName($globalTax['taxNameArray'], selectedLangId())); ?></td>
                                        <td><?= !empty($globalTax['taxRate']) ? esc($globalTax['taxRate']) : ''; ?>%</td>
                                        <td>
                                            <?php if ($taxStatus): ?>
                                                <label class="label label-success"><?= trans("active"); ?></label>
                                            <?php else: ?>
                                                <label class="label label-danger"><?= trans("inactive"); ?></label>
                                            <?php endif; ?>
                                        </td>
                                        <td style="width: 100px;">
                                            <div class="btn-group btn-group-option">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-edit" data-toggle="modal" data-target="#modalEditTax<?= $globalTax['id']; ?>"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-delete" onclick="deleteItem('Admin/deleteGlobalTaxPost','<?= $globalTax['id']; ?>','<?= trans("confirm_delete"); ?>');"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                    <div id="modalEditTax<?= $globalTax['id']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?= base_url('Admin/editGlobalTaxPost'); ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?= $globalTax['id']; ?>">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><?= trans('edit'); ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label><?= trans("tax_name"); ?></label>
                                                            <?php foreach ($activeLanguages as $language): ?>
                                                                <input type="text" name="tax_name_<?= $language->id; ?>" value="<?= esc(getGlobalTaxName($globalTax['taxNameArray'], $language->id)); ?>" class="form-control m-b-5" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?= trans('tax_rate'); ?>(%)</label>
                                                            <input type="number" name="tax_rate" class="form-control" min="0" max="100" step="0.01" value="<?= !empty($globalTax['taxRate']) ? esc($globalTax['taxRate']) : ''; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?= trans("status"); ?></label>
                                                            <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), $taxStatus); ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?= trans('country'); ?></label>
                                                            <div style="max-height: 300px; overflow-y: scroll">
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" name="all_countries" class="checkboxAllCountries" value="1" <?= !empty($globalTax['isAllCountries']) ? 'checked' : ''; ?>><?= trans("all_countries"); ?></label>
                                                                </div>
                                                                <?php if (!empty($countries)):
                                                                    foreach ($countries as $item):
                                                                        $isSelected = false;
                                                                        if (!empty($globalTax['countryIds']) && is_array($globalTax['countryIds']) && in_array($item->id, $globalTax['countryIds'])) {
                                                                            $isSelected = true;
                                                                        } ?>
                                                                        <div class="checkbox checkbox-country" <?= !empty($globalTax['isAllCountries']) ? 'style="display: none;"' : ''; ?>>
                                                                            <label><input type="checkbox" name="country[]" value="<?= $item->id; ?>" <?= $isSelected ? 'checked' : ''; ?>><?= esc($item->name); ?></label>
                                                                        </div>
                                                                    <?php endforeach;
                                                                endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary"><?= trans("save_changes"); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                            endforeach;
                        endif; ?>
                    </table>
                    <?php if (empty($globalTaxes)): ?>
                        <p class="text-center m-t-30"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddTax"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;<?= trans('define_new_tax'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalAddTax" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Admin/addGlobalTaxPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= trans('define_new_tax'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?= trans("tax_name"); ?></label>
                        <?php foreach ($activeLanguages as $language): ?>
                            <input type="text" name="tax_name_<?= $language->id; ?>" class="form-control m-b-5" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans('tax_rate'); ?>(%)</label>
                        <input type="number" name="tax_rate" value="1" class="form-control" min="0" max="99.99" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('status', 1, 0, trans("enable"), trans("disable"), 1); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans('country'); ?></label>
                        <div style="max-height: 300px; overflow-y: scroll">
                            <div class="checkbox">
                                <label><input type="checkbox" name="all_countries" class="checkboxAllCountries" value="1"><?= trans("all_countries"); ?></label>
                            </div>
                            <?php if (!empty($countries)):
                                foreach ($countries as $item): ?>
                                    <div class="checkbox checkbox-country">
                                        <label><input type="checkbox" name="country[]" value="<?= $item->id; ?>"><?= esc($item->name); ?></label>
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?= trans("submit"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .tab-pane {
        position: relative;
        padding-top: 30px;
    }

    .nav-tabs li a {
        font-weight: 600;
        padding: 12px 24px !important;
    }

    .nav-tabs li a:hover {
        color: #111 !important;
    }

    .img-payment-logo {
        height: 40px;
        max-height: 40px;
        position: absolute;
        right: 15px;
        top: 15px;
    }
</style>

<script>
    $(document).on("change", ".radio-commission", function () {
        var val = $('input[name="commission"]:checked').val();
        if (val == '1') {
            $('#commissionRateContainer').show();
        } else {
            $('#commissionRateContainer').hide();
        }
    });

    $(document).on("change", ".checkboxAllCountries", function () {
        if ($(this).is(":checked")) {
            $('.checkbox-country').hide();
        } else {
            $('.checkbox-country').show();
        }
    });
</script>