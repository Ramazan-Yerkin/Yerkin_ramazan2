<?php namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends BaseModel
{
    protected $builder;
    protected $builderMessages;

    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('chat');
        $this->builderMessages = $this->db->table('chat_messages');
    }

    //add chat
    public function addChat()
    {
        $data = [
            'sender_id' => user()->id,
            'receiver_id' => inputPost('receiver_id'),
            'subject' => inputPost('subject'),
            'product_id' => inputPost('product_id'),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s")
        ];
        if (empty($data['product_id'])) {
            $data['product_id'] = 0;
        }
        if ($this->builder->insert($data)) {
            return $this->db->insertID();
        }
        return false;
    }

    //add message
    public function addMessage($chatId)
    {
        $data = [
            'chat_id' => $chatId,
            'sender_id' => user()->id,
            'receiver_id' => inputPost('receiver_id'),
            'message' => inputPost('message'),
            'is_read' => 0,
            'deleted_user_id' => 0,
            'created_at' => date("Y-m-d H:i:s")
        ];
        if (!empty($data['message'])) {
            if ($this->builderMessages->insert($data)) {
                $messageId = $this->db->insertID();
                $this->builder->where('id', clrNum($chatId))->update(['updated_at' => date("Y-m-d H:i:s")]);
                //set cache
                $this->setChatCache($data['receiver_id']);
                //send email
                $this->addMessageEmail($messageId);
                return $messageId;
            }
        }
        return false;
    }

    //add message
    public function addMessageEmail($messageId)
    {
        $message = $this->getMessage($messageId);
        if (!empty($message)) {
            $chat = $this->getChat($message->chat_id);
            $receiver = getUser($message->receiver_id);
            if (!empty($chat) && !empty($receiver) && $receiver->send_email_new_message == 1 && !empty($message->message)) {
                $emailData = [
                    'email_type' => 'new_message',
                    'email_address' => $receiver->email,
                    'email_subject' => trans("you_have_new_message"),
                    'email_data' => serialize(['messageSender' => getUsername(user()), 'messageSubject' => $chat->subject, 'messageText' => $message->message]),
                    'template_path' => 'email/new_message'
                ];
                addToEmailQueue($emailData);
            }
        }
    }

    //get chats by user id
    public function getChats($userId)
    {
        return $this->builder->select('chat.*,
        user_receiver.username AS receiver_username, user_receiver.first_name AS receiver_first_name, user_receiver.last_name AS receiver_last_name, user_receiver.avatar AS receiver_avatar, user_receiver.role_id AS receiver_role_id,
        user_sender.username AS sender_username, user_sender.first_name AS sender_first_name, user_sender.last_name AS sender_last_name, user_sender.avatar AS sender_avatar, user_sender.role_id AS sender_role_id,
        (SELECT COUNT(chat_messages.id) FROM chat_messages WHERE chat_messages.chat_id = chat.id AND chat_messages.receiver_id = ' . clrNum($userId) . ' AND  is_read = 0) AS num_unread_messages')
            ->join('users AS user_receiver', 'chat.receiver_id = user_receiver.id')
            ->join('users AS user_sender', 'chat.sender_id = user_sender.id')
            ->where('chat.id IN (SELECT DISTINCT chat_messages.chat_id FROM chat_messages WHERE (chat_messages.receiver_id =  ' . clrNum($userId) . ' OR chat_messages.sender_id =  ' . clrNum($userId) . ') AND chat_messages.deleted_user_id !=  ' . clrNum($userId) . ')')
            ->orderBy('num_unread_messages, chat.updated_at', 'DESC')->get()->getResult();
    }

    //get user unread chats
    public function getUnreadChatsCount($userId)
    {
        return $this->builder->where('chat.id IN (SELECT chat_id FROM chat_messages WHERE receiver_id = ' . clrNum($userId) . ' AND is_read = 0 AND deleted_user_id = 0)')->countAllResults();
    }

    //get chat
    public function getChat($id)
    {
        return $this->builder->where('id', clrNum($id))->get()->getRow();
    }

    //get message
    public function getMessage($id)
    {
        return $this->builderMessages->where('id', clrNum($id))->get()->getRow();
    }

    //get messages
    public function getMessages($chatId)
    {
        return $this->builderMessages->select('chat_messages.*, (SELECT avatar FROM users WHERE chat_messages.sender_id = users.id LIMIT 1) AS user_avatar')
            ->where('chat_messages.chat_id', clrNum($chatId))->get()->getResult();
    }

    //get latest messages
    public function getLatestMessages($chatId, $limit)
    {
        return $this->builderMessages->select('chat_messages.*, (SELECT avatar FROM users WHERE chat_messages.sender_id = users.id LIMIT 1) AS user_avatar')
            ->orderBy('id DESC')->where('chat_id', clrNum($chatId))->get(clrNum($limit))->getResult();
    }

    //set chat messages as read
    public function setChatMessagesAsRead($chatId)
    {
        $messages = $this->getUnreadMessages($chatId);
        if (!empty($messages)) {
            foreach ($messages as $message) {
                if ($message->receiver_id == user()->id) {
                    $this->builderMessages->where('id', $message->id)->update(['is_read' => 1]);
                }
            }
        }
    }

    //get unread messages
    public function getUnreadMessages($chatId)
    {
        return $this->builderMessages->where('chat_id', $chatId)->where('receiver_id', user()->id)->where('is_read', 0)
            ->orderBy('id DESC')->get()->getResult();
    }

    //build chats array
    public function getChatsArray($chatId = null)
    {
        $array = [];
        $chats = $this->getChats(user()->id);
        if (!empty($chats)) {
            foreach ($chats as $item) {
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
                if (!empty($user)) {
                    $item = [
                        'class' => $item->id === $chatId ? 'active' : '',
                        'chatId' => $item->id,
                        'username' => esc($username),
                        'avatar' => getUserAvatar($user),
                        'subject' => esc(characterLimiter($item->subject, 280, '...')),
                        'numUnreadMessages' => $item->num_unread_messages,
                        'updatedAt' => !empty($item->updated_at) ? timeAgo($item->updated_at) : null
                    ];
                    array_push($array, $item);
                }
            }
        }
        return $array;
    }

    //build messages array
    public function getMessagesArray($chatId)
    {
        $array = [];
        $messages = $this->getLatestMessages($chatId, 10);
        if (!empty($messages)) {
            foreach ($messages as $message) {
                if ($message->deleted_user_id != user()->id) {
                    $isRight = true;
                    if (user()->id == $message->receiver_id) {
                        $isRight = false;
                    }
                    $item = [
                        'id' => $message->id,
                        'message' => $message->message,
                        'avatar' => getChatUserAvatar($message),
                        'time' => timeAgo($message->created_at),
                        'isRight' => $isRight
                    ];
                    array_push($array, $item);
                }
            }
        }
        return $array;
    }

    //check user chat cache
    public function checkUserChatCache($receiverId)
    {
        $cache = \Config\Services::cache();
        $hasMessage = false;
        if (!empty($cache->get('chat_cache'))) {
            $array = $cache->get('chat_cache');
            if (!empty($array[$receiverId])) {
                $hasMessage = true;
                $array[$receiverId] = 0;
            }
            $cache->save('chat_cache', $array, 86400);
        }
        return $hasMessage;
    }

    //set chat cache
    private function setChatCache($receiverId)
    {
        $cache = \Config\Services::cache();
        $array = array();
        if (!empty($cache->get('chat_cache'))) {
            $array = $cache->get('chat_cache');
        }
        $array[$receiverId] = 1;
        $cache->save('chat_cache', $array, 86400);
    }

    //delete chat
    public function deleteChat($id)
    {
        $chat = $this->getChat($id);
        if (!empty($chat)) {
            $messages = $this->getMessages($chat->id);
            if (!empty($messages)) {
                foreach ($messages as $message) {
                    if ($message->sender_id == user()->id || $message->receiver_id == user()->id) {
                        if ($message->deleted_user_id == 0) {
                            $data = ['deleted_user_id' => user()->id];
                            $this->builderMessages->where('id', $message->id)->update($data);
                        } else {
                            $this->builderMessages->where('id', $message->id)->delete();
                        }
                    }
                }
            }
            //delete chat if does not have messages
            $messages = $this->getMessages($chat->id);
            if (empty($messages)) {
                $this->builder->where('id', $chat->id)->delete();
            }
        }
    }
}