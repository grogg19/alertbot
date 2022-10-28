<?php

namespace App\Telegram\Interfaces;

/**
 * Interface CommandRunnable
 */
interface CommandRunnable
{
    /**
     * @return void
     */
    public function run(): void;
}
