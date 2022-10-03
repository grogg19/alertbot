<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\Request;

/**
 * Class TelegramController
 */
class TelegramController extends Controller
{
    /**
     * @param Request            $request
     * @param TelegramBotService $telegramBotService
     *
     * @return void
     */
    public function index(Request $request, TelegramBotService $telegramBotService): void
    {
        if ($request->isJson()) {
            $telegramBotService->handler();
        }
    }
}
