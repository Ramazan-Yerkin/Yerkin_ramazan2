<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans("add_country"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('countries'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= trans('countries'); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/addCountryPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("name"); ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= trans("name"); ?>" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("continent"); ?></label>
                        <select name="continent_code" class="form-control">
                            <?php $continents = getContinents();
                            if (!empty($continents)):
                                foreach ($continents as $key => $value):?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= trans("status"); ?></label>
                        <?= formRadio('status', 1, 0, trans("active"), trans("inactive"), 1); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_country'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>