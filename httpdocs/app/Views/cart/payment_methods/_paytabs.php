<?php if (!empty($paymentGateway) && $paymentGateway->name_key == 'paytabs'):
    loadLibrary('PayTabs');
    $paytabs = new PayTabs($paymentGateway);
    $error = '';
    $paytabsResponse = null;
    $customer = getCartCustomerData();
    $productIds = '';
    $i = 0;
    if (!empty($cartItems)) {
        foreach ($cartItems as $cartItem) {
            if ($i != 0) {
                $productIds .= ', ';
            }
            $productIds .= $cartItem->product_id;
            $i++;
        }
    }
    try {
        $data = [
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => $mdsPaymentToken,
            "cart_currency" => $currency,
            "cart_amount" => $totalAmount,
            "cart_description" => $baseVars->appName . " product sale (" . $productIds . ")",
            "paypage_lang" => $activeLang->short_form,
            "customer_details" => [
                "name" => $customer->first_name . ' ' . $customer->last_name,
                "email" => $customer->email,
                "phone" => $customer->phone_number,
                "street1" => "",
                "city" => "",
                "state" => "",
                "country" => "",
                "zip" => ""
            ],
            "shipping_details" => [
                "name" => $customer->first_name . ' ' . $customer->last_name,
                "email" => $customer->email,
                "phone" => $customer->phone_number,
                "street1" => "",
                "city" => "",
                "state" => "",
                "country" => "",
                "zip" => ""
            ],
            "callback" => langBaseUrl('cart/paytabs-payment-callback') . '?b=' . base64_encode(base_url()) . '&lang=' . $activeLang->short_form,
            "return" => langBaseUrl('cart/paytabs-payment-callback') . '?b=' . base64_encode(base_url()) . '&lang=' . $activeLang->short_form,
        ];
        $paytabsResponse = $paytabs->sendApiRequest($data);
        if (!empty($paytabsResponse) && !empty($paytabsResponse['code'])) {
            $error = $paytabsResponse['message'];
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    } ?>
    <div class="row">
        <div class="col-12">
            <?= view('partials/_messages'); ?>
        </div>
    </div>
    <?php if (empty($error)):
    if (!empty($paytabsResponse)):
        if (!empty($paytabsResponse['redirect_url'])):?>
            <div id="payment-button-container" class="payment-button-cnt">
                <div class="payment-icons-container">
                    <label class="payment-icons">
                        <?php $logos = @explode(',', $paymentGateway->logos);
                        if (!empty($logos) && countItems($logos) > 0):
                            foreach ($logos as $logo): ?>
                                <img src="<?= base_url('assets/img/payment/' . esc(trim($logo ?? '')) . '.svg'); ?>" alt="<?= esc(trim($logo ?? '')); ?>">
                            <?php endforeach;
                        endif; ?>
                    </label>
                </div>
                <p class="p-complete-payment"><?= trans("msg_complete_payment"); ?></p>
                <a href="<?= $paytabsResponse['redirect_url']; ?>" class="btn btn-lg btn-payment btn-paytabs"><?= trans("pay"); ?>&nbsp;<?= priceDecimal($totalAmount, $currency); ?></a>
            </div>
        <?php endif;
    endif;
else: ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error:</strong>&nbsp;<?= $error; ?>
    </div>
<?php endif;
endif; ?>