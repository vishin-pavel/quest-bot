<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartGameCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start_game";

    /**
     * @var string Command Description
     */
    protected $description = "Начать новую игру";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        //ToDo: Запустить новую игру
        $this->replyWithMessage(['text' => 'На данный момент нет доступных игр']);
    }
}