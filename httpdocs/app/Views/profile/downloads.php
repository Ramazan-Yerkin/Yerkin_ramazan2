<?= view('profile/_cover_image'); ?>
    <div id="wrapper">
        <div class="container">
            <?php if (empty($user->cover_image)): ?>
                <div class="row">
                    <div class="col-12">
                        <nav class="nav-breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= trans("profile"); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="profile-page-top">
                        <?= view('profile/_profile_user_info'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= view('profile/_tabs'); ?>
                </div>
                <div class="col-12">
                    <div class="profile-tab-content page-downloads">
                        <?php if (!empty($items)):
                            foreach ($items as $item):
                                $product = getActiveProduct($item->product_id);
                                if (!empty($product)):?>
                                    <div class="product-item product-item-horizontal">
                                        <div class="row">
                                            <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-mds-5">
                                                <div class="item-image">
                                                    <a href="<?= generateProductUrl($product); ?>">
                                                        <div class="img-product-container">
                                                            <img src="<?= base_url(IMG_BG_PRODUCT_SMALL); ?>" data-src="<?= getProductMainImage($product->id, 'image_small'); ?>" alt="<?= getProductTitle($product); ?>" class="lazyload img-fluid img-product" onerror="this.src='<?= base_url(IMG_BG_PRODUCT_SMALL); ?>'">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                                                <div class="row-custom item-details">
                                                    <h3 class="product-title m-0">
                                                        <a href="<?= generateProductUrl($product); ?>"><?= getProductTitle($product); ?></a>
                                                    </h3>
                                                    <p class="product-user text-truncate m-t-0">
                                                        <a href="<?= generateProfileUrl($product->user_slug); ?>"><?= esc($product->user_username); ?></a>
                                                    </p>
                                                    <?php if ($generalSettings->reviews == 1) {
                                                        echo view('partials/_review_stars', ['rating' => $product->rating]);
                                                    } ?>
                                                    <div class="item-meta m-t-5">
                                                        <?= view('product/_price_product_item', ['product' => $product]); ?>
                                                    </div>
                                                </div>
                                                <div class="row-custom m-t-15">
                                                    <form action="<?= base_url('download-purchased-digital-file-post'); ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="sale_id" value="<?= $item->id; ?>">
                                                        <?php if ($product->listing_type == 'license_key'): ?>
                                                            <button name="submit" value="license_certificate" class="btn btn-md btn-custom display-inline-flex align-items-center m-b-15">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                                                    <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                                                    <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                                                </svg>&nbsp;&nbsp;<?= trans("download_license_key"); ?>
                                                            </button>
                                                        <?php else: ?>
                                                            <p class="m-b-10" style="color: #7fb13d"><strong><i class="icon-download-solid"></i>&nbsp;<?= trans("download"); ?></strong></p>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <?php if (!empty($product->digital_file_download_link)): ?>
                                                                        <a href="<?= esc($product->digital_file_download_link); ?>" class="btn btn-md btn-custom display-inline-flex align-items-center m-b-15" target="_blank">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-file-earmark-zip" viewBox="0 0 16 16">
                                                                                <path d="M5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.11 0l-.929-.62a1 1 0 0 1-.415-1.074L5 8.438V7.5zm2 0H6v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.929-.62-.4-1.598A1 1 0 0 1 7 8.438V7.5z"/>
                                                                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1h-2v1h-1v1h1v1h-1v1h1v1H6V5H5V4h1V3H5V2h1V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                                                            </svg>&nbsp;&nbsp;<?= trans("main_files"); ?>
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <button type="submit" name="submit" value="main_files" class="btn btn-md btn-custom display-inline-flex align-items-center m-b-15">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-file-earmark-zip" viewBox="0 0 16 16">
                                                                                <path d="M5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.11 0l-.929-.62a1 1 0 0 1-.415-1.074L5 8.438V7.5zm2 0H6v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.929-.62-.4-1.598A1 1 0 0 1 7 8.438V7.5z"/>
                                                                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1h-2v1h-1v1h1v1h-1v1h1v1H6V5H5V4h1V3H5V2h1V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                                                            </svg>&nbsp;&nbsp;<?= trans("main_files"); ?>
                                                                        </button>
                                                                    <?php endif; ?>
                                                                    &nbsp;
                                                                    <button type="submit" name="submit" value="license_certificate" class="btn btn-md btn-custom display-inline-flex align-items-center m-b-15">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                                                            <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                                                            <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                                                        </svg>&nbsp;&nbsp;<?= trans("license_certificate"); ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </form>
                                                </div>
                                                <?php if ($generalSettings->reviews == 1 && $item->seller_id != $item->buyer_id): ?>
                                                    <div class="row-custom">
                                                        <div class="rate-product">
                                                            <p class="p-rate-product"><?= trans("rate_this_product"); ?></p>
                                                            <div class="rating-stars">
                                                                <?php $review = getReview($item->product_id, user()->id); ?>
                                                                <label class="label-star label-star-open-modal" data-star="5" data-product-id="<?= $item->product_id; ?>" data-toggle="modal" data-target="#rateProductModal"><i class="<?= !empty($review) && $review->rating >= 5 ? 'icon-star' : 'icon-star-o'; ?>"></i></label>
                                                                <label class="label-star label-star-open-modal" data-star="4" data-product-id="<?= $item->product_id; ?>" data-toggle="modal" data-target="#rateProductModal"><i class="<?= !empty($review) && $review->rating >= 4 ? 'icon-star' : 'icon-star-o'; ?>"></i></label>
                                                                <label class="label-star label-star-open-modal" data-star="3" data-product-id="<?= $item->product_id; ?>" data-toggle="modal" data-target="#rateProductModal"><i class="<?= !empty($review) && $review->rating >= 3 ? 'icon-star' : 'icon-star-o'; ?>"></i></label>
                                                                <label class="label-star label-star-open-modal" data-star="2" data-product-id="<?= $item->product_id; ?>" data-toggle="modal" data-target="#rateProductModal"><i class="<?= !empty($review) && $review->rating >= 2 ? 'icon-star' : 'icon-star-o'; ?>"></i></label>
                                                                <label class="label-star label-star-open-modal" data-star="1" data-product-id="<?= $item->product_id; ?>" data-toggle="modal" data-target="#rateProductModal"><i class="<?= !empty($review) && $review->rating >= 1 ? 'icon-star' : 'icon-star-o'; ?>"></i></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="product-item product-item-horizontal">
                                        <div class="row">
                                            <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-mds-5">
                                                <div class="item-image">
                                                    <div class="img-product-container">
                                                        <img src="<?= base_url(IMG_BG_PRODUCT_SMALL); ?>" data-src="<?= base_url('assets/img/no-image.jpg'); ?>" alt="" class="lazyload img-fluid img-product">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                                                <div class="row-custom item-details">
                                                    <h3 class="product-title m-0"><?= esc($item->product_title); ?></h3>
                                                </div>
                                                <div class="row-custom">
                                                    <label class="badge badge-danger">Not Available</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                            endforeach;
                        else:?>
                            <p class="text-center text-muted"><?= trans("msg_dont_have_downloadable_files"); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="product-list-pagination">
                        <?= $pager->links; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= view('partials/_modal_rate_product'); ?>