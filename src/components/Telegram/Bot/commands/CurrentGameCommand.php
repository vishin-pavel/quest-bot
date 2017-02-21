<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class CurrentGameCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "current_game";

    /**
     * @var string Command Description
     */
    protected $description = "Просмотр информации о текущей игре";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        //Todo Получить список текущих игр
        $this->replyWithMessage(['text' => 'У вас нет текущих игр']);
    }
}