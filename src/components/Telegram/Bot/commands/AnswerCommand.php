<?php

namespace app\components\Telegram\Bot\commands;


use app\models\Player;
use app\models\Task;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class AnswerCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "answer";

    /**
     * @var string Command Description
     */
    protected $description = "Отправка ответа на текущее заданиее";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        $user_id = $this->getUpdate()->getChat()->getId();
        if (!$player = Player::findOne(['telegram_user_id' => $user_id])) {
            $this->replyWithMessage(['text' => 'Увас нет активных игр']);
            exit;
        }
        if (!$task   = $player->currentTask) {
            $this->replyWithMessage(['text' => 'Увас нет активных игр']);
            exit;
        }
        if ($task->pass_phrase == $arguments) {
            $this->replyWithMessage(['text' => 'Ответ принят']);
            $this->replyWithMessage(['text' => $task->final_text]);
            if ( ! $task->next_task) {
                $this->replyWithMessage(['text' => 'Game  over']);
                $player->delete();
                exit();
            }
            $player->current_task = $task->next_task;
            $player->save();
            $nextTask             = Task::findOne($player->current_task);
            $this->replyWithMessage(['text' => 'Следующая задача: ']);
            $this->replyWithMessage(['text' => $nextTask->start_text]);
            foreach ($nextTask->images as $image){
                $this->replyWithPhoto([
                    'chat_id' => $this->getUpdate()->getChat()->getId(),
                    'photo' => 'http://telebot.backend.pro'.$image->path,
                    'caption' => ' '
                ]);
            }

        } else {
            $this->replyWithMessage(['text' => 'Ответ не верен']);
        }
    }
}