<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * Class TelegramSendMessageAction
 */
class TelegramSendMessageAction
{


    /**
     * @param int    $chatId
     * @param string $text
     *
     * @return void
     */
    public static function send(int $chatId, array|string $text): void
    {
        $url = config('telegram.host') . ':8081/bot' . config('telegram.token') . '/sendMessage';

        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $text
        ]);
    }
}
