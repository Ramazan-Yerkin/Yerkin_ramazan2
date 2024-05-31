<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= trans("messages"); ?></li>
                    </ol>
                </nav>
                <h1 class="page-title visibility-hidden" style="height: 0; margin: 0;"><?= trans("messages"); ?></h1>
            </div>
            <div class="col-12">
                <?php if (!empty($chats)): ?>
                    <div id="mdsChat" class="row chat <?= empty($chat) ? 'chat-empty' : ''; ?>">
                        <div class="col chat-left">
                            <div class="chat-left-inner">
                                <div class="chat-user">
                                    <div class="flex-item">
                                        <div class="user-img">
                                            <img src="<?= getUserAvatar(user()); ?>" alt="<?= esc(getUsername(user())); ?>">
                                        </div>
                                        <span class="chat-badge-online"></span>
                                    </div>
                                    <div class="flex-item">
                                        <?= esc(getUsername(user())); ?>
                                    </div>
                                </div>
                                <div class="chat-search">
                                    <div class="position-relative">
                                        <input type="text" name="search" id="chatSearchContacts" class="form-control input-search" maxlength="300" placeholder="<?= trans("search"); ?>">
                                        <i class="icon-search"></i>
                                    </div>
                                </div>
                                <div class="text-recent-chats"><?= trans("recent_chats"); ?></div>
                                <div class="chat-contacts-container mds-scrollbar">
                                    <div id="chatContactsContainer" class="chat-contacts">
                                        <?php foreach ($chats as $item):
                                            $user = new \stdClass();
                                            if ($item->receiver_id == user()->id) {
                                                $user->username = $item->sender_username;
                                                $user->first_name = $item->sender_first_name;
                                                $user->last_name = $item->sender_last_name;
                                                $user->avatar = $item->sender_avatar;
                                                $user->role_id = $item->sender_role_id;
                                            } else {
                                                $user->username = $item->receiver_username;
                                                $user->first_name = $item->receiver_first_name;
                                                $user->last_name = $item->receiver_last_name;
                                                $user->avatar = $item->receiver_avatar;
                                                $user->role_id = $item->receiver_role_id;
                                            }
                                            $username = $user->first_name . ' ' . $user->last_name;
                                            if (isVendorByRoleId($user->role_id)) {
                                                $username = $user->username;
                                            }
                                            if (!empty($user)):?>
                                                <div class="item">
                                                    <div class="chat-contact" data-chat-id="<?= $item->id; ?>">
                                                        <div class="flex-item">
                                                            <div class="item-img">
                                                                <img src="<?= getUserAvatar($user); ?>" alt="<?= esc($username); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="flex-item flex-item-center">
                                                            <h6 class="username">
                                                                <?= esc($username); ?>
                                                            </h6>
                                                            <p class="subject"><?= esc(characterLimiter($item->subject, 280, '...')); ?></p>
                                                            <?php if (!empty($item->updated_at)): ?>
                                                                <div class="time"><?= timeAgo($item->updated_at); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if ($item->num_unread_messages > 0): ?>
                                                            <div class="flex-item">
                                                                <label id="chatBadge<?= $item->id; ?>" class="badge badge-success"><?= $item->num_unread_messages ?></label>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col chat-right">
                            <div id="chatUserContainer" class="chat-header">
                                <?php if (!empty($chat)):
                                    view('chat/_chat_user', ['chat' => $chat]);
                                endif; ?>
                            </div>
                            <div class="chat-content">
                                <div id="chatMessagesContainer" class="messages">
                                    <?php if (!empty($chat) && !empty($messages)):
                                        echo view('chat/_messages', ['chat' => $chat, 'messages' => $messages]);
                                    endif;
                                    if (empty($chat)): ?>
                                        <div class="select-chat-container">
                                            <label class="badge"><?= trans("select_chat_start_messaging"); ?></label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div id="chatInputContainer" class="chat-input">
                                    <?php if (!empty($chat)):
                                        echo view('chat/_chat_form', ['chat' => $chat]);
                                    else: ?>
                                        <input type="text" name="message" class="form-control" placeholder="<?= trans('write_a_message'); ?>" autocomplete="off" disabled>
                                        <button type="button" class="btn" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#273244" class="bi bi-send" viewBox="0 0 16 16">
                                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                            </svg>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center"><?= trans("no_messages_found"); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<style>
    @media (max-width: 992px) {
        .chat-left .chat-contacts-container {
            height: 380px !important;
        }
        .chat .chat-content {
            height: 380px !important;
        }
    }
</style>