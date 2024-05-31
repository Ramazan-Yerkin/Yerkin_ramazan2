<?php if (!empty($chat)): ?>
    <div id="messagesContainer<?= $chat->id; ?>" class="messages-inner mds-scrollbar">
        <?php if (!empty($messages)):
            foreach ($messages as $item):
                if ($item->deleted_user_id != user()->id):
                    if (user()->id == $item->receiver_id):?>
                        <div id="chatMessage<?= $item->id; ?>" class="message">
                            <div class="flex-item item-user">
                                <div class="user-img">
                                    <img src="<?= getChatUserAvatar($item); ?>" alt="" class="img-profile">
                                </div>
                            </div>
                            <div class="flex-item">
                                <div class="message-text">
                                    <?= esc($item->message); ?>
                                </div>
                                <div class="time"><span><?= timeAgo($item->created_at); ?></span></div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div id="chatMessage<?= $item->id; ?>" class="message message-right">
                            <div class="flex-item">
                                <div class="message-text">
                                    <?= esc($item->message); ?>
                                </div>
                                <div class="time"><span><?= timeAgo($item->created_at); ?></span></div>
                            </div>
                            <div class="flex-item item-user">
                                <div class="user-img">
                                    <img src="<?= getChatUserAvatar($item); ?>" alt="" class="img-profile">
                                </div>
                            </div>
                        </div>
                    <?php endif;
                endif;
            endforeach;
        endif; ?>
    </div>
<?php endif; ?>