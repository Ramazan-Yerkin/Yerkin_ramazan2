<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= trans("my_coupons"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-b-30">
                <h1 class="page-title m-b-5"><?= trans("my_coupons"); ?></h1>
            </div>
            <?php if (!empty($coupons)):
                foreach ($coupons as $coupon):
                    $expiryDate = formatDateLong($coupon->expiry_date);
                    $shopName = $coupon->shop_name;
                    if (empty($shopName)) {
                        $shopName = $coupon->first_name . ' ' . $coupon->last_name;
                    }
                    $isExpired = false;
                    if (date('Y-m-d H:i:s') > $coupon->expiry_date) {
                        $isExpired = true;
                    } ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card coupon-item">
                            <div class="coupon-inner">
                                <div class="coupon-img">
                                    <img src="<?= IMG_BASE64_1x1; ?>" data-src="<?= base_url($coupon->user_avatar); ?>" alt="<?= esc($shopName); ?>" class="lazyload img-fluid img-profile">
                                </div>
                                <div class="content">
                                    <div class="flex-item">
                                        <a href="<?= generateProfileUrl($coupon->user_slug); ?>">
                                            <span class="shop-name"><?= esc($shopName); ?></span>
                                        </a>
                                        <strong class="discount"><?= $coupon->discount_rate; ?>% <span><?= trans("coupon"); ?></span></strong>
                                        <div class="date <?= $isExpired ? 'date-expired' : ''; ?>">
                                            <?php if ($isExpired): ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                </svg>&nbsp;
                                                <span><?= trans("expired"); ?></span>
                                            <?php else: ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                                </svg>&nbsp;
                                                <span><?= transWithField('coupon_valid_till', $expiryDate) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="coupon-link">
                                            <?php if (!$isExpired): ?>
                                                <a href="<?= generateProfileUrl($coupon->user_slug); ?>?v_coupon=<?= urlencode($coupon->coupon_code); ?>">
                                                    <?= trans("see_products"); ?>&nbsp;
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="coupon-code">
                                <span class="code" id="couponCode<?= $coupon->id; ?>"><?= esc($coupon->coupon_code); ?></span>
                                <button type="button" id="btncouponCode<?= $coupon->id; ?>" class="btn btn-custom" onclick="copyCouponCode('couponCode<?= $coupon->id; ?>');"><span><?= trans("copy_code"); ?></span></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="col-12">
                    <p class="text-muted text-center"><?= trans("no_records_found"); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= $pager->links; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function copyCouponCode(id) {
        var code = $('#' + id).text();
        navigator.clipboard.writeText(code);
        $('#btn' + id).text("<?= clrQuotes(trans('copied')); ?>");
        setTimeout(function () {
            $('#btn' + id).text("<?= clrQuotes(trans('copy_code')); ?>");
        }, 3000);
    }
</script>