<?php

namespace App\Telegram\Types;

use Longman\TelegramBot\Entities\Update;

/**
 * Class ResponseHandler
 */
abstract class ResponseHandler
{
    protected int $chatId;
    protected Update $update;
    public const TYPE = 'message';

    /**
     * @param Update $update
     */
    public function __construct(Update $update)
    {
        $this->update = $update;
        $this->chatId = $update->getMessage()->getChat()->getId();
    }

    /**
     * @return void
     */
    abstract protected function response(): void;
}
