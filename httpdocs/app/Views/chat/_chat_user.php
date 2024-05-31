<?php if (!empty($chat)):
    $profileId = $chat->sender_id;
    if (user()->id == $chat->sender_id) {
        $profileId = $chat->receiver_id;
    }
    $profile = getUser($profileId);
    if (!empty($profile)): ?>
        <div class="chat-user">
            <button type="button" id="btnOpenChatContacts" class="btn-open-chat-contacts">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
            </button>
            <div class="flex-item flex-shrink-0">
                <a href="<?= generateProfileUrl($profile->slug); ?>" target="_blank">
                    <div class="user-img">
                        <img src="<?= getUserAvatar($profile); ?>" alt="<?= esc(getUsername($profile)); ?>">
                    </div>
                </a>
            </div>
            <div class="flex-item flex-item-center">
                <a href="<?= generateProfileUrl($profile->slug); ?>" target="_blank">
                    <?= esc(getUsername($profile)); ?>
                </a>
                <p class="p-last-seen">
                    <?php if (isUserOnline($profile->last_seen)): ?>
                        <span class="last-seen last-seen-online"> <i class="icon-circle"></i> <?= trans("online"); ?></span>
                    <?php else: ?>
                        <span class="last-seen"> <i class="icon-circle"></i> <?= trans("offline"); ?></span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="flex-item flex-shrink-0">
                <button type="button" class="btn btn-chat-delete" onclick='deleteChat(<?= $chat->id; ?>,"<?= trans("confirm_message", true); ?>");'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                </button>
            </div>
        </div>
        <?php if (!empty($chat->product_id)):
            $product = getProduct($chat->product_id);
            if (!empty($product)):?>
                <p class="topic"><a href="<?= generateProductUrl($product); ?>" target="_blank"><?= esc($chat->subject); ?></a></p>
            <?php endif;
        else: ?>
            <p class="topic"><?= esc($chat->subject); ?></p>
        <?php endif;
    endif;
endif; ?>