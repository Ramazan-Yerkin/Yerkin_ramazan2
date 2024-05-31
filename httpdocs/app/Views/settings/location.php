<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                    </ol>
                </nav>
                <h1 class="page-title"><?= trans("settings"); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="row-custom">
                    <?= view("settings/_tabs"); ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="profile-tab-content">
                    <?= view('partials/_messages'); ?>
                    <form action="<?= base_url('edit-location-post'); ?>" method="post" id="form_validate">
                        <?= csrf_field(); ?>
                        <div class="form-group m-0">
                            <label class="control-label"><?= trans("location"); ?></label>
                            <?= view('partials/_location', ['countries' => getCountries(), 'countryId' => user()->country_id, 'stateId' => user()->state_id, 'cityId' => user()->city_id, 'isLocationOptional' => true]); ?>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="row">
                                <div class="col-sm-12 col-lg-9 m-b-15">
                                    <input type="text" name="address" id="address_input" class="form-control form-input" value="<?= esc(user()->address); ?>" placeholder="<?= trans("address") ?>" maxlength="490">
                                </div>
                                <div class="col-sm-12 col-lg-3 m-b-15">
                                    <input type="text" name="zip_code" id="zip_code_input" class="form-control form-input" value="<?= esc(user()->zip_code); ?>" placeholder="<?= trans("zip_code") ?>" maxlength="90">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="show_location" value="1" id="checkbox_show_location" class="custom-control-input" <?= user()->show_location == 1 ? 'checked' : ''; ?>>
                                <label for="checkbox_show_location" class="custom-control-label"><?= trans("show_my_location"); ?></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-custom m-t-10"><?= trans("save_changes") ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>