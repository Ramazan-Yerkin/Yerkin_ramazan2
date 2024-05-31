<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= trans('brands'); ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-7 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans('brands'); ?></h3>
                </div>
                <div class="right">
                    <button type="button" class="btn btn-success btn-add-new" data-toggle="modal" data-target="#modalAddBrand"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?= trans('add_brand'); ?></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped cs_datatable_lang" role="grid">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?= trans('id'); ?></th>
                                    <th><?= trans('name'); ?></th>
                                    <th><?= trans('logo'); ?></th>
                                    <th><?= trans('date'); ?></th>
                                    <th class="th-options"><?= trans('options'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($brands)):
                                    foreach ($brands as $brand): ?>
                                        <tr>
                                            <td><?= esc($brand->id); ?></td>
                                            <td><?= esc(getBrandName($brand->name_data, selectedLangId())); ?></td>
                                            <td><img src="<?= base_url($brand->image_path); ?>" width="64"></td>
                                            <td style="width: 200px;"><?= formatDate($brand->created_at); ?></td>
                                            <td style="width: 200px;">
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= trans('select_option'); ?>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modalEditBrand<?= $brand->id; ?>"><i class="fa fa-edit option-icon"></i><?= trans('edit'); ?></a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('Category/deleteBrandPost','<?= $brand->id; ?>','<?= trans("confirm_delete", true); ?>');"><i class="fa fa-trash option-icon"></i><?= trans('delete'); ?></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <div id="modalEditBrand<?= $brand->id; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?= base_url('Category/editBrandPost'); ?>" method="post" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $brand->id; ?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"><?= trans('edit'); ?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label><?= trans("name"); ?></label>
                                                                <?php foreach ($activeLanguages as $language): ?>
                                                                    <input type="text" class="form-control m-b-5" name="name_lang_<?= $language->id; ?>" value="<?= getBrandName($brand->name_data, $language->id); ?>" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?= trans('logo'); ?></label>
                                                                <div class="display-block m-b-10">
                                                                    <img src="<?= base_url($brand->image_path); ?>" width="128">
                                                                </div>
                                                                <div class="display-block">
                                                                    <a class='btn btn-success btn-sm btn-file-upload'>
                                                                        <?= trans('select_logo'); ?>
                                                                        <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info<?= $brand->id; ?>').html($(this).val().replace(/.*[\/\\]/, ''));">
                                                                    </a>
                                                                    (.png, .jpg, .jpeg, .gif)
                                                                </div>
                                                                <span class='label label-info' id="upload-file-info<?= $brand->id; ?>"></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"><?= trans("save_changes"); ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            <?php if (empty($brands)): ?>
                                <p class="text-center">
                                    <?= trans("no_records_found"); ?>
                                </p>
                            <?php endif; ?>
                            <div class="col-sm-12 table-ft">
                                <div class="row">
                                    <div class="pull-right">
                                        <?= $pager->links; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("settings"); ?></h3>
            </div>
            <form action="<?= base_url('Category/brandSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="brand_status" value="1" id="brand_status_1" class="custom-control-input" <?= $productSettings->brand_status == 1 ? 'checked' : ''; ?>>
                                    <label for="brand_status_1" class="custom-control-label"><?= trans("enable"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="brand_status" value="0" id="brand_status_2" class="custom-control-input" <?= $productSettings->brand_status != 1 ? 'checked' : ''; ?>>
                                    <label for="brand_status_2" class="custom-control-label"><?= trans("disable"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= trans("optional"); ?></label>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="is_brand_optional" value="1" id="is_brand_optional_1" class="custom-control-input" <?= $productSettings->is_brand_optional == 1 ? 'checked' : ''; ?>>
                                    <label for="is_brand_optional_1" class="custom-control-label"><?= trans("yes"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="is_brand_optional" value="0" id="is_brand_optional_2" class="custom-control-input" <?= $productSettings->is_brand_optional != 1 ? 'checked' : ''; ?>>
                                    <label for="is_brand_optional_2" class="custom-control-label"><?= trans("no"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= trans("where_to_display"); ?></label>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="brand_where_to_display" value="2" id="where_to_display_1" class="custom-control-input" <?= $productSettings->brand_where_to_display != 1 ? 'checked' : ''; ?>>
                                    <label for="where_to_display_1" class="custom-control-label"><?= trans("additional_information"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="brand_where_to_display" value="1" id="where_to_display_2" class="custom-control-input" <?= $productSettings->brand_where_to_display == 1 ? 'checked' : ''; ?>>
                                    <label for="where_to_display_2" class="custom-control-label"><?= trans("product_details"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans("save_changes"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalAddBrand" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Category/addBrandPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= trans('add_brand'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?= trans("name"); ?></label>
                        <?php foreach ($activeLanguages as $language): ?>
                            <input type="text" class="form-control m-b-5" name="name_lang_<?= $language->id; ?>" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('logo'); ?></label>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?= trans('select_logo'); ?>
                                <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info-add').html($(this).val().replace(/.*[\/\\]/, ''));" required>
                            </a>
                            (.png, .jpg, .jpeg, .gif)
                        </div>
                        <span class='label label-info' id="upload-file-info-add"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?= trans("submit"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>