<?php

namespace App\Telegram\Types\Commands;

use App\Actions\TelegramSendMessageAction;
use App\Telegram\Interfaces\CommandRunnable;

/**
 * Class DefaultCommand
 */
class DefaultCommand extends AbstractTelegramTypeCommand implements CommandRunnable
{
    public function run(): void
    {
        $chatId      = $this->update->getMessage()->getChat()->getId();
        $commandText = $this->update->getMessage()->getCommand();
        TelegramSendMessageAction::send($chatId, 'Неизвестная команда: /' . $commandText);
    }
}
