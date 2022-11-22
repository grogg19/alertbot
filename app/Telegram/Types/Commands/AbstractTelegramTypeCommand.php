<?php

namespace App\Telegram\Types\Commands;

use Longman\TelegramBot\Entities\Update;

/**
 * Abstract class AbstractTelegramTypeCommand
 */
abstract class AbstractTelegramTypeCommand
{
    protected Update $update;

    public function __construct(Update $update)
    {
        $this->update = $update;
    }

    abstract public function run();
}
