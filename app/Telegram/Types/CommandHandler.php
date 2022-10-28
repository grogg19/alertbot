<?php

namespace App\Telegram\Types;

use App\Telegram\Types\Commands\DefaultCommand;
use App\Telegram\Types\Commands\StartCommand;

/**
 * Class CommandHandler
 */
class CommandHandler extends ResponseHandler
{
    public const TYPE = 'command';

    /**
     * @return void
     */
    public function response(): void
    {
        switch ($this->update->getMessage()->getCommand()) {
            case 'start' :
                $command = new StartCommand($this->update);
                break;
            default:
                $command = new DefaultCommand($this->update);
                break;
        }

        $command->run();
    }
}
