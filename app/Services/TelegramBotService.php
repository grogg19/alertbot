<?php

namespace App\Services;

use App\Actions\TelegramSendMessageAction;
use App\Models\TelegramChat;
use App\Telegram\Types\CommandHandler;
use App\Telegram\Types\MessageHandler;
use App\Telegram\Types\ResponseHandler;
use App\Telegram\Types\TextHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request as TelegramBotRequest;
use Longman\TelegramBot\Telegram;

/**
 * Class TelegramBotService
 */
class TelegramBotService
{
    /**
     * @var Request
     */
    public Request $request;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->request = \request();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handler(): void
    {
        TelegramBotRequest::setCustomBotApiUri(
            $api_base_uri = config('telegram.host') . ':8081/bot' . config('telegram.token'), // Default: https://api.telegram.org
            $api_base_download_uri = storage_path() . '/files/' . config('telegram.token')     // Default: /file/bot{API_KEY}
        );

        try {
            // Create Telegram API object
            $telegram = new Telegram(config('telegram.token'), config('telegram.bot_username'));

            // Handle telegram webhook request
            $telegram->handle();
        } catch (TelegramException $e) {
            // Silence is golden!
            // log telegram errors
            // echo $e->getMessage();
            $message = "{$e->getMessage()}, {$e->getFile()}, {$e->getLine()}";

            Log::error($message);
        }

        if (isset($telegram)) {
            $update = new Update($this->request->post());

            if ($update->getEditedMessage() !== null) {
                TelegramSendMessageAction::send($update->getEditedMessage()->getChat()->getId(), 'Отредактированное сообщение пока не обрабатывается');

                return;
            }

            $type = $update->getMessage()->getType();

            if (in_array($type, $this->getTypeHandlers(), true)) {
                /** @var ResponseHandler $handler */
                $typeHandlerClass = array_search($type, $this->getTypeHandlers(), true);

                $typeHandler = new $typeHandlerClass($update);
                $typeHandler->response();
            }
        }
    }

    /**
     * @param Update $update
     *
     * @return void
     */
    public function saveTelegramChat(Update $update): void
    {
        $data = [
            'chat_id'    => $update->getMessage()->getChat()->getId(),
            'username'   => $update->getMessage()->getChat()->getUsername(),
            'first_name' => $update->getMessage()->getChat()->getFirstName(),
            'last_name'  => $update->getMessage()->getChat()->getLastName(),
        ];

        $telegramChat = new TelegramChat($data);
        $telegramChat->save();
    }

    /**
     * @return array
     */
    public function getTypeHandlers(): array
    {
        return [
            TextHandler::class    => TextHandler::TYPE,
            CommandHandler::class => CommandHandler::TYPE,
            MessageHandler::class => MessageHandler::TYPE,
        ];
    }
}
