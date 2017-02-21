<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartTaskCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start_task";

    /**
     * @var string Command Description
     */
    protected $description = "Начать выполнение следующего задания в текущей игре";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        //ToDo: Запустить выполнение задания
        $this->replyWithMessage(['text' => 'У вас нет активных игр']);
    }
}