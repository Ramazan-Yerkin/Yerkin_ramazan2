<?php if ($product->listing_type == 'sell_on_site' || $product->listing_type == 'license_key'): ?>
    <div class="form-box form-box-price">
        <div class="form-box-head">
            <h4 class="title"><?= trans("product_price"); ?></h4>
        </div>
        <div class="form-box-body">
            <div id="price_input_container" class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 m-b-sm-15">
                        <label class="font-600"><?= trans("price"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><?= $defaultCurrency->symbol; ?></span>
                            <input type="hidden" name="currency" value="<?= esc($defaultCurrency->code); ?>">
                            <input type="text" name="price" id="product_price_input" class="form-control form-input price-input" value="<?= $product->price != 0 ? getPrice($product->price, 'input') : ''; ?>" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32" <?= $product->is_free_product != 1 ? 'required' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 m-b-sm-15">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <label class="font-600"><?= trans("discounted_price"); ?></label>
                                <div id="discount_input_container" class="<?= $product->discount_rate == 0 ? 'display-none' : ''; ?>">
                                    <div class="input-group">
                                        <span class="input-group-addon"><?= $defaultCurrency->symbol; ?></span>
                                        <input type="text" name="price_discounted" id="product_discounted_price_input" class="form-control form-input price-input" value="<?= !empty($product->price_discounted) ? getPrice($product->price_discounted, 'input') : ''; ?>" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 m-t-10">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="checkbox_has_discount" id="checkbox_discount_rate" <?= $product->discount_rate == 0 ? 'checked' : ''; ?>>
                                    <label for="checkbox_discount_rate" class="custom-control-label"><?= trans("no_discount"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($paymentSettings->vat_status == 1): ?>
                        <div class="col-xs-12 col-sm-4">
                            <div class="row align-items-center">
                                <div class="col-sm-12">
                                    <label class="font-600"><?= trans("product_based_vat"); ?><small>&nbsp;(<?= trans("vat_exp"); ?>)</small></label>
                                    <div id="vat_input_container" class="<?= $product->vat_rate == 0 ? 'display-none' : ''; ?>">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input type="hidden" name="currency" value="<?= $paymentSettings->default_currency; ?>">
                                            <input type="number" name="vat_rate" id="input_vat_rate" aria-describedby="basic-addon-vat" class="form-control form-input" value="<?= $product->vat_rate; ?>" min="0" max="100" step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 m-t-10">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="no_vat" id="checkbox_no_vat" <?= $product->vat_rate == 0 ? 'checked' : ''; ?>>
                                        <label for="checkbox_no_vat" class="custom-control-label"><?= trans("no_vat"); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-12 m-t-30">
                        <p class="calculated-price">
                            <strong><?= trans("discount_rate"); ?>:&nbsp;&nbsp;</strong>
                            <b id="calculated_discount_rate" class="earned-price"><?= $product->discount_rate; ?>%</b>
                        </p>
                        <p class="calculated-price">
                            <strong><?= trans("commission_rate"); ?>:&nbsp;&nbsp;</strong>
                            <b id="calculated_discount_rate" class="earned-price"><?= $paymentSettings->commission_rate; ?>%</b>
                        </p>
                        <p class="calculated-price">
                            <strong><?= trans("you_will_earn"); ?> (<?= $defaultCurrency->symbol; ?>):&nbsp;&nbsp;</strong>
                            <b id="earned_amount" class="earned-price">
                                <?php $earnedAmount = 0;
                                if (!empty($product)) {
                                    $price = $product->price_discounted;
                                    $earnedAmount = $price - (($price * $paymentSettings->commission_rate) / 100);
                                }
                                echo getPrice($earnedAmount, 'input'); ?>
                            </b>
                            &nbsp;&nbsp;<b>+&nbsp;&nbsp;&nbsp;<?= trans("vat"); ?></b>
                            <?php if ($product->product_type != 'digital'): ?>
                                &nbsp;&nbsp;<b>+&nbsp;&nbsp;&nbsp;<?= trans("shipping_cost"); ?></b>&nbsp;&nbsp;
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php if ($product->product_type == 'digital'): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="is_free_product" id="checkbox_free_product" <?= $product->is_free_product == 1 ? 'checked' : ''; ?>>
                            <label for="checkbox_free_product" class="custom-control-label text-danger"><?= trans("free_product"); ?></label>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php elseif ($product->listing_type == 'ordinary_listing'):
    if ($productSettings->classified_price == 1): ?>
        <div class="form-box">
            <div class="form-box-head">
                <h4 class="title"><?= trans('price'); ?></h4>
            </div>
            <div class="form-box-body">
                <div class="form-group">
                    <div class="row">
                        <?php if ($paymentSettings->allow_all_currencies_for_classied == 1): ?>
                            <div class="col-xs-12 col-sm-4 m-b-sm-15">
                                <select name="currency" class="form-control custom-select" required>
                                    <?php if (!empty($currencies)):
                                        foreach ($currencies as $key => $value):?>
                                            <option value="<?= $key; ?>" <?= $key == $product->currency ? 'selected' : ''; ?>><?= esc($value->name) . ' (' . $value->symbol . ')'; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-4 m-b-sm-15">
                                <input type="text" name="price" class="form-control form-input price-input" value="<?= $product->price != 0 ? getPrice($product->price, 'input') : ''; ?>" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32" <?= $productSettings->classified_price_required == 1 ? 'required' : ''; ?>>
                            </div>
                        <?php else: ?>
                            <div class="col-xs-12 col-sm-6 m-b-sm-15">
                                <div class="input-group">
                                    <span class="input-group-addon"><?= $defaultCurrency->symbol; ?></span>
                                    <input type="hidden" name="currency" value="<?= $defaultCurrency->code; ?>">
                                    <input type="text" name="price" id="product_price_input" aria-describedby="basic-addon2" class="form-control form-input price-input" value="<?= $product->price != 0 ? getPrice($product->price, 'input') : ''; ?>" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32" <?= $productSettings->classified_price_required == 1 ? 'required' : ''; ?>>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;
elseif ($product->listing_type == 'bidding'): ?>
    <input type="hidden" name="currency" value="<?= $paymentSettings->default_currency; ?>">
<?php endif; ?>

<script>
    $(document).on('click', '#checkbox_free_product', function () {
        if ($(this).is(':checked')) {
            $('#price_input_container').hide();
            $(".price-input").prop('required', false);
        } else {
            $('#price_input_container').show();
            $(".price-input").prop('required', true);
        }
    });
</script>
<?php if ($product->is_free_product == 1): ?>
    <style>
        #price_input_container {
            display: none;;
        }
    </style>
<?php endif;
if ($product->listing_type == 'sell_on_site' || $product->listing_type == 'license_key'): ?>
    <script>
        //calculate product earned value
        $(document).on("change", "#product_price_input", function () {
            var price = parseFloat($('#product_price_input').val());
            var priceDiscounted = parseFloat($('#product_discounted_price_input').val());
            if (priceDiscounted > price) {
                $(this).val(priceDiscounted);
            }
            calculateEarnAmount();
        });

        //calculate discount
        $(document).on("change", "#product_discounted_price_input", function () {
            var price = parseFloat($('#product_price_input').val());
            var priceDiscounted = parseFloat($('#product_discounted_price_input').val());
            var rate = 0;
            if (priceDiscounted > price) {
                $('#product_discounted_price_input').val(price);
                return false;
            }
            if (priceDiscounted <= 0) {
                $('#product_discounted_price_input').val('');
                return false;
            }
            if (priceDiscounted) {
                rate = ((price - priceDiscounted) * 100) / price;
                rate = rate.toFixed(0);
            }
            $('#calculated_discount_rate').html(rate + '%');
            calculateEarnAmount();
        });

        function calculateEarnAmount() {
            var inputPrice = $('#product_price_input').val();
            var priceDiscounted = $('#product_discounted_price_input').val();
            if (priceDiscounted) {
                inputPrice = priceDiscounted;
            }
            inputPrice = inputPrice.replace(',', '.');
            var price = parseFloat(inputPrice);
            var commissionRate = MdsConfig.commissionRate;
            //calculate
            var earnedAmount = price;
            if (!Number.isNaN(price)) {
                earnedAmount = (price - ((price * commissionRate) / 100)).toFixed(2);
                if (MdsConfig.thousandsSeparator == ',') {
                    earnedAmount = earnedAmount.replace('.', ',');
                }
            } else {
                earnedAmount = '0' + MdsConfig.thousandsSeparator + '00';
            }
            $("#earned_amount").html(earnedAmount);
        }
    </script>
<?php endif; ?>
<script>
    $('#checkbox_discount_rate').change(function () {
        if (!this.checked) {
            $("#discount_input_container").show();
        } else {
            $('#calculated_discount_rate').html('0%');
            $('#product_discounted_price_input').val('');
            $("#discount_input_container").hide();
        }
        calculateEarnAmount();
    });
    $('#checkbox_no_vat').change(function () {
        if (!this.checked) {
            $("#vat_input_container").show();
        } else {
            $('#input_vat_rate').val("0");
            $("#vat_input_container").hide();
        }
    });
</script>
<style>
    #product_discounted_price_input.is-invalid {
        border-color: #A6AFB7 !important;
    }
</style>
