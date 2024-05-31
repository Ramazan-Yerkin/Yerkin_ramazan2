<?php include FCPATH . 'assets/vendor/tinymce/languages.php'; ?>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("update_language"); ?></h3>
            </div>
            <form action="<?= base_url('Language/editLanguagePost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= esc($language->id); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("language_name"); ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= trans("language_name"); ?>" value="<?= esc($language->name); ?>" maxlength="200" required>
                        <small>(Ex: English)</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans("short_form"); ?> </label>
                        <input type="text" class="form-control" name="short_form" placeholder="<?= trans("short_form"); ?>" value="<?= esc($language->short_form); ?>" maxlength="200" required>
                        <small>(Ex: en)</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans("language_code"); ?> </label>
                        <input type="text" class="form-control" name="language_code" placeholder="<?= trans("language_code"); ?>" value="<?= esc($language->language_code); ?>" maxlength="200" required>
                        <small>(Ex: en_us)</small>
                    </div>
                    <div class="form-group">
                        <label><?= trans('order'); ?></label>
                        <input type="number" class="form-control" name="language_order" placeholder="<?= trans('order'); ?>" value="<?= esc($language->language_order); ?>" min="1" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("text_direction"); ?></label>
                        <?= formRadio('text_direction', 'ltr', 'rtl', trans("left_to_right"), trans("right_to_left"), $language->text_direction); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans('text_editor_language'); ?></label>
                        <select name="text_editor_lang" class="form-control" required>
                            <option value=""><?= trans("select"); ?></option>
                            <?php if (!empty($edLangArray)):
                                foreach ($edLangArray as $edLang): ?>
                                    <option value="<?= $edLang['short']; ?>" <?= $edLang['short'] == $language->text_editor_lang ? 'selected' : ''; ?>><?= $edLang['name']; ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans("flag"); ?></label>
                        <div class="display-block m-b-15">
                            <img src="<?= base_url($language->flag_path); ?>" alt=""/>
                        </div>
                        <div class="display-block">
                            <a class='btn btn-default btn-sm btn-file-upload'>
                                <i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?= trans("select_image"); ?>
                                <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info-flag').html($(this).val().replace(/.*[\/\\]/, ''));">
                            </a>
                            <br>
                            <span class='label label-default label-file-upload' id="upload-file-info-flag"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('status', 1, 0, trans("active"), trans("inactive"), $language->status); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>