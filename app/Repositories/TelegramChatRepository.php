<?php

namespace App\Repositories;

use App\Models\TelegramChat;
use Illuminate\Support\Collection;

/**
 * Class TelegramChatRepository
 */
class TelegramChatRepository
{
    public function getTelegramChatByChatId(int $chatId): Collection
    {
        return TelegramChat::where('chat_id', $chatId)->get();
    }

    public function getTelegramChatByUsername(string $userName): Collection
    {
        return TelegramChat::where('username', $userName)->get();
    }
}
