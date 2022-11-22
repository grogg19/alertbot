<?php

namespace App\Telegram\Types;

use App\Actions\TelegramSendDiceAction;

/**
 * Class MessageHandler
 */
class MessageHandler extends ResponseHandler
{
    public const TYPE = 'message';

    /**
     * @return void
     * @throws \Exception
     */
    public function response(): void
    {
        if ($this->update->getMessage()->getDice()) {
            TelegramSendDiceAction::send($this->chatId, $this->update->getMessage()->getDice()->getEmoji());
        }
    }

    /**
     * @return string
     */
    public static function getType(): string
    {
        return self::TYPE;
    }

}
