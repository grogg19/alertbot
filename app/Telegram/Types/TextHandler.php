<?php

namespace App\Telegram\Types;

use App\Actions\TelegramSendMessageAction;
use Illuminate\Support\Str;
use Longman\TelegramBot\Entities\Update;

/**
 * Class TextHandler
 */
class TextHandler extends ResponseHandler
{
    public const TYPE = 'text';

    public function __construct(Update $update) { parent::__construct($update); }

    /**
     * @return void
     * @throws \Exception
     */
    public function response(): void
    {
        $text        = (string)$this->update->getMessage()->getText();
        $reverseText = Str::reverse($text);
        TelegramSendMessageAction::send($this->chatId, $reverseText);
    }
}
