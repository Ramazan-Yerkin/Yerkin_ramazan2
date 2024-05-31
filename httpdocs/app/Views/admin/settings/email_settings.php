<div class="row">
    <div class="col-sm-12 col-lg-6">
        <form action="<?= base_url('Admin/emailSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('email_settings'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= trans('mail_service'); ?></label>
                        <select name="mail_service" class="form-control" onchange="window.location.href = '<?= adminUrl(); ?>/email-settings?service='+this.value+'&protocol=<?= esc($protocol); ?>';">
                            <option value="swift" <?= $service == "swift" ? "selected" : ""; ?>>Swift Mailer</option>
                            <option value="php" <?= $service == "php" ? "selected" : ""; ?>>PHP Mailer</option>
                            <option value="mailjet" <?= $service == "mailjet" ? "selected" : ""; ?>>Mailjet</option>
                        </select>
                    </div>
                    <?php if ($service == 'mailjet'): ?>
                        <div class="form-group">
                            <label class="control-label"><?= trans('api_key'); ?></label>
                            <input type="text" class="form-control" name="mailjet_api_key" placeholder="<?= trans('api_key'); ?>" value="<?= esc($generalSettings->mailjet_api_key); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= trans('secret_key'); ?></label>
                            <input type="text" class="form-control" name="mailjet_secret_key" placeholder="<?= trans('secret_key'); ?>" value="<?= esc($generalSettings->mailjet_secret_key); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= trans('mailjet_email_address'); ?>&nbsp;(<small><?= trans("mailjet_email_address_exp"); ?></small>)</label>
                            <input type="text" class="form-control" name="mailjet_email_address" placeholder="<?= trans('mailjet_email_address'); ?>" value="<?= esc($generalSettings->mailjet_email_address); ?>">
                        </div>
                        <input type="hidden" name="mail_protocol" value="<?= esc($generalSettings->mail_protocol); ?>">
                        <input type="hidden" name="mail_encryption" value="<?= esc($generalSettings->mail_encryption); ?>">
                        <input type="hidden" name="mail_host" value="<?= esc($generalSettings->mail_host); ?>">
                        <input type="hidden" name="mail_port" value="<?= esc($generalSettings->mail_port); ?>">
                        <input type="hidden" name="mail_username" value="<?= esc($generalSettings->mail_username); ?>">
                        <input type="hidden" name="mail_password" value="<?= esc($generalSettings->mail_password); ?>">
                        <input type="hidden" name="mail_reply_to" value="<?= esc($generalSettings->mail_reply_to); ?>">
                    <?php else: ?>
                        <input type="hidden" name="mailjet_api_key" value="<?= esc($generalSettings->mailjet_api_key); ?>">
                        <input type="hidden" name="mailjet_secret_key" value="<?= esc($generalSettings->mailjet_secret_key); ?>">
                        <input type="hidden" name="mailjet_email_address" value="<?= esc($generalSettings->mailjet_email_address); ?>">
                        <div class="form-group">
                            <label class="control-label"><?= trans('mail_protocol'); ?></label>
                            <select name="mail_protocol" class="form-control" onchange="window.location.href = '<?= adminUrl(); ?>/email-settings?service=<?= esc($service); ?>&protocol='+this.value;">
                                <option value="smtp" <?= $protocol == 'smtp' ? "selected" : ""; ?>><?= trans('smtp'); ?></option>
                                <option value="mail" <?= $protocol == 'mail' ? "selected" : ""; ?>><?= trans('mail'); ?></option>
                            </select>
                        </div>
                        <?php if ($protocol == 'smtp'): ?>
                            <div class="form-group">
                                <label class="control-label"><?= trans('encryption'); ?></label>
                                <select name="mail_encryption" class="form-control">
                                    <option value="tls" <?= $generalSettings->mail_encryption == "tls" ? "selected" : ""; ?>>TLS</option>
                                    <option value="ssl" <?= $generalSettings->mail_encryption == "ssl" ? "selected" : ""; ?>>SSL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans('mail_host'); ?></label>
                                <input type="text" class="form-control" name="mail_host" placeholder="<?= trans('mail_host'); ?>" value="<?= esc($generalSettings->mail_host); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans('mail_port'); ?></label>
                                <input type="text" class="form-control" name="mail_port" placeholder="<?= trans('mail_port'); ?>" value="<?= esc($generalSettings->mail_port); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans('mail_username'); ?></label>
                                <input type="text" class="form-control" name="mail_username" placeholder="<?= trans('mail_username'); ?>" value="<?= esc($generalSettings->mail_username); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans('mail_password'); ?></label>
                                <input type="password" class="form-control" name="mail_password" placeholder="<?= trans('mail_password'); ?>" value="<?= esc($generalSettings->mail_password); ?>">
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="mail_encryption" value="<?= esc($generalSettings->mail_encryption); ?>">
                            <input type="hidden" name="mail_host" value="<?= esc($generalSettings->mail_host); ?>">
                            <input type="hidden" name="mail_port" value="<?= esc($generalSettings->mail_port); ?>">
                            <input type="hidden" name="mail_username" value="<?= esc($generalSettings->mail_username); ?>">
                            <input type="hidden" name="mail_password" value="<?= esc($generalSettings->mail_password); ?>">
                        <?php endif;
                    endif; ?>
                    <div class="form-group">
                        <label class="control-label"><?= trans('mail_title'); ?></label>
                        <input type="text" class="form-control" name="mail_title" placeholder="<?= trans('mail_title'); ?>" value="<?= esc($generalSettings->mail_title); ?>">
                    </div>
                    <?php if ($service != 'mailjet'): ?>
                        <div class="form-group">
                            <label class="control-label"><?= trans('reply_to'); ?></label>
                            <input type="email" class="form-control" name="mail_reply_to" placeholder="<?= trans('reply_to'); ?>" value="<?= esc($generalSettings->mail_reply_to); ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="email" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>

        <form action="<?= base_url('Admin/sendTestEmailPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('send_test_email'); ?></h3><br>
                    <small class="small-title"><?= trans('send_test_email_exp'); ?></small>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= trans('email_address'); ?></label>
                        <input type="text" class="form-control" name="email" placeholder="<?= trans('email_address'); ?>" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="contact" class="btn btn-primary pull-right"><?= trans('send_email'); ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-12 col-lg-6">
        <form action="<?= base_url('Admin/emailOptionsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= trans('email_options'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("email_verification"); ?></label>
                        <?= formRadio('email_verification', 1, 0, trans("enable"), trans("disable"), $generalSettings->email_verification); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("email_option_product_added"); ?></label>
                        <?= formRadio('send_email_new_product', 1, 0, trans("yes"), trans("no"), $generalSettings->send_email_new_product); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("email_option_send_order_to_buyer"); ?></label>
                        <?= formRadio('send_email_buyer_purchase', 1, 0, trans("yes"), trans("no"), $generalSettings->send_email_buyer_purchase); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("email_option_send_email_order_shipped"); ?></label>
                        <?= formRadio('send_email_order_shipped', 1, 0, trans("yes"), trans("no"), $generalSettings->send_email_order_shipped); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("email_option_contact_messages"); ?></label>
                        <?= formRadio('send_email_contact_messages', 1, 0, trans("yes"), trans("no"), $generalSettings->send_email_contact_messages); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("send_email_shop_opening_request"); ?></label>
                        <?= formRadio('send_email_shop_opening_request', 1, 0, trans("yes"), trans("no"), $generalSettings->send_email_shop_opening_request); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("bidding_system_emails"); ?></label>
                        <?= formRadio('send_email_bidding_system', 1, 0, trans("enable"), trans("disable"), $generalSettings->send_email_bidding_system); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('email_address'); ?> (<?= trans("admin_emails_will_send"); ?>)</label>
                        <input type="email" class="form-control" name="mail_options_account" placeholder="<?= trans('email_address'); ?>" value="<?= esc($generalSettings->mail_options_account); ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="verification" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>