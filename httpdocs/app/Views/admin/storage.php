<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('storage'); ?></h3>
            </div>
            <form action="<?= base_url('Admin/storagePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("storage"); ?></label>
                        <?= formRadio('storage', 'local', 'aws_s3', trans("local_storage"), trans("aws_storage"), $storageSettings->storage); ?>
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="action" value="save" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('aws_storage'); ?></h3>
            </div>
            <form action="<?= base_url('Admin/awsS3Post'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= trans('aws_key'); ?></label>
                        <input type="text" class="form-control" name="aws_key" placeholder="<?= trans('aws_key'); ?>" value="<?= esc($storageSettings->aws_key); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('aws_secret'); ?></label>
                        <input type="text" class="form-control" name="aws_secret" placeholder="<?= trans('aws_secret'); ?>" value="<?= esc($storageSettings->aws_secret); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('bucket_name'); ?></label>
                        <input type="text" class="form-control" name="aws_bucket" placeholder="<?= trans('bucket_name'); ?>" value="<?= esc($storageSettings->aws_bucket); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('region'); ?></label>
                        <input type="text" class="form-control" name="aws_region" placeholder="E.g: us-east-1" value="<?= esc($storageSettings->aws_region); ?>" required>
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="action" value="save" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>