<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class CurrentTaskCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "current_task";

    /**
     * @var string Command Description
     */
    protected $description = "Информация о текущем задании";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        // ToDo: Получить информацию о текущем задании
        $this->replyWithMessage(['text' => 'У вас нет текущих задач']);

    }
}