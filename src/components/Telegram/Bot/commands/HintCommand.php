<?php

namespace app\components\Telegram\Bot\commands;


use app\models\Player;
use app\models\search\Hint;
use app\models\Task;
use app\models\TelegramUser;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class HintCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "hint";

    /**
     * @var string Command Description
     */
    protected $description = "Взять подсказку";

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
        /** @var Hint $hint */
        if(!$hint = $player->currentTask->getHints()->one()){
            $this->replyWithMessage(['text' => 'Для данной задачи не существует подсказок']);
            return true;
        }

        $player->current_task = $hint->start_task_id;
        $player->save();
        $nextTask = Task::findOne($player->current_task);
        $this->replyWithMessage(['text' => $nextTask->start_text]);
        foreach ($nextTask->images as $image) {
            $this->replyWithPhoto([
                'chat_id' => $this->getUpdate()->getChat()->getId(),
                'photo'   => 'http://telebot.backend.pro' . $image->path,
                'caption' => ' '
            ]);
        }
    }
}