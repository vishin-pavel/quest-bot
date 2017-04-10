<?php

namespace app\components\Telegram\Bot\commands;


use app\models\TelegramUser;
use app\models\User;
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
        $user = TelegramUser::findOne($this->getUpdate()->getChat()->getId());
        $user->games;
        $this->replyWithMessage(['text' => 'У вас нет текущих игр']);
    }
}