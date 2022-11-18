<?php

return [
    'host'            => env('APP_URL', 'https://api.telegram.org'),
    'token'           => env('TELEGRAM_TOKEN'),
    'bot_username'    => env('TELEGRAM_BOT_USERNAME'),
    'chat_id_default' => env('TELEGRAM_CHAT_ID_DEFAULT'),
];
