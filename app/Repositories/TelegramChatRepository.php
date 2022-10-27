<?php

namespace App\Repositories;

use App\Models\TelegramChat;

/**
 * Class TelegramChatRepository
 */
class TelegramChatRepository
{
    public function getTelegramChatById(int $id): TelegramChat|null
    {
        return TelegramChat::find($id);
    }

    public function getTelegramChatByUsername(string $userName): TelegramChat|null
    {
        return TelegramChat::where('username', $userName)->get();
    }
}
