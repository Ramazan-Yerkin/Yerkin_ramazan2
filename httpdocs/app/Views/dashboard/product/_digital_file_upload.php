<?php $exts = str_replace('"', '', $productSettings->digital_allowed_file_extensions ?? '');
$exts = str_replace(',', ", ", $exts ?? '');
$exts = strtoupper($exts); ?>
<div class="form-box">
    <div class="form-box-head">
        <h4 class="title">
            <?= trans('digital_file'); ?>
            <small><?= trans("allowed_file_extensions"); ?>:&nbsp;<strong class="font-500"><?= $exts; ?></strong></small>
        </h4>
    </div>
    <?php if ($productSettings->digital_external_link == 1): ?>
        <ul class="nav nav-tabs nav-tabs-digital-file">
            <li <?= empty($product->digital_file_download_link) ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#tabContentUploadFile"><?= trans("upload_file"); ?></a></li>
            <li <?= !empty($product->digital_file_download_link) ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#tabContentAddUrl"><?= trans("add_external_download_link"); ?></a></li>
        </ul>
        <div class="tab-content">
            <div id="tabContentUploadFile" class="tab-pane fade<?= empty($product->digital_file_download_link) ? ' in active' : ''; ?>">
                <div class="form-box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="digital_files_upload_result" class="row-custom">
                                <?= view('dashboard/product/_digital_files_upload_response'); ?>
                            </div>
                            <div class="error-message error-message-file-upload"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabContentAddUrl" class="tab-pane fade<?= !empty($product->digital_file_download_link) ? ' in active' : ''; ?>">
                <div class="form-box-body">
                    <input type="text" name="digital_file_download_link" class="form-control form-input" value="<?= esc($product->digital_file_download_link); ?>" placeholder="<?= trans("external_download_link"); ?>" maxlength="499" onchange="$('#inputDigitalFileLink').val($(this).val());">
                </div>
                <p class="images-exp m-t-10"><i class="icon-exclamation-circle"></i><?= trans("warning_external_download_link"); ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="form-box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="digital_files_upload_result" class="row-custom">
                        <?= view('dashboard/product/_digital_files_upload_response'); ?>
                    </div>
                    <div class="error-message error-message-file-upload"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script type="text/html" id="files-template-digital-files">
    <li class="media">
        <div class="media-body">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </li>
</script>

<script>
    $(document).bind('ready ajaxComplete', function () {
        $('#drag-and-drop-zone-digital-files').dmUploader({
            url: '<?= base_url('upload-digital-file-post'); ?>',
            queue: true,
            extFilter: [<?= $productSettings->digital_allowed_file_extensions;?>],
            multiple: false,
            extraData: function (id) {
                return {
                    'product_id': <?= $product->id; ?>,
                    '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onNewFile: function (id, file) {
                ui_multi_add_file(id, file, "digital-files");
            },
            onBeforeUpload: function (id) {
                ui_multi_update_file_progress(id, 0, '', true);
                ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            },
            onUploadProgress: function (id, percent) {
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                var obj = JSON.parse(data);
                if (obj.result == 1) {
                    document.getElementById("digital_files_upload_result").innerHTML = obj.htmlContent;
                }
            },
            onFileExtError: function (file) {
                $(".error-message-file-upload").html("<?= trans('invalid_file_type'); ?>");
                setTimeout(function () {
                    $(".error-message-file-upload").empty();
                }, 4000);
            },
        });
    });
</script>

