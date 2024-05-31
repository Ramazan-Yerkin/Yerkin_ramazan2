<div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-send-message" role="document">
        <div class="modal-content">
            <form id="formSendChatMessage" novalidate="novalidate">
                <input type="hidden" name="receiver_id" value="<?= $user->id; ?>">
                <?php if (!empty($productId)): ?>
                    <input type="hidden" name="product_id" value="<?= $productId; ?>">
                <?php endif; ?>
                <div class="modal-header">
                    <?php if (authCheck()): ?>
                        <h4 class="title"><?= trans("send_message"); ?></h4>
                    <?php else: ?>
                        <h4 class="title"><?= trans("contact_seller"); ?></h4>
                    <?php endif; ?>
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="chatSendMessageResult"></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="user-contact-modal">
                                            <div class="left">
                                                <a href="<?= generateProfileUrl($user->slug); ?>"><img src="<?= getUserAvatar($user); ?>" alt="<?= esc(getUsername($user)); ?>"></a>
                                            </div>
                                            <div class="right">
                                                <strong><a href="<?= generateProfileUrl($user->slug); ?>"><?= esc(getUsername($user)); ?></a></strong>
                                                <?php if ($generalSettings->show_vendor_contact_information == 1):
                                                    if (!empty($user->phone_number) && $user->show_phone == 1): ?>
                                                        <p class="info">
                                                            <i class="icon-phone"></i><a href="javascript:void(0)" id="show_phone_number"><?= trans("show"); ?></a>
                                                            <a href="tel:<?= esc($user->phone_number); ?>" id="phone_number" class="display-none"><?= esc($user->phone_number); ?></a>
                                                        </p>
                                                    <?php endif;
                                                    if (!empty($user->email) && $user->show_email == 1): ?>
                                                        <p class="info"><i class="icon-envelope"></i><?= esc($user->email); ?></p>
                                                    <?php endif;
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (authCheck()): ?>
                                <div class="form-group">
                                    <label class="control-label"><?= trans("subject"); ?></label>
                                    <input type="text" name="subject" value="<?= !empty($subject) ? esc($subject) : ''; ?>" class="form-control form-input" placeholder="<?= trans("subject"); ?>" required>
                                </div>
                                <div class="form-group m-b-sm-0">
                                    <label class="control-label"><?= trans("message"); ?></label>
                                    <textarea name="message" class="form-control form-textarea" placeholder="<?= trans("write_a_message"); ?>" required></textarea>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if (authCheck()): ?>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-md btn-custom"><?= trans("send"); ?>&nbsp;&nbsp;<i class="icon-send m-0"></i></button>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>