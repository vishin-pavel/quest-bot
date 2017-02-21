<?php

namespace app\components\Telegram\Bot\commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Приветствие";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->triggerCommand('help');
    }
}