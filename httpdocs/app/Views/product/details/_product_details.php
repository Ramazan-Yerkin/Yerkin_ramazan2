<div class="row">
    <div class="col-12">
        <?php if ($product->product_type == 'digital'):
            if ($product->is_free_product == 1):
                if (authCheck()):
                    if (!empty($product->digital_file_download_link)): ?>
                        <div class="row-custom">
                            <a href="<?= esc($product->digital_file_download_link); ?>" class="btn btn-instant-download" target="_blank"><i class="icon-download-solid"></i><?= trans("download") ?></a>
                        </div>
                    <?php else: ?>
                        <div class="row-custom">
                            <form action="<?= base_url('download-free-digital-file-post'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                                <button class="btn btn-instant-download"><i class="icon-download-solid"></i><?= trans("download") ?></button>
                            </form>
                        </div>
                    <?php endif;
                else: ?>
                    <div class="row-custom">
                        <button class="btn btn-instant-download" data-toggle="modal" data-target="#loginModal"><i class="icon-download-solid"></i><?= trans("download") ?></button>
                    </div>
                <?php endif;
            else: ?>
                <label class="label-instant-download"><i class="icon-download-solid"></i><?= trans("instant_download"); ?></label>
            <?php endif;
        endif; ?>
        <h1 class="product-title"><?= esc($title); ?></h1>
        <?php if ($product->status == 0): ?>
            <label class="badge badge-warning badge-product-status"><?= trans("pending"); ?></label>
        <?php elseif ($product->visibility == 0): ?>
            <label class="badge badge-danger badge-product-status"><?= trans("hidden"); ?></label>
        <?php endif; ?>
        <div class="row-custom meta">
            <div class="product-details-user">
                <?= trans("by"); ?>&nbsp;<a href="<?= generateProfileUrl($product->user_slug); ?>"><?= characterLimiter(esc($product->user_username), 30, '..'); ?></a>
            </div>
            <?php if ($generalSettings->product_comments == 1): ?>
                <span><i class="icon-comment"></i><?= esc($commentCount); ?></span>
            <?php endif;
            if ($generalSettings->reviews == 1): ?>
                <div class="product-details-review">
                    <?= view('partials/_review_stars', ['rating' => $product->rating]); ?>
                    <span>(<?= esc($reviewCount); ?>)</span>
                </div>
            <?php endif; ?>
            <span><i class="icon-heart"></i><?= esc($wishlistCount); ?></span>
            <span><i class="icon-eye"></i><?= esc($product->pageviews); ?></span>
        </div>
        <div class="row-custom price">
            <div id="product_details_price_container" class="d-inline-block">
                <?= view('product/details/_price', ['product' => $product, 'price' => $product->price, 'priceDiscounted' => $product->price_discounted, 'discountRate' => $product->discount_rate]); ?>
                <?php if ($product->is_sold == 1): ?>
                    <strong class="lbl-sold"><?= trans("sold"); ?></strong>
                <?php endif; ?>
            </div>
            <?php $showAsk = true;
            if ($product->listing_type == 'ordinary_listing' && empty($product->external_link)):
                $showAsk = false;
            endif;
            if ($showAsk == true):?>
                <?php if (authCheck() || (!authCheck() && $generalSettings->show_vendor_contact_information == 1)): ?>
                    <button class="btn btn-contact-seller" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i> <?= trans("ask_question") ?></button>
                <?php else: ?>
                    <button class="btn btn-contact-seller" data-toggle="modal" data-target="#loginModal"><i class="icon-envelope"></i> <?= trans("ask_question") ?></button>
                <?php endif;
            endif; ?>
        </div>
        <div class="row-custom details">
            <?php if ($product->listing_type != 'ordinary_listing' && $product->product_type != 'digital'): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?= trans("status"); ?></label>
                    </div>
                    <div id="text_product_stock_status" class="right">
                        <?php if (checkProductStock($product)): ?>
                            <span class="status-in-stock text-success"><?= trans("in_stock") ?></span>
                        <?php else: ?>
                            <span class="status-in-stock text-danger"><?= trans("out_of_stock") ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
            if ($productSettings->marketplace_sku == 1 && !empty($product->sku)): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?= trans("sku"); ?></label>
                    </div>
                    <div class="right">
                        <span><?= esc($product->sku); ?></span>
                    </div>
                </div>
            <?php endif;
            if ($product->product_type == 'digital' && !empty($product->files_included)): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?= trans("files_included"); ?></label>
                    </div>
                    <div class="right">
                        <span><?= esc($product->files_included); ?></span>
                    </div>
                </div>
            <?php endif;
            if ($product->listing_type == 'ordinary_listing'): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?= trans("uploaded"); ?></label>
                    </div>
                    <div class="right">
                        <span><?= timeAgo($product->created_at); ?></span>
                    </div>
                </div>
            <?php endif;
            if (!empty($customFieldsDetails)):
                foreach ($customFieldsDetails as $customField):?>
                    <div class="item-details">
                        <div class="left">
                            <label><?= esc($customField['name']); ?></label>
                        </div>
                        <div class="right">
                            <span><?= esc($customField['value']); ?></span>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>
<?php if ($product->listing_type == 'sell_on_site' || $product->listing_type == 'license_key'): ?>
<form action="<?= getProductFormData($product)->addToCartUrl; ?>" method="post" id="form_add_cart">
    <?= csrf_field(); ?>
    <?php endif;
    if ($product->listing_type == 'bidding'): ?>
    <form action="<?= getProductFormData($product)->addToCartUrl; ?>" method="post" id="form_request_quote">
        <?= csrf_field(); ?>
        <?php endif; ?>
        <input type="hidden" name="product_id" value="<?= $product->id; ?>">
        <div class="row">
            <div class="col-12">
                <div class="row-custom product-variations">
                    <div class="row row-product-variation item-variation">
                        <?php if (!empty($fullWidthProductVariations)):
                            foreach ($fullWidthProductVariations as $variation):
                                echo view('product/details/_product_variations', ['variation' => $variation]);
                            endforeach;
                        endif;
                        if (!empty($halfWidthProductVariations)):
                            foreach ($halfWidthProductVariations as $variation):
                                echo view('product/details/_product_variations', ['variation' => $variation]);
                            endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><?= view('product/details/_messages'); ?></div>
        </div>
        <div class="row">
            <div class="col-12 product-add-to-cart-container">
                <?php if ($product->is_sold != 1 && $product->listing_type != 'ordinary_listing' && $product->product_type != 'digital'): ?>
                    <div class="number-spinner">
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-spinner-minus" data-dir="dwn">-</button>
                        </span>
                            <input type="text" class="form-control text-center" name="product_quantity" value="1">
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-spinner-plus" data-dir="up">+</button>
                        </span>
                        </div>
                    </div>
                <?php endif;
                $buttton = getProductFormData($product)->button;
                if ($product->is_sold != 1 && !empty($buttton)):?>
                    <div class="button-container">
                        <?= $buttton; ?>
                    </div>
                <?php endif; ?>
                <div class="button-container button-container-wishlist">
                    <?php if ($isProductInWishlist == 1): ?>
                        <a href="javascript:void(0)" class="btn-wishlist btn-add-remove-wishlist" data-product-id="<?= $product->id; ?>" data-type="details"><i class="icon-heart"></i><span><?= trans("remove_from_wishlist"); ?></span></a>
                    <?php else: ?>
                        <a href="javascript:void(0)" class="btn-wishlist btn-add-remove-wishlist" data-product-id="<?= $product->id; ?>" data-type="details"><i class="icon-heart-o"></i><span><?= trans("add_to_wishlist"); ?></span></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($product->demo_url)): ?>
                <div class="col-12 product-add-to-cart-container">
                    <div class="button-container">
                        <a href="<?= $product->demo_url; ?>" target="_blank" class="btn btn-md btn-live-preview"><i class="icon-preview"></i><?= trans("live_preview") ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </form>
    <?php if (!empty($digitalSale)): ?>
        <div class="row">
            <div class="col-12 product-already-purchased text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                </svg>&nbsp;
                <?= trans("msg_product_already_purchased") ?>
                &nbsp;
                <?php if (!empty($product->digital_file_download_link)): ?>
                    <a href="<?= esc($product->digital_file_download_link); ?>" class="text-success" target="_blank">
                        <?= trans("download"); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </a>
                <?php else: ?>
                    <form action="<?= base_url('download-purchased-digital-file-post'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="sale_id" value="<?= $digitalSale->id; ?>">
                        <button type="submit" name="submit" value="<?= $product->listing_type == 'license_key' ? 'license_certificate' : 'main_files'; ?>">
                            <?= trans("download"); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?= view("product/details/_product_share"); ?>