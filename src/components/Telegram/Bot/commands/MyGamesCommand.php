<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class MyGamesCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "my_games";

    /**
     * @var string Command Description
     */
    protected $description = "Получить список активных игр";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        //ToDo: Получить список активных игр
        $this->replyWithMessage(['text' => 'На данный момент у вас нет активных игр']);

    }
}