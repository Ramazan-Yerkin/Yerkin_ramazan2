<?php if (!empty($chat)): ?>
    <div id="formChat">
        <input type="hidden" id="inputChatId" name="chat_id" value="<?= $chat->id; ?>">
        <?php if (user()->id == $chat->sender_id): ?>
            <input type="hidden" name="receiver_id" id="inputChatReceiverId" value="<?= $chat->receiver_id; ?>">
        <?php else: ?>
            <input type="hidden" name="receiver_id" id="inputChatReceiverId" value="<?= $chat->sender_id; ?>">
        <?php endif; ?>
        <input type="text" name="message" id="inputChatMessage" class="form-control" placeholder="<?= trans('write_a_message'); ?>" autocomplete="off" onkeypress="if(event.keyCode === 13){sendChatMessage()};">
        <button type="button" id="btnChatSubmit" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#273244" class="bi bi-send" viewBox="0 0 16 16">
                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
            </svg>
        </button>
    </div>
<?php else: ?>
    <input type="text" name="message" class="form-control" placeholder="<?= trans('write_a_message'); ?>" autocomplete="off" required>
    <button type="button" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#273244" class="bi bi-send" viewBox="0 0 16 16">
            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
        </svg>
    </button>
<?php endif; ?>