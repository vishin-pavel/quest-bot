<?php

namespace app\components\Telegram\Bot\commands;


use app\models\AdditionalGame;
use app\models\Player;
use app\models\search\Hint;
use app\models\Task;
use app\models\TelegramUser;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class AdditionalGameCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "additional_game";

    /**
     * @var string Command Description
     */
    protected $description = "Начать дополнительное задание";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        if(!$user = TelegramUser::findOne($this->getUpdate()->getChat()->getId())){
            $this->replyWithMessage(['text' => 'Увас нет активных игр']);
            return true;
        }
        /** @var Player $player */
        if(!$player = $user->getPlayers()->one()){
            $this->replyWithMessage(['text' => 'Увас нет активных игр']);
            return true;
        }
        /** @var AdditionalGame $additionalGame */
        if(!$additionalGame = AdditionalGame::find()->where(['game_id'=>$player->game_id])->one()){
            $this->replyWithMessage(['text' => 'Для текущей игры нет дополнительных заданий']);
            return true;
        }

        $player->before_additional_game_task = $player->current_task;
        $player->current_task = $additionalGame->first_task_id;
        $player->save();
        $nextTask = Task::findOne($player->current_task);
        $msg = ['text' => $nextTask->start_text];
        if ($nextTask->getHints()->one()){
            $btn      = Keyboard::inlineButton([
                'text'             => 'Взять подсказку',
                'callback_data'    => '/hint'
            ]);
            $keyboard = Keyboard::make()
                                ->inline()
                                ->row($btn);
            $msg['reply_markup'] = $keyboard;
        }
        foreach ($nextTask->images as $image) {
            $this->replyWithPhoto([
                'chat_id' => $this->getUpdate()->getChat()->getId(),
                'photo'   => 'http://telebot.backend.pro' . $image->path,
                'caption' => ' '
            ]);
        }
        $this->replyWithMessage($msg);
    }
}