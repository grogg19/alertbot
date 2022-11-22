<?php

namespace App\Actions;

use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Request;

/**
 * Class TelegramSendDiceAction
 */
class TelegramSendDiceAction
{

    /**
     * @param int    $chatId
     * @param string $emoji
     *
     * @return void
     * @throws \Exception
     */
    public static function send(int $chatId, string $emoji): void
    {
        Request::sendChatAction([
            'chat_id' => $chatId,
            'action'  => ChatAction::CHOOSE_STICKER,
        ]);
        sleep(5);
        Request::sendDice([
            'chat_id' => $chatId,
            'emoji'   => $emoji,
        ]);
    }
}
