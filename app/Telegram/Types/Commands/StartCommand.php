<?php

namespace App\Telegram\Types\Commands;

use App\Actions\TelegramSendMessageAction;
use App\Repositories\TelegramChatRepository;
use App\Services\TelegramBotService;
use App\Telegram\Interfaces\CommandRunnable;

/**
 * Class StartCommand
 */
class StartCommand extends AbstractTelegramTypeCommand implements CommandRunnable
{
    /**
     * @return void
     */
    public function run(): void
    {
        $chatId = $this->update->getMessage()->getChat()->getId();

        $userFullName = $this->update->getMessage()->getFrom()->getFirstName() . ' ' . $this->update->getMessage()->getFrom()->getLastName();

        if ($this->isChatNotExist($chatId) === true) {
            $telegramBotService = new TelegramBotService();
            $telegramBotService->saveTelegramChat($this->update);
        }

        TelegramSendMessageAction::send($chatId, 'Добро пожаловать, ' . $userFullName);
    }

    /**
     * @param int $chatId
     *
     * @return bool
     */
    public function isChatNotExist(int $chatId): bool
    {
        $chatRepository = new TelegramChatRepository();

        return $chatRepository->getTelegramChatByChatId($chatId)->isEmpty();
    }

}
